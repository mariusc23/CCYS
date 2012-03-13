<?php
/*
Plugin Name: List Widget
Description: Enables a list widget, in which you can display up to ten items in an ordered or unordered list.
Author: Frankie Roberto
Author URI: http://www.frankieroberto.com
Version: 0.2.2
*/

class ListWidget extends WP_Widget {

	function ListWidget() {
		$widget_ops = array('classname' => 'list_widget', 'description' => __('A short list.'));
		$this->WP_Widget('list', __('List'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('List') : $instance['title']);
		$type = empty($instance['type']) ? 'unordered' : $instance['type'] ;
		
		for ($i = 1; $i <= 5; $i++) {
			$items[$i] = $instance['item' . $i];
		}

		echo $before_widget .  $before_title . $title . $after_title;  ?>
			<?php if ($type == "ordered") { echo "<ol ";} else { echo("<ul "); } ?> class="score-list">
				
				<?php foreach ($items as $item) : 
					if (!empty($item)) :
						echo('<li class="score-list-item">' . $item . "</li>");
					endif;
				 endforeach; ?>
      <?php if ($type == "ordered") { echo "</ol>";} else { echo("</ul>"); } ?>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_link'] = $new_instance['title_link'];
		for ($i = 1; $i <= 5; $i++) {
			$instance['item' . $i] = $new_instance['item' . $i];
		}		
		$instance['type'] = $new_instance['type'];
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'title_link' => '' ) );
		$title = strip_tags($instance['title']);
		for ($i = 1; $i <= 5; $i++) {
			$items[$i] = $instance['item' . $i];
		}
		$title_link = $instance['title_link'];		
		$type = empty($instance['type']) ? 'unordered' : $instance['type'] ;
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<?php foreach ($items as $num => $item) : ?>

		<p><label for="<?php echo $this->get_field_id('item' . $num); ?>"><?php _e('Item ' . $num . ':'); ?></label>
		<input class="" id="<?php echo $this->get_field_id('item' . $num); ?>" name="<?php echo $this->get_field_name('item' . $num); ?>" type="text" value="<?php echo esc_attr($item); ?>" /></p>
		<?php endforeach; ?>

		<label for="<?php echo $this->get_field_id('ordered'); ?>"><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" value="ordered" id="<?php echo $this->get_field_id('ordered'); ?>" <?php checked($type, "ordered"); ?>></input>  Ordered</label>
		<label for="<?php echo $this->get_field_id('unordered'); ?>"><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" value="unordered" id="<?php echo $this->get_field_id('unordered'); ?>" <?php checked($type, "unordered"); ?>></input> Unordered</label>

<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("ListWidget");'));

?>