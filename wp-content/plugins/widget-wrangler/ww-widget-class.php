<?php
/*
 * Widget Wrangler custom_post_type class for widget post type
 */
class Widget_Wrangler {
  var $meta_fields = array("ww-adv-enabled","ww-parse","ww-wpautop","ww-adv-template");
  var $settings = array();
  var $capability_type;
     
  /*
   * Constructor, build the new post type
   */
  function Widget_Wrangler()
  {
    // get ww settings
    $settings = ww_get_settings();
    // allow for custom capability type
    $capability_type = ($settings['capabilities'] == "advanced" && isset($settings['advanced'])) ? $settings['advanced'] : "post";
    $labels = array(
      'name' => _x('Widget Wrangler', 'post type general name'),
      'all_items' => __('All Widgets'),
      'singular_name' => _x('Widget', 'post type singular name'),
      'add_new' => _x('Add New', 'widget'),
      'add_new_item' => __('Add New Widget'),
      'edit_item' => __('Edit Widget'),
      'new_item' => __('New Widget'),
      'view_item' => __('View Widget'),
      'search_items' => __('Search Widgets'),
      'menu_icon' => WW_PLUGIN_DIR.'/icon-wrangler.png',
      'not_found' =>  __('No widgets found'),
      'not_found_in_trash' => __('No widgets found in Trash'), 
      'parent_item_colon' => '',
    );
    // Register custom post types
    register_post_type('widget', array(
      'labels' =>$labels,
      'public' => true,
      'show_in_menu' => true,
      'show_ui' => true, // UI in admin panel
      '_builtin' => false, // It's a custom post type, not built in
      '_edit_link' => 'post.php?post=%d',
      'capability_type' => $capability_type,
      'hierarchical' => false,
      'rewrite' => array("slug" => "widget"), // Permalinks
      'query_var' => "widget", // This goes to the WP_Query schema
      'supports' => array('title','excerpt','editor' /*,'custom-fields'*/), // Let's use custom fields for debugging purposes only
      'menu_icon' => WW_PLUGIN_URL.'/images/wrangler_icon.png'
    ));
   
    add_filter("manage_edit-widget_columns", array(&$this, "edit_columns"));
    add_action("manage_posts_custom_column", array(&$this, "custom_columns"));
   
    // Admin interface init
    add_action("admin_init", array(&$this, "admin_init"));
    //add_action("template_redirect", array(&$this, 'template_redirect'));
    
    // Insert post hook
    add_action("wp_insert_post", array(&$this, "wp_insert_post"), 10, 2);
  }
  /*
   * Custom columns for the main Widgets management page
   */  
  function edit_columns($columns)
  {
    $columns = array(
      "cb" => "<input type=\"checkbox\" />",
      "title" => "Widget Title",
      "ww_description" => "Description",
      "ww_adv_enabled" => "Adv Parse",
    );
   
    return $columns;
  }
  /*
   * Handler for custom columns
   */
  function custom_columns($column)
  {
    global $post;
    $custom = get_post_custom();
    switch ($column)
    {
      case "ww_description":
       the_excerpt();
       break;
      case "ww_adv_enabled":
       echo $custom["ww-adv-enabled"][0];
       break;
    }
  }
  
  /*
   * When a post is inserted or updated
   */ 
  function wp_insert_post($post_id, $post = null)
  {
    if ($post->post_type == "widget")
    {
      // Loop through the POST data
      foreach ($this->meta_fields as $key)
      {
        $value = @$_POST[$key];
        if (empty($value))
        {
         delete_post_meta($post_id, $key);
         continue;
        }
     
        // If value is a string it should be unique
        if (!is_array($value))
        {
          // Update meta
          if (!update_post_meta($post_id, $key, $value))
          {
           // Or add the meta data
           add_post_meta($post_id, $key, $value);
          }
        }
        else
        {
          // If passed along is an array, we should remove all previous data
          delete_post_meta($post_id, $key);
          
          // Loop through the array adding new values to the post meta as different entries with the same name
          foreach ($value as $entry){
            add_post_meta($post_id, $key, $entry);
          }
        }
      }
    }
  }
  /*
   * Add meta box to widget posts
   */
  function admin_init() 
  {
    // Custom meta boxes for the edit widget screen
    add_meta_box("ww-parse", "Options", array(&$this, "meta_parse"), "widget", "normal", "high");
    add_meta_box("ww-widget-preview", "Widget Preview", array(&$this, "meta_widget_preview"), "widget", "side", "default");
  }
  
  // Admin preview box
  function meta_widget_preview(){
    global $post;
    if ($post->ID)
    {
      $widget = ww_get_single_widget($post->ID);
      ?>
        <div id="ww-preview">
          <p><em>This preview does not include your theme's CSS stylesheet.</em></p>
          <?php print ww_theme_single_widget($widget); ?>
        </div>
      <?php
    }
  }
  
  // Admin post meta contents
  function meta_parse()
  {
    global $post;
    
    // post custom data
    $custom = get_post_custom($post->ID);
    $parse = $custom["ww-parse"][0];
    $adv_enabled = $custom["ww-adv-enabled"][0];
    $adv_template = $custom["ww-adv-template"][0];
    $wpautop = $custom["ww-wpautop"][0];
    
    // default to checked upon creation
    $adv_checked = (isset($adv_enabled)) ? 'checked="checked"' : '';
    $adv_template_checked = (isset($adv_template)) ? 'checked="checked"' : '';
    $wpautop_checked = (isset($wpautop) || (($_GET['action'] == null) && ($_GET['post_type'] == 'widget'))) ? 'checked="checked"' : '';
    
    ?><div id="ww-template">
        <div class="ww-widget-postid">Post ID<br/><span><?php print $post->ID;?></span></div>
        <div>
          <label><input type="checkbox" name="ww-wpautop" <?php print $wpautop_checked; ?> /> Automatically add Paragraphs to this Widget's Content</label>
        </div>
        <div>
          <h4>Advanced Parsing</h4>
          <div id="ww-advanced-field">
            <label><input id="ww-adv-parse-toggle" type="checkbox" name="ww-adv-enabled" <?php print $adv_checked; ?> /> Enable Advanced Parsing</label>
            <div id="ww-advanced-template">
              <label><input id="ww-adv-template-toggle" type="checkbox" name="ww-adv-template" <?php print $adv_template_checked; ?> /> Template the Advanced Parsing Area</label> <em>(Do not use with Cloned Widgets.  Details below)</em>
            </div>
          </div>
          <textarea name="ww-parse" cols="40" rows="16" style="width: 100%;"><?php print htmlentities($parse); ?></textarea>
          <div class="adv-parse-description">
            <h5>In the Advanced Parsing area you can:</h5>
            <ul>
              <li>Use PHP ( &lt;?php and ?&gt; are required )</li>
              <li>Use {{title}} or $widget->post_title to insert the widget's title</li>
              <li>Use {{content}} or $widget->post_content to insert the widget's content</li>
              <li>Access the $widget object for more widget data (see provided template for examples)</li>
              <li>Access the $post object for data concerning the page being displayed (see provided template for examples)</li>
            </ul>
            <h5>Templating Advanced Parsed Widgets</h5>
            <ul>
              <li>To template an advanced parsed widget you must return an associative array with a title and content string.</li>
              <li>Example: &lt;?php return array("title" => "The Widget's Title", "content" => "The Widget's Content"); ?&gt;</li>
              <li><strong>All Cloned widgets are already templated so this setting should not be used for them.</strong></li>
              <li><strong>If you are unclear on what this means, it is highly recommended that you avoid this option.</strong></li>
            </ul>
         </div>
        </div>
      </div>
    <?php
  }
}
// end widget class
