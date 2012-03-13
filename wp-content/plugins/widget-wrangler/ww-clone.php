<?php
/*
 * Inserts a cloned WP widget as a WW widget
 */
function ww_clone_insert($posted)
{
  global $wpdb,$wp_widget_factory;
  
  //Start our outputs
  $this_class_name = '';
  $parse_string = "<?php \n";
  $parse_string.= "\n// Widget Settings\n";
  
  if(isset($posted[$posted['ww-keyname']]))
  {
    $this_class_name = $posted['ww-classname'];
    foreach($posted[$posted['ww-keyname']] as $i => $settings)
    {
      //print_r($settings);
      //print " - ".$i;
      foreach($settings as $key => $value)
      {
        //print $key. " - ".$value."<br>";
        $instance[$key] = $value;
        $parse_string.= "\$instance['".$key."'] = '".$value."';\n";
      }
    }
  }
  // handle necessary values for templating
  $parse_string.= "\$instance['post_name'] = \$widget->post_name;\n";
  $parse_string.= "\$instance['title'] = \$widget->post_title;\n";
  $parse_string.= "\$instance['ID'] = \$widget->ID;\n";
  // execution of widget
  $parse_string.= "\n// Run Widget \nww_the_widget('".$this_class_name."',\$instance); \n?>";
  
  // prep new widget info for saving
  $new_widget = array();
  $new_widget['post_author'] = 1; // for now
  $new_widget['post_title'] = ($instance['title']) ? $instance['title'] : "Clone of ".$this_class_name;
  $new_widget['post_excerpt'] = 'Cloned from '.$this_class_name;
  $new_widget['comment_status'] = 'closed';
  $new_widget['ping_status'] = 'closed';
  $new_widget['post_status'] = 'draft';
  $new_widget['post_type'] = 'widget';
  // Herb contributed fix for problem cloning
  $new_widget['post_content'] = '';
  $new_widget['to_ping'] = '';
  $new_widget['pinged'] = '';
  $new_widget['post_content_filtered'] = '';
  
  // post as meta values
  $new_meta['parse'] = $parse_string;
  $new_meta['adv_enabled'] = 'on';
  
  // insert new widget into db
  $format = array('%d','%s','%s','%s','%s','%s','%s', '%s', '%s', '%s');
  $wpdb->insert($wpdb->prefix."posts", $new_widget, $format);
  $new_post_id = $wpdb->insert_id;
  update_post_meta($new_post_id,'ww-parse', $new_meta['parse']);
  update_post_meta($new_post_id,'ww-adv-enabled', $new_meta['adv_enabled']);
  
  return $new_post_id;
  exit;
}
/*
 * Display widgets available for cloning.
 */
function ww_clone_form()
{
  global $wp_widget_factory,$wp_registered_widget_controls,$wp_registered_widget_updates,$wp_registered_widgets;
  $total_widgets = count($wp_widget_factory->widgets);
  $half = round($total_widgets/2);
  $i = 0;
  
  $output = "<div class='wrap'>
              <h2>Clone a Wordpress Widget</h2>
              <p>Here you can clone an existing Wordpress widget into the Widget Wrangler system.</p>";
              
  $output.= "<ul class='ww-clone-widgets'>";
  foreach ($wp_widget_factory->widgets as $class_name => $widget)
  {
    $posted_array_key = "widget-".$widget->id_base;
    //print_r($widget);
    if ($i == $half)
    {
      $output.= "</ul><ul class='ww-clone-widgets'>";
    }
    ob_start();
    eval('$w = new '.$class_name.'(); $w->form(array());');
    $new_class = ob_get_clean();
    $output.= "<li>
                <div class='widget'>
                  <div class='widget-top'>
                    <div class='widget-title-action'>
                      <div class='widget-action'></div>
                    </div>
                    <h4>".$widget->name."</h4>
                  </div>
                  <div class='widget-inside'>            
                    <form action='edit.php?post_type=widget&page=ww-clone&ww-clone-action=insert&noheader=true' method='post'>
                      <input type='hidden' name='ww-classname' value='$class_name' />
                      <input type='hidden' name='ww-keyname' value='$posted_array_key' />
                      ".$new_class."
                      <input class='ww-clone-submit button' type='submit' value='Create' />
                    </form>
                  </div>
                </div>
              </li>";
    
    $i++;
  }
  $output.= " </ul></div>";
  print $output;
}
