<?php
/*
Plugin Name: Widget Wrangler
Plugin URI: http://www.widgetwrangler.com
Description: Widget Wrangler gives the wordpress admin a clean interface for managing widgets on a page by page basis. It also provides widgets as a post type, the ability to clone existing wordpress widgets, and granular control over widgets' templates.
Author: Jonathan Daggerhart
Version: 1.4.3
Author URI: http://www.daggerhart.com
License: GPL2
*/
/*  Copyright 2010  Jonathan Daggerhart  (email : jonathan@daggerhart.com)
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('WW_PLUGIN_DIR', dirname(__FILE__));
define('WW_PLUGIN_URL', get_bloginfo('wpurl')."/wp-content/plugins/widget-wrangler");

// add the widget post type class
include WW_PLUGIN_DIR.'/ww-widget-class.php';

// include admin panel and helper functions
include WW_PLUGIN_DIR.'/widget-wrangler.admin.php';

// include WP standard widgets for sidebars
include WW_PLUGIN_DIR.'/ww-sidebars-widget.php';

// Initiate the plugin
add_action( 'init', 'Widget_Wrangler_Init');
add_action( 'admin_menu', 'ww_menu');

// HOOK IT UP TO WORDPRESS
add_action( 'admin_init', 'ww_admin_init' );
add_action( 'save_post', 'ww_save_post' );
add_action( 'admin_head', 'ww_admin_css');
add_shortcode('ww_widget','ww_single_widget_shortcode');

/*
 * Function for initializing the plugin
 */
function Widget_Wrangler_Init() {
  global $ww;
  $ww = new Widget_Wrangler();
}

/*
 * All my hook_menu implementations
 */
function ww_menu()
{
  $clone    = add_submenu_page( 'edit.php?post_type=widget', 'Clone WP Widget', 'Clone WP Widget',  'manage_options', 'ww-clone',    'ww_clone_page_handler');
  $defaults = add_submenu_page( 'edit.php?post_type=widget', 'Default Widgets', 'Default WIdgets',     'manage_options', 'ww-defaults', 'ww_defaults_page_handler');
  // only show postspage widget setting if post page is the front page
  if(get_option('show_on_front') == 'posts'){
    $postspage= add_submenu_page( 'edit.php?post_type=widget', 'Posts Page',      'Posts Page Widgets',       'manage_options', 'ww-postspage','ww_postspage_page_handler');
  }
  $sidebars = add_submenu_page( 'edit.php?post_type=widget', 'Widget Sidebars', 'Sidebars',         'manage_options', 'ww-sidebars', 'ww_sidebars_page_handler');
  $settings = add_submenu_page( 'edit.php?post_type=widget', 'Settings',        'Settings',         'manage_options', 'ww-settings', 'ww_settings_page_handler');
  //$debug    = add_submenu_page( 'edit.php?post_type=widget', 'Debug Widgets', 'Debug', 'manage_options', 'ww-debug', 'ww_debug_page');
  add_action( "admin_print_scripts-$sidebars", 'ww_sidebar_js' );
}

/*
 * for whatever.
 */
function ww_debug_page(){
  /*/global $wp_registered_widgets, $wp_registered_widget_controls, $wp_registered_widget_updates, $_wp_deprecated_widgets_callbacks;
  //global $wp_widget_factory,$wp_registered_widgets, $wpdb;
  global $wp_filter;
  //print_r($wp_filter);
  foreach($wp_filter as $k => $v){
    print $k."<br>";
  }
  // */
}
/* * * * * * * *
 * Page handling
 */
function ww_postspage_page_handler()
{
  include WW_PLUGIN_DIR.'/ww-postspage.php';
  // save Posts page widgets if posted
  if ($_GET['ww-postspage-action']){
    switch($_GET['ww-postspage-action']){
      case 'update':
        $defaults_array = ww_postspage_save_widgets($_POST);
        break;
    }
    wp_redirect(get_bloginfo('wpurl').'/wp-admin/edit.php?post_type=widget&page=ww-postspage');
  }
  else{
    ww_postspage_form();
  }
}
/*
 * Sidebar page handler
 */
function ww_sidebars_page_handler()
{
  include WW_PLUGIN_DIR.'/ww-sidebars.php';
  if($_GET['ww-sidebar-action']){
    switch($_GET['ww-sidebar-action']){
      case 'insert':
        $new_sidebar_id = ww_sidebar_insert($_POST);
        break;
      case 'delete':
        ww_sidebar_delete($_POST);
        break;
      case 'update':
        ww_sidebar_update($_POST);
        break;
      case 'sort':
        ww_sidebar_sort($_POST);
        break;
    }
    wp_redirect(get_bloginfo('wpurl').'/wp-admin/edit.php?post_type=widget&page=ww-sidebars');
  }
  // show sidebars page
  ww_sidebars_form();
}
/*
 * Handles creation of new cloned widgets, and displays clone new widget page
 */
function ww_clone_page_handler()
{
  include WW_PLUGIN_DIR.'/ww-clone.php';
  if($_GET['ww-clone-action']){
    switch($_GET['ww-clone-action']){
      case 'insert':
        // create new cloned widget
        $new_post_id = ww_clone_insert($_POST);
        // goto new widget page
        wp_redirect(get_bloginfo('wpurl').'/wp-admin/post.php?post='.$new_post_id.'&action=edit');
        break;
    }
  }
  else{
    // show clone page
    ww_clone_form();
  }
}
/*
 * Handles settings page
 */
function ww_settings_page_handler()
{
  include WW_PLUGIN_DIR.'/ww-settings.php';
  if ($_GET['ww-settings-action']){
    switch($_GET['ww-settings-action']){
      case "save":
        ww_settings_save($_POST);
        break;
      case "reset":
        ww_settings_reset_widgets();
        break;
    }
    wp_redirect(get_bloginfo('wpurl').'/wp-admin/edit.php?post_type=widget&page=ww-settings');
  }
  else{
    ww_settings_form();
  }
}
/*
 * Produce the Default Widgets Page
 */
function ww_defaults_page_handler()
{
  include WW_PLUGIN_DIR."/ww-defaults.php";
  // save defaults if posted
  if ($_GET['ww-defaults-action']){
    switch($_GET['ww-defaults-action']){
      case 'update':
        $defaults_array = ww_save_default_widgets($_POST);
        break;
    }
    wp_redirect(get_bloginfo('wpurl').'/wp-admin/edit.php?post_type=widget&page=ww-defaults');
  }
  else{
    include WW_PLUGIN_DIR."/ww-sidebars.php";
    ww_theme_defaults_page();
  }
}
/* end page handling */

/*
 * Returns all published widgets
 * @return array of all widget objects
 */
function ww_get_all_widgets()
{
  global $wpdb;
  $query = "SELECT
              ID,post_name,post_title,post_content
            FROM
              ".$wpdb->prefix."posts
            WHERE
              post_type = 'widget' AND
              post_status = 'publish'";
  $widgets = $wpdb->get_results($query);

  $i=0;
  $total = count($widgets);
  while($i < $total)
  {
    $widgets[$i]->adv_enabled = get_post_meta($widgets[$i]->ID,'ww-adv-enabled',TRUE);
    $widgets[$i]->parse       = get_post_meta($widgets[$i]->ID,'ww-parse', TRUE);
    $widgets[$i]->wpautop     = get_post_meta($widgets[$i]->ID,'ww-wpautop', TRUE);
    $i++;
  }
  return $widgets;
}
/*
 * Retrieve and return a single widget by its ID
 * @return widget object
 */
function ww_get_single_widget($post_id){
  global $wpdb;
  $query = "SELECT
              ID,post_name,post_title,post_content
            FROM
              ".$wpdb->prefix."posts
            WHERE
              post_type = 'widget' AND
              post_status = 'publish' AND
              ID = ".$post_id;
  $widget = $wpdb->get_row($query);
  $widget->adv_enabled = get_post_meta($widget->ID,'ww-adv-enabled',TRUE);
  $widget->adv_template = get_post_meta($widget->ID,'ww-adv-template',TRUE);
  $widget->parse = get_post_meta($widget->ID,'ww-parse', TRUE);
  $widget->wpautop = get_post_meta($widget->ID,'ww-wpautop', TRUE);
  return $widget;
}

/*
 * Apply templating and parsing to a single widget
 * @return themed widget for output or templating
 */
function ww_theme_single_widget($widget)
{
  // maybe they don't want auto p ?
  if ($widget->wpautop == "on"){
    $widget->post_content = wpautop($widget->post_content);
  }

  // apply shortcode
  $widget->post_content = do_shortcode($widget->post_content);

  // see if this should use advanced parsing
  if($widget->adv_enabled){
    $themed = ww_adv_parse_widget($widget);
  }
  else{
    $themed = ww_template_widget($widget);
  }

  return $themed;
}
/*
 * Look for possible custom templates, then default to widget-template.php
 * @return templated widget
 */
function ww_template_widget($widget)
{
  ob_start();

  // look for template in theme folder w/ widget ID first
  if (file_exists(TEMPLATEPATH . "/widget-".$widget->ID.".php")){
    include TEMPLATEPATH . "/widget-".$widget->ID.".php";
  }
  // fallback to standard widget template in theme
  else if (file_exists(TEMPLATEPATH . "/widget.php")){
    include TEMPLATEPATH . "/widget.php";
  }
  // fallback on default template
  else{
    include WW_PLUGIN_DIR. '/widget-template.php';
  }
  $templated = ob_get_clean();

  return $templated;
}
/*
 * Handle the advanced parsing for a widget
 * @return advanced parsed widget
 */
function ww_adv_parse_widget($widget)
{
  // make $post and $page available
  global $post;
  $page = $post;

  // handle advanced templating
  if($widget->adv_template)
  {
    $returned_array = eval('?>'.$widget->parse);
    if (is_array($returned_array)){
      $widget->post_title = $returned_array['title'];
      $widget->post_content = $returned_array['content'];
      $output = ww_template_widget($widget);
    }
    else {
      $output = "<!-- Error:  This widget did not return an array. -->";
    }
  }
  else
  {
    $pattern = array('/{{title}}/','/{{content}}/');
    $replace = array($widget->post_title, $widget->post_content);

    // find and replace title and content tokens
    $parsed = preg_replace($pattern,$replace,$widget->parse);

    // execute adv parsing area
    ob_start();
      eval('?>'.$parsed);
      $output = ob_get_clean();
      // fix for recent post widget not resetting the query
      $post = $page;
  }

  return $output;
}
/*
 * Retrieve list of sidebars
 * @return array of sidebars
 */
function ww_get_all_sidebars()
{
  if ($sidebars_string = get_option('ww_sidebars')){
    $sidebars_array = unserialize($sidebars_string);
  }
  else{
    $sidebars_array = array('No Sidebars Defined');
  }
  return $sidebars_array;
}
/*
 * Output a sidebar
 */
function ww_dynamic_sidebar($sidebar_slug = 'default')
{
  // get the post and sidebars
  global $post;
  $sidebars = ww_get_all_sidebars();
  $output = '';

  // see if this is the Posts (blog) page
  if(is_home() && (get_option('show_on_front') == 'posts') && $postspage_string = get_option('ww_postspage_widgets')){
    $widgets_array = unserialize($postspage_string);
  }
  // look for post meta data
  else if ($widgets_string = get_post_meta($post->ID,'ww_post_widgets', TRUE)){
    $widgets_array = unserialize($widgets_string);
  }
  // try defaults instead
  else if ($defaults_string = get_option('ww_default_widgets')){
    $widgets_array = unserialize($defaults_string);
  }
  // no widgets in post and no defaults
  else{
    return;
  }
  if (is_array($widgets_array[$sidebar_slug]))
  {
    $i = 0;
    $total = count($widgets_array[$sidebar_slug]);

    // custom sorting with callback
    usort($widgets_array[$sidebar_slug],'ww_cmp');
    $sorted_widgets = array_reverse($widgets_array[$sidebar_slug]);
    while($i < $total)
    {
      if($widget = ww_get_single_widget($widgets_array[$sidebar_slug][$i]['id'])){
        $output.= ww_theme_single_widget($widget);
      }
      $i++;
    }
  }

  print $output;
}
/*
 * Get the Widget Wrangler Settings
 * @return settings array
 */
function ww_get_settings()
{
  if ($settings = get_option("ww_settings")){
    $settings = unserialize($settings);
  }
  else{
    ww_settings_set_default();
    $settings = ww_get_settings();
  }

  // update 1.3 & 1.3.1 fix force a post_types setting
  if($settings['post_types'][0] == "" || empty($settings['post_types'])){
    $settings['post_types'] = array('page');
    update_option("ww_settings", serialize($settings));
  }

  return $settings;
}
/*
 * Default settings
 */
function ww_settings_set_default()
{
  $settings["capabilities"] = "simple";
  $settings["post_types"][] = "page";
  $settings["post_types"][] = "post";
  update_option("ww_settings", serialize($settings));
}

/**
 * Taken from wp-includes/widgets.php, adjusted for my needs
 *
 * @param string $widget the widget's PHP class name (see default-widgets.php)
 * @param array $instance the widget's instance settings
 * @return void
 **/
function ww_the_widget($widget, $instance = array())
{
  // load widget from widget factory ?
  global $wp_widget_factory;
  $widget_obj = $wp_widget_factory->widgets[$widget];

  if ( !is_a($widget_obj, 'WP_Widget') )
   return;

  // args for spliting title from content
  $args = array('before_widget'=>'','after_widget'=>'','before_title'=>'','after_title'=>'[explode]');

  // output to variable for replacements
  ob_start();
     $widget_obj->widget($args, $instance);
  $temp = ob_get_clean();

  // get title and content separate
  $array = explode("[explode]", $temp);

  // prep object for template
  $obj                = new stdClass();
  $obj->ID            = $instance['ID'];
  $obj->post_name     = $instance['post_name'];
  $obj->post_title    = ($array[0]) ? $array[0]: $instance['title'];
  $obj->post_content  = $array[1];

  // template with WW template
  print ww_template_widget($obj);
}