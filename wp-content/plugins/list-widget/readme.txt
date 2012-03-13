=== List Widget ===
Contributors: frankieroberto
Tags: list, lists, widget
Requires at least: 2.8
Tested up to: 2.9.1
Stable tag: 0.2.2

This plugin makes a widget available which allows you to quick add a simple text list (bulleted or numbered) to a sidebar.

== Installation ==

Install this plugin in the usual way, by downloading and unzipping the folder into your plugins directory (/wp-content/plugins).

The plugin then needs to be activated before it can be used.

To use, simply drag the 'List' widget into a sidebar. To use the widget, your theme must be widget-enabled.

== Frequently Asked Questions ==

= Can I add more than 10 items? =

At the moment, no. This might be introduced in a future version, but for now, 10 is your limit. It seems like a sensible limit, too. Who wants to read more than 10 things in a list anyhow? If your list is longer than this, then perhaps you should ask yourself whether it can be cut down...

= How do I style the list? =

You can style your list by adding the following code to the style.css file in your chosen theme:

    /* Styles for List Widget */
    #sidebar .list_widget ul {} /* Style for unordered list */
    #sidebar .list_widget ol {} /* Style for ordered list */
    #sidebar .list_widget ul li {} /* Style for unordered list item */
    #sidebar .list_widget ol li {}  /* Style for ordered list item */

== Screenshots ==

1. Widget editing interface.
2. How the widget appears in the default theme.

== Changelog ==

= 0.1 =
* Initial upload

= 0.2 =
* Added ability to switch between ordered and unordered lists
* Improved documentation

= 0.2.1 =
* Updated compatibility information.

= 0.2.2 =
* Minor fix.