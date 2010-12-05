=== SlideNote For WordPress - Sliding Notifications for WordPress Sites ===
Contributors: tommcfarlin
Donate link: http://slidenote.info/
Tags: javascript, jquery, notifications, effects
Requires at least: 3.0
Tested up to: 3.0.1
Stable tag: 1.2

SlideNote For WordPress is a widget for displaying flexible, customizable sliding notifications.

== Description ==

The SlideNote Widget For WordPress is a widget for displaying flexible, customizable sliding notifications. The plugin
can be used either with shortcodes or a widget. 

SlideNote for WordPress is built on top of the SlideNote jQuery plugin. 

Check out <a href="http://slidenote.info/">SlideNote.info</a> for examples and <a href="http://tommcfarlin.com/category/projects/slidenote/">subscribe to the project's feed</a> to
follow development.

### Example usage for shortcodes

	[slidenote where="100" title="SlideNote For WordPress" content="I'm using SlideNote For WordPress!"]

###  Video Shortcode Options

= where =
At one point in scrolling down the page you wish to display the notification. Default is 640px.
    
    [slidenote where="100"]

= corner =
From which corner to display the notification. Default is left.
    
    [slidenote corner="right"]
		
= closeImage =
The path to the image you wish to use as a close image. If not specified, no close image will be displayed.
    
    [slidenote closeImage="/images/closeImage.png"]
		
= titleElement =
The HTML element with which to wrap the title element. This is used to improve style flexibility. Default value is h3.

	[slidenote titleElement="h2"]
	
= title =
The text to display as the title of the notification.
    
    [slidenote title="SlideNote For WordPress"]
		
= contentElement =
The HTML element with which to wrap the content element. This is used to improve style flexibility. Default value is p.
    
    [slidenote contentElement="span"]

= content =
The text to display as the content of the notification.
    
    [slidenote content="I am using SlideNote For WordPress"]
		
== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Begin using the plugin with shortcodes or the included widgets.

== Frequently Asked Questions ==

= Where can I customize the look and feel of the widget? =

Locate the the wp-slidenote.css in the /plugins/wp-slidenote/css/ directory. All style is located in this file.

= Where is the JavaScript source code that initiates the widget? =

The source file for setting up the widget is located at /plugins/wp-slidenote/javascript/slidenote.widget.js.

= The notifications look weird when I use the shortcodes and the widget. Why? =

The shortcodes aren't intended to be used in conjunction with the widget. Currently, the plugin supports
only one or the other.

== Screenshots ==

1. Example SlideNote Notification

== Changelog ==

= 1.2 =
* Updated the JavaSource for properly evaluating script attributes

= 1.1 =
* Fixing a bug for the closeImage property in the shortcode

= 1.0 =
* Initial release