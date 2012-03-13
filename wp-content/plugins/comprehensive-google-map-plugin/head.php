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

if ( !function_exists('cgmp_google_map_admin_add_style') ):
        function cgmp_google_map_admin_add_style()  {
       			wp_enqueue_style('comprehensive-google-map-style', CGMP_PLUGIN_CSS . '/cgmp.admin.css', false, CGMP_VERSION, "screen");
        }
endif;


if ( !function_exists('cgmp_google_map_admin_add_script') ):
		function cgmp_google_map_admin_add_script()  {

				$whitelist = array('localhost', '127.0.0.1');

              	wp_enqueue_script('cgmp-jquery-tools-tooltip', CGMP_PLUGIN_JS .'/jquery.tools.tooltip.min.js', array('jquery'), '1.2.5.a', true);
				
				if (!in_array($_SERVER['HTTP_HOST'], $whitelist)) {
 					wp_enqueue_script('cgmp-jquery-tokeninput', CGMP_PLUGIN_JS. '/cgmp.tokeninput.min.js', array('jquery'), CGMP_VERSION, true);
				} else {
					wp_enqueue_script('cgmp-jquery-tokeninput', CGMP_PLUGIN_JS. '/cgmp.tokeninput.js', array('jquery'), CGMP_VERSION, true);
				}

				if (!in_array($_SERVER['HTTP_HOST'], $whitelist)) {
					wp_enqueue_script('comprehensive-google-map-plugin', CGMP_PLUGIN_JS. '/cgmp.admin.min.js', array('jquery'), CGMP_VERSION, true);
				} else {
					wp_enqueue_script('comprehensive-google-map-plugin', CGMP_PLUGIN_JS. '/cgmp.admin.js', array('jquery'), CGMP_VERSION, true);
				}
		}
endif;


if ( !function_exists('cgmp_google_map_tab_script') ):
    	function cgmp_google_map_tab_script()  {
             	wp_enqueue_script('cgmp-jquery-tools-tabs', CGMP_PLUGIN_JS .'/jquery.tools.tabs.min.js', array('jquery'), '1.2.5', true);
        }
endif;


if ( !function_exists('cgmp_google_map_init_scripts') ):
		function cgmp_google_map_init_scripts()  {

			if (!is_admin()) {

				wp_enqueue_style('cgmp-google-map-styles', CGMP_PLUGIN_URI . 'style.css', false, CGMP_VERSION, "screen");
				$whitelist = array('localhost', '127.0.0.1');
				wp_enqueue_script( array ( 'jquery' ) );
				if (!in_array($_SERVER['HTTP_HOST'], $whitelist)) {
					wp_enqueue_script('cgmp-google-map-wrapper-framework-final', CGMP_PLUGIN_JS. '/cgmp.framework.min.js', array(), CGMP_VERSION, true);
				} else {
					wp_enqueue_script('cgmp-google-map-wrapper-framework-final', CGMP_PLUGIN_JS. '/cgmp.framework.js', array(), CGMP_VERSION, true);
				}
			}
		}
endif;


if ( !function_exists('cgmp_google_map_init_global_admin_html_object') ):
		function cgmp_google_map_init_global_admin_html_object()  {

			if (is_admin()) {
				echo "<object id='global-data-placeholder' style='width: 0px !important; height: 0px !important'>".PHP_EOL;
				echo "    <param id='sep' name='sep' value='".CGMP_SEP."' />".PHP_EOL;
				echo "    <param id='customMarkersUri' name='customMarkersUri' value='".CGMP_PLUGIN_IMAGES."/markers/' />".PHP_EOL;
				echo "    <param id='defaultLocationText' name='defaultLocationText' value='Enter marker address or latitude,longitude here (required)' />".PHP_EOL;
				echo "    <param id='defaultBubbleText' name='defaultBubbleText' value='Enter marker info bubble text here (optional)' />".PHP_EOL;
				echo "</object> ".PHP_EOL;
			}
		}
endif;


if ( !function_exists('cgmp_google_map_init_global_html_object') ):
		function cgmp_google_map_init_global_html_object()  {

			if (!is_admin()) {

				$tokens_with_values = array();
				$tokens_with_values['LABEL_BAD_ADDRESSES'] = __('<b>ATTENTION</b>! (by Comprehensive Google Map Plugin)<br /><br />Google found the following address(es) as NON-geographic and could not find them:<br /><br />[REPLACE]<br />Consider revising the address(es). Did you make a mistake when creating marker locations or did not provide a full geo-address? Alternatively use Google web to validate the address(es)');
				$tokens_with_values['LABEL_MISSING_MARKERS'] = __('<b>ATTENTION</b>! (by Comprehensive Google Map Plugin)<br /><br />Dear blog/website owner,<br />You did not specify any marker locations for the Google map! Please check the following when adding marker locations:<br /><b>[a]</b> In the shortcode builder, did you click the Add Marker before generating shortcode?<br /><b>[b]</b> In the widget, did you click the Add Marker before clicking Save?<br /><br />Please revisit and reconfigure your widget or shortcode configuration. The map requires at least one marker location to be added..');
				$tokens_with_values['LABEL_KML'] = __('<b>ATTENTION</b>! (by Comprehensive Google Map Plugin)<br /><br />Dear blog/website owner,<br />Google returned the following error when trying to load KML file:<br /><br />[MSG] ([STATUS])');
				$tokens_with_values['LABEL_DOCINVALID_KML'] = __('The KML file is not a valid KML, KMZ or GeoRSS document.');
				$tokens_with_values['LABEL_FETCHERROR_KML'] = __('The KML file could not be fetched.');
				$tokens_with_values['LABEL_LIMITS_KML'] = __('The KML file exceeds the feature limits of KmlLayer.');
				$tokens_with_values['LABEL_NOTFOUND_KML'] = __('The KML file could not be found. Most likely it is an invalid URL, or the document is not publicly available.');
				$tokens_with_values['LABEL_REQUESTINVALID_KML'] = __('The KmlLayer is invalid.');
				$tokens_with_values['LABEL_TIMEDOUT_KML'] = __('The KML file could not be loaded within a reasonable amount of time.');
				$tokens_with_values['LABEL_TOOLARGE_KML'] = __('The KML file exceeds the file size limits of KmlLayer.');
				$tokens_with_values['LABEL_UNKNOWN_KML'] = __('The KML file failed to load for an unknown reason.');
				$tokens_with_values['LABEL_GOOGLE_APIV2'] = __('<b>ATTENTION</b>! (by Comprehensive Google Map Plugin)<br /><br />Dear blog/website owner,<br />It looks like your webpage has reference to the older Google API v2, in addition to the API v3 used by Comprehensive Google Map! An example of plugin using the older API v2, can be jquery.gmap plugin.<br /><br />Please disable conflicting plugin(s). In the meanwhile, map generation is aborted!');
				$tokens_with_values['LABEL_NO_GOOGLE'] = __('<b>ATTENTION</b>!(by Comprehensive Google Map Plugin)<br /><br />Dear blog/website owner,<br />It looks like Google map API could not be reached. Map generation was aborted!<br /><br />Please check that Google API script was loaded in the HTML source of your web page');

				$global_error_messages_json_template = cgmp_render_template_with_values($tokens_with_values, CGMP_HTML_TEMPLATE_GLOBAL_ERROR_MESSAGES);

				$tokens_with_values = array();
				$tokens_with_values['LABEL_STREETVIEW'] = __('Street View');
				$tokens_with_values['LABEL_ADDRESS'] = __('Address');
				$tokens_with_values['LABEL_DIRECTIONS'] = __('Directions');
				$tokens_with_values['LABEL_TOHERE'] = __('To here');
				$tokens_with_values['LABEL_FROMHERE'] = __('From here');
				$info_bubble_translated_template = cgmp_render_template_with_values($tokens_with_values, CGMP_HTML_TEMPLATE_INFO_BUBBLE);

				echo "<object id='global-data-placeholder' style='width: 0px !important; height: 0px !important'>".PHP_EOL;
				echo "    <param id='sep' name='sep' value='".CGMP_SEP."' />".PHP_EOL;
				echo "    <param id='customMarkersUri' name='customMarkersUri' value='".CGMP_PLUGIN_IMAGES."/markers/' />".PHP_EOL;
				echo "    <param id='errors' name='errors' value='".$global_error_messages_json_template."' />".PHP_EOL;
				echo "    <param id='translations' name='translations' value='".$info_bubble_translated_template."' />".PHP_EOL;
				echo "</object> ".PHP_EOL;
			}
		}
endif;


?>
