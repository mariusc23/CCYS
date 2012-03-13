	<fieldset>
		<legend>Basic Settings</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td><a id="tooltip-marker-width" class="google-map-tooltip-marker" href="javascript:;" title="Width of map placeholder DIV">[?]</a>&nbsp;LABEL_WIDTH</td>
					<td>INPUT_WIDTH</td>
					<td><a id="tooltip-marker-height" class="google-map-tooltip-marker" href="javascript:void(0);" title="Height of map placeholder DIV">[?]</a>&nbsp;LABEL_HEIGHT</td>
					<td>INPUT_HEIGHT</td>
				</tr>
				<tr>
					<td><a id="tooltip-marker-zoom" class="google-map-tooltip-marker" href="javascript:void(0);" title="Defines the resolution of the map view. Zoom levels between 0 (the lowest level, in which the entire world can be seen on one map) to 19 (the highest level, down to individual buildings) are possible within the normal maps view. Zoom levels up to 20 are possible within satellite view. Please note: when using KML or GPX, the zoom needs to be set within the file. Zoom config option does not affect zoom of the map generated from KML/GPX.">[?]</a>&nbsp;LABEL_ZOOM</td>
					<td>INPUT_ZOOM</td>
					<td><a id="tooltip-marker-maptype" class="google-map-tooltip-marker" href="javascript:void(0);" title="The following map types are available in the Google Maps: ROADMAP displays the default road map view, SATELLITE displays Google Earth satellite images, HYBRID displays a mixture of normal and satellite views, TERRAIN displays a physical map based on terrain information">[?]</a>&nbsp;LABEL_MAPTYPE</td>
					<td>SELECT_MAPTYPE</td>
				</tr>
				<tr>
					<td><a id="tooltip-marker-mapalign" class="google-map-tooltip-marker" href="javascript:void(0);" title="Controls alignment of the generated map on the screen: LEFT, RIGHT or CENTER">[?]</a>&nbsp;LABEL_MAPALIGN</td>
					<td>SELECT_MAPALIGN</td>
					<td><a id="tooltip-marker-mapalign" class="google-map-tooltip-marker" href="javascript:void(0);" title="Hint message displayed above the map, telling users if they want to get directions, they should click on map markers. ATM its in English, sorry :( Localization will come soon!">[?]</a>&nbsp;LABEL_DIRECTIONHINT</td>
					<td>SELECT_DIRECTIONHINT</td>
				</tr>
				<tr>
					<td><a id="tooltip-marker-language" class="google-map-tooltip-marker" href="javascript:void(0);" title="The Google Maps API uses the browser's preferred language setting when displaying textual information such as the names for controls, copyright notices, driving directions and labels on maps. In most cases, this is preferable; you usually do not wish to override the user's preferred language setting. However, if you wish to change the Maps API to ignore the browser's language setting and force it to display information in a particular language, you can by selecting on of the available languages in this setting">[?]</a>&nbsp;LABEL_LANGUAGE</td>
					<td>SELECT_LANGUAGE</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>

			</tbody>
		</table>
	</fieldset>
	
	<fieldset>
		<legend>GEO Mashup</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td><a id="tooltip-marker-width" class="google-map-tooltip-marker" href="javascript:;" title="If selected, the generated map will aggregate all markers from other maps created by you in your public published posts. In other words, you get a Geo marker mashup in one map! At the moment, the mashup does not include markers from maps on pages and widgets, posts ONLY">[?]</a>&nbsp;</td>
					<td align="left" colspan="4">
						<span style="float: left !important;">
							HIDDEN_ADDMARKERMASHUPHIDDEN
							INPUT_ADDMARKERMASHUP&nbsp;LABEL_ADDMARKERMASHUP
						</span>
					</td>
				</tr>
				<tr>
					<td align="left" colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="left" colspan="4">
						<span style="float: left !important; text-align: left !important;">
							GEOBUBBLE_ADDMARKERMASHUPBUBBLE
						</span>
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>


	<fieldset>
		<legend>Map Markers</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td colspan="4">
						CUSTOM_ADDMARKERICONS
					</td>
				</tr>
				<tr>
					<td>
						<a id="tooltip-marker-addmarkerinput" class="google-map-tooltip-marker" href="javascript:void(0);" title="You can enter either latitude/longitude seperated by comma, or a fully qualified geographical address. You can also select a custom icon for your marker. If none is selected, default Google marker icon is used - the red pin with black dot. When entering custom marker text, <b>no HTML tags are accepted</b>, all other HTML tags will be stripped. <br /><br />If you wish to insert a hyper link, you can do it using the following format:<br />#Fully qualified URL starting with http(s) followed by space and a link Name#. Please note the opening and closing hash tags. <br />For example: <b>#http://google.com Search Engine#</b> or <br /><b>#http://someblog.com Where I spent last summer#</b>">[?]</a>&nbsp;LABEL_ADDMARKERINPUT
					</td>
					<td colspan="2" style="text-align: left !important;">
						<table class="marker-element-holder" cellspacing="0" cellpadding="0" border="0" style="width: 98% !important;">
							<tbody>
								<tr>
									<td width="" rowspan="2" style="text-align: left;">
										INPUT_ADDMARKERINPUT
									</td>
								</tr>
								<tr>
									<td rowspan="" style="text-align: left;">
										INPUT_LOCATIONADDMARKERINPUT
										INPUT_BUBBLETEXTADDMARKERINPUT
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td>
						BUTTON_ADDMARKER
					</td>
				</tr>
				<tr>
					<!-- <td>&nbsp;</td> -->
					<td colspan="4">
						LIST_ADDMARKERLIST
						INPUT_ADDMARKERLISTHIDDEN
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	

	<fieldset  class="collapsible">
		<legend>KML/GPX/Geo RSS</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>

				<tr>	
					<td><a id="tooltip-marker-kml" class="google-map-tooltip-marker"  href="javascript:void(0);" title="KML/GPX/GeoRSS is a file format used to display geographic data in an earth browser, such as Google Earth, Google Maps, and Google Maps for mobile. Specify a valid URL here to a remote KML file (Can be stored on your blog), thats starts with http(s). The Google Maps API supports the KML, GPX and GeoRSS data formats for displaying geographic information. These data formats are displayed on a map from a publicly accessible KML, GPX or GeoRSS file. Please note, KML configuration *supersedes* address and latitude/longitude settings">[?]</a>&nbsp;LABEL_KML</td>
					<td colspan="3">INPUT_KML</td>
				</tr>

			</tbody>
		</table>
	</fieldset>


	<fieldset  class="collapsible">
		<legend>Map Controls</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td><a id="tooltip-marker-maptypecontrol" class="google-map-tooltip-marker" href="javascript:void(0);" title="The MapType control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by default in the top right corner of the map">[?]</a>&nbsp;LABEL_M_APTYPECONTROL</td>
					<td>SELECT_M_APTYPECONTROL</td>
					<td><a id="tooltip-marker-pancontrol" class="google-map-tooltip-marker"  href="javascript:void(0);" title="The Pan control displays buttons for panning the map. This control appears by default in the top left corner of the map on non-touch devices. The Pan control also allows you to rotate 45° imagery, if available">[?]</a>&nbsp;LABEL_PANCONTROL</td>
					<td>SELECT_PANCONTROL</td>
				</tr>
				<tr>
					<td><a id="tooltip-marker-zoomcontrol" class="google-map-tooltip-marker" href="javascript:void(0);" title="The Zoom control displays a slider (for large maps) or small '+/-' buttons (for small maps) to control the zoom level of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom left corner on touch devices">[?]</a>&nbsp;LABEL_Z_OOMCONTROL</td>
					<td>SELECT_Z_OOMCONTROL</td>
					<td><a id="tooltip-marker-scalecontrol" class="google-map-tooltip-marker" href="javascript:void(0);" title="The Scale control displays a map scale element. This control is not enabled by default">[?]</a>&nbsp;LABEL_SCALECONTROL</td>
					<td>SELECT_SCALECONTROL</td>
				</tr>
				<tr>
					<td><a id="tooltip-marker-streetviewcontrol" class="google-map-tooltip-marker" href="javascript:void(0);" title="The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control appears by default in the top left corner of the map">[?]</a>&nbsp;LABEL_STREETVIEWCONTROL</td>
					<td>SELECT_STREETVIEWCONTROL</td>
					<td><a id="tooltip-marker-scrollwheelcontrol" class="google-map-tooltip-marker" href="javascript:void(0);" title="The Scroll Wheel control enables user to zoom in/out on mouse wheel scroll. This setting has 'disable' setting by default">[?]</a>&nbsp;LABEL_SCROLLWHEELCONTROL</td>
					<td>SELECT_SCROLLWHEELCONTROL</td>
				</tr>
			</tbody>
		</table>
	</fieldset>

	<fieldset  class="collapsible">
		<legend>Map Marker Info Bubbles</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td><a id="tooltip-marker-bubbleautopan" class="google-map-tooltip-marker" href="javascript:void(0);" title="Enables or disables info bubble auto-panning (the map view centers on the info bubble) when marker is clicked">[?]</a>&nbsp;LABEL_BUBBLEAUTOPAN</td>
					<td>SELECT_BUBBLEAUTOPAN</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</fieldset>


	<fieldset class="collapsible">
		<legend>Custom Overlays</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td><a id="tooltip-marker-showbike" class="google-map-tooltip-marker" href="javascript:void(0);" title="A layer showing bike lanes and paths as overlays on a Google Map">[?]</a>&nbsp;LABEL_SHOWBIKE</td>
					<td>SELECT_SHOWBIKE</td>
					<td><a id="tooltip-marker-showtraffic" class="google-map-tooltip-marker" href="javascript:void(0);" title="A layer showing vehicle traffic as overlay on a Google Map">[?]</a>&nbsp;LABEL_SHOWTRAFFIC</td>
					<td>SELECT_SHOWTRAFFIC</td>
				</tr>
			</tbody>
		</table>
	</fieldset>


	<fieldset class="collapsible">
		<legend>Panoramio Library</legend>
		<table class="cgmp-widget-table" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td><a id="tooltip-marker-panoramio" class="google-map-tooltip-marker" href="javascript:void(0);" title="Panoramio (http://www.panoramio.com) is a geolocation-oriented photo sharing website. Accepted photos uploaded to the site can be accessed as a layer in Google Maps. In other words, each photo will be placed on the map like a marker.">[?]</a>&nbsp;LABEL_SHOWPANORAMIO</td>
					<td>SELECT_SHOWPANORAMIO</td>
					<td><a id="tooltip-marker-panoramiouid" class="google-map-tooltip-marker" href="javascript:void(0);" title="If specified, the Panoramio photos displayed on the map, will be filtered based on the specified user ID. Please provide NUMERIC user ID only! NOT the Panoramio user web URL!">[?]</a>&nbsp;LABEL_PANORAMIOUID</td>
					<td>INPUT_PANORAMIOUID</td>
				</tr>
			</tbody>
		</table>
	</fieldset>


    <div align="right"><span style="font-size: 9px;"><a href="admin.php?page=cgmp-documentation">Documentation</a> | <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=CWNZ5P4Z8RTQ8">Donate</a></span></div>
