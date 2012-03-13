<?php
/*
Copyright (C) 2011  Alexander Zagniotov

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

class ComprehensiveGoogleMap_Widget extends WP_Widget {

	var $maindesc = "A simple and intuitive, yet elegant fully documented Google map plugin that installs as a widget and a short code. The plugin is packed with useful features. Widget and shortcode enabled. Offers extensive configuration options for marker, controls, size, KML files, location by latitude/longitude, location by address, info window, directions, traffic/bike lanes and more.";

	function ComprehensiveGoogleMap_Widget() {
		$widget_ops = array('classname' => 'comprehensivegooglemap_widget', 'description' => __( $this->maindesc, 'kalisto') );
		$cops = array('width' => 570);
		$this->WP_Widget('comprehensivegooglemap', __('AZ :: Google Map', 'kalisto'), $widget_ops, $cops);

		if ( is_active_widget(false, false, $this->id_base, true) ) {
			
		}
	}


	function widget( $args, $instance ) {
		extract($args);
		$map_data_properties = array();
		$not_map_data_properties = array("title", "width", "height", "mapalign", "directionhint",
				"latitude", "longitude", "addresscontent", "addmarkerlisthidden", "addmarkermashuphidden", "addmarkerinput", 
				"showmarker", "animation", "infobubblecontent", "markerdirections", "locationaddmarkerinput", "bubbletextaddmarkerinput");

		$json_default_values = cgmp_fetch_json_data_file(CGMP_JSON_DATA_DEFAULT_WIDGET_PARAM_VALUES);

		foreach ($instance as $key => $value) {
				$value = trim($value);
				$value = (!isset($value) || empty($value)) ? $json_default_values[$key] : esc_attr(strip_tags($value));
				$instance[$key] = $value;

				if (!in_array($key, $not_map_data_properties)) {
					$key = str_replace("hidden", "", $key);
					$key = str_replace("_", "", $key);
					$map_data_properties[$key] = $value;
				}
		}
		extract( $instance );
		echo $before_widget;

		if ( isset($title)) {
			echo $before_title .$title . $after_title;
		}

		if ($addmarkermashuphidden == 'true') {
			$addmarkerlisthidden = make_marker_geo_mashup();
		} else if ($addmarkermashuphidden == 'false') {
			$addmarkerlisthidden = update_markerlist_from_legacy_locations($latitude, $longitude, $addresscontent, $addmarkerlisthidden);
			$addmarkerlisthidden = cgmp_parse_wiki_style_links($addmarkerlisthidden);
			$addmarkerlisthidden = htmlspecialchars($addmarkerlisthidden);
		}

		cgmp_set_google_map_language($language);
		cgmp_google_map_init_scripts();

		$id = md5(time().' '.rand());
		echo cgmp_draw_map_placeholder($id, $width, $height, $mapalign, $directionhint);

		$map_data_properties['id'] = $id;
		$map_data_properties['markerlist'] = $addmarkerlisthidden;
		$map_data_properties['addmarkermashup'] = $addmarkermashuphidden;
		$map_data_properties['kml'] = cgmp_clean_kml($map_data_properties['kml']);
		$map_data_properties['panoramiouid'] = cgmp_clean_panoramiouid($map_data_properties['panoramiouid']);

		cgmp_map_data_injector(json_encode($map_data_properties));

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		foreach ($new_instance as $key => $val) {
			$instance[$key] = strip_tags($new_instance[$key]);
		}
		return $instance;
	}

	function form( $instance ) {

		$settings = array();

		$json_html_elems = cgmp_fetch_json_data_file(CGMP_JSON_DATA_HTML_ELEMENTS_FORM_PARAMS);
		$json_default_values = cgmp_fetch_json_data_file(CGMP_JSON_DATA_DEFAULT_WIDGET_PARAM_VALUES);

		if (is_array($json_html_elems)) {

			$legacy_params = array("latitude" => "", "longitude" => "", "addresscontent" => "", "addmarkerlisthidden" => "");

			foreach ($json_html_elems as $data_chunk) {
				$id = $data_chunk['dbParameterId'];
				$value = trim($instance[$id]);
				$value = (!isset($value) || empty($value)) ? $json_default_values[$id] : esc_attr(strip_tags($value));

				if (array_key_exists($id, $legacy_params)) {
					$legacy_params[$id] = $value;
				}

				if ($id == "addmarkerlisthidden") {
					extract($legacy_params);
					$addmarkerlisthidden = update_markerlist_from_legacy_locations($latitude, $longitude, $addresscontent, $addmarkerlisthidden);
					$value = $addmarkerlisthidden;
				}

				$data_chunk['dbParameterValue'] = $value;
				$data_chunk['dbParameterId'] = $this->get_field_id($id);
				$data_chunk['dbParameterName'] = $this->get_field_name($id);
				cgmp_set_values_for_html_rendering($settings, $data_chunk);
			}
		}

		$template_values = array();
		$template_values = cgmp_build_template_values($settings);

		$tokens_with_values = array();
		$tokens_with_values['WIDGET_ID_TOKEN'] = $this->id;
		$tokens_with_values['WIDGET_FORM_TITLE_TEMPLATE_TOKEN'] = cgmp_render_template_with_values($template_values, CGMP_HTML_TEMPLATE_WIDGET_FORM_TITLE);
		$tokens_with_values['MAP_CONFIGURATION_FORM_TEMPLATE_TOKEN'] = cgmp_render_template_with_values($template_values, CGMP_HTML_TEMPLATE_MAP_CONFIGURATION_FORM);

		echo cgmp_render_template_with_values($tokens_with_values, CGMP_HTML_TEMPLATE_WIDGET);
	}
}
?>
