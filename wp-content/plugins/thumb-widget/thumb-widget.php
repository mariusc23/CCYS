<?php
/*
Plugin Name: Thumb Widget
Plugin URI: http://uxmedic.com/
Description: Text widget with a thumbnail.
Version: 1
Author: UX Medic
Author URI: http://uxmedic.com/
*/
class thumbWidget extends WP_Widget {

    function thumbWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Title, text, and a thumbnail.'));
        $control_ops = array('width' => 400, 'height' => 350);
        $this->WP_Widget('thumbWidget', __('Thumb Widget'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance);
        $titleUrl = apply_filters('widget_title', empty($instance['titleUrl']) ? '' : $instance['titleUrl'], $instance);
        $imageUrl = apply_filters('widget_title', empty($instance['imageUrl']) ? '' : $instance['imageUrl'], $instance);
        $newWindow = $instance['newWindow'] ? '1' : '0';
        $cssClass = apply_filters('widget_title', empty($instance['cssClass']) ? '' : $instance['cssClass'], $instance);
        $bare = $instance['bare'] ? true : false;
        $text = apply_filters( 'widget_text', $instance['text'], $instance );
        if ( $cssClass ) {
            if( strpos($before_widget, 'class') === false ) {
                $before_widget = str_replace('>', 'class="'. $cssClass .'"', $before_widget);
            } else {
                $before_widget = str_replace('class="', 'class="'. $cssClass . ' ' . "thumb-widget" .' ', $before_widget);
            }
        }
        echo $bare ? '' : $before_widget;
        if( $titleUrl && $title )
            $title = '<a href="'.$titleUrl.'"'.($newWindow == '1'?' target="_blank"':'').' title="'.$title.'">'.$title.'</a>';
        if ( !empty( $title ) ) { echo $bare ? $title : $before_title . $title . $after_title; } ?>
            <?php echo '<div class="widgetThumb"><img src="' . $imageUrl . '"/></div>'; ?>
            <div class="widgetThumbText"><?php if($instance['filter']) { ob_start(); eval("?>$text<?php "); $output = ob_get_contents(); ob_end_clean(); echo wpautop($output); } else eval("?>".$text."<?php "); ?></div>
        <?php
        echo $bare ? '' : $after_widget;
    }
    
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['titleUrl'] = strip_tags($new_instance['titleUrl']);
        $instance['imageUrl'] = strip_tags($new_instance['imageUrl']);
        $instance['cssClass'] = strip_tags($new_instance['cssClass']);
        $instance['bare'] = $new_instance['bare'] ? 1 : 0;
        $instance['newWindow'] = $new_instance['newWindow'] ? 1 : 0;
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = wp_filter_post_kses( $new_instance['text'] );
        $instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'titleUrl' => '', 'text' => '' ) );
        $title = strip_tags($instance['title']);
        $imageUrl = strip_tags($instance['imageUrl']);
        $titleUrl = strip_tags($instance['titleUrl']);
        $newWindow = $instance['newWindow'] ? 'checked="checked"' : '';
        $cssClass = strip_tags($instance['cssClass']);
        $bare = $instance['bare'] ? 'checked="checked"' : '';
        $text = format_to_edit($instance['text']);
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('imageUrl'); ?>"><?php _e('Thumb URL:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('imageUrl'); ?>" name="<?php echo $this->get_field_name('imageUrl'); ?>" type="text" value="<?php echo esc_attr($imageUrl); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('titleUrl'); ?>"><?php _e('URL:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('titleUrl'); ?>" name="<?php echo $this->get_field_name('titleUrl'); ?>" type="text" value="<?php echo esc_attr($titleUrl); ?>" /></p>
        <p><input class="checkbox" type="checkbox" <?php echo $newWindow; ?> id="<?php echo $this->get_field_id('newWindow'); ?>" name="<?php echo $this->get_field_name('newWindow'); ?>" />
        <label for="<?php echo $this->get_field_id('newWindow'); ?>"><?php _e('Open the URL in a new window'); ?></label></p>
        <p><label for="<?php echo $this->get_field_id('cssClass'); ?>"><?php _e('CSS Class:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('cssClass'); ?>" name="<?php echo $this->get_field_name('cssClass'); ?>" type="text" value="<?php echo esc_attr($cssClass); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Content:'); ?></label>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php echo $bare; ?> id="<?php echo $this->get_field_id('bare'); ?>" name="<?php echo $this->get_field_name('bare'); ?>" />
        <label for="<?php echo $this->get_field_id('bare'); ?>"><?php _e('Do not output before/after_widget/title'); ?></label></p>
<?php
    }
}
function thumbWidgetInit() {
    register_widget('thumbWidget');
}

add_action('widgets_init', 'thumbWidgetInit');
?>
