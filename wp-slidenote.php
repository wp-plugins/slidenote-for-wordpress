<?php
/*
Plugin Name: SlideNote For WordPress
Plugin URI: http://slidenote.info
Description: A plugin for displaying sliding notifications on your WordPress site with both a widget and shortcode. Built on top of jQuery's SlideNote plugin.
Version: 1.2
Author: Tom McFarlin
Author URI: http://tommcfarlin.com
License: GPL2

	Copyright 2010  Tom McFarlin  (email : tom@slidenote.info)

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
 
/*---------------------------------------------------------------*
 * Widget
 *---------------------------------------------------------------*/

class SlideNote_Widget extends WP_Widget {
	
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	function SlideNote_Widget() {
		$widget_ops = array(
			'classname' => 'wp-slidenote-widget',
			'description' => __('A widget for displaying sliding notifications on your WordPress-based site.', 'wp-slidenote')
		);
		$this->WP_Widget('slidenote_widget', 'SlideNote', $widget_ops);
		if(!is_admin()):
			wp_enqueue_style('slidenote-for-wordpress', WP_PLUGIN_URL . '/slidenote-for-wordpress/css/slidenote.widget.css');
			wp_enqueue_script("jquery");
			wp_enqueue_script('jquery.slidenote', WP_PLUGIN_URL . '/slidenote-for-wordpress/javascript/jquery.slidenote.min.js');
		endif;
	} // end constructor
	
	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	function widget($args, $instance) {
		
		extract($args, EXTR_SKIP);
		
		echo $before_widget;

		$where = empty($instance['where']) ? '&nbsp;' : apply_filters('widget_where', $instance['where']);
		$closeImage = empty($instance['closeImage']) ? '&nbsp;' : apply_filters('widget_closeImage', $instance['closeImage']);
		$corner = empty($instance['corner']) ? '&nbsp;' : apply_filters('widget_corner', $instance['corner']);
		$headerText = empty($instance['headerText']) ? '&nbsp;' : apply_filters('widget_headerText', $instance['headerText']);
		$content = empty($instance['contentText']) ? '&nbsp;' : apply_filters('widget_contentText', $instance['contentText']);
		
		?>
		<script type="text/javascript" src="<?php echo WP_PLUGIN_URL . '/slidenote-for-wordpress/javascript/slidenote.widget.js'?>?closeImage=<?php if($closeImage == 'on'): echo WP_PLUGIN_URL . '/slidenote-for-wordpress/images/slidenote.close.png'; endif; ?>&where=<?php echo $where; ?>&corner=<?php echo strtolower($corner); ?>"></script>
		<div class="wp-slidenote">
			<h2>
				<?php echo $headerText; ?>
			</h2>
			<p>
				<?php echo $content; ?>
			</p>
		</div>
		<?php
		
		echo $after_widget;
		
	} // end widget
	
	function update($new_instance, $old_instance) {
	
		$instance = $old_instance;
		
		$instance['where'] = strip_tags(stripslashes($new_instance['where']));
		$instance['closeImage'] = strip_tags(stripslashes($new_instance['closeImage']));
		$instance['corner'] = strip_tags(stripslashes($new_instance['corner']));
		$instance['headerText'] = strip_tags(stripslashes($new_instance['headerText']));
		$instance['contentText'] = strip_tags(stripslashes($new_instance['contentText']));
		
		return $instance;
		
	} // end update
	
	function form($instance) {
		
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'where' => '640',
				'closeImage' => '',
				'corner' => '',
				'headerText' => '',
				'contentText' => ''
			)
		);
		
		$where = strip_tags(stripslashes($instance['where']));
		$closeImage = strip_tags(stripslashes($instance['closeImage']));
		$corner = strip_tags(stripslashes($instance['corner']));
		$headerText = strip_tags(stripslashes($instance['headerText']));
		$contentText = strip_tags(stripslashes($instance['contentText']));
		
		
	?>
		<p>
			<label for="headerText" style="display:block;">
				<?php _e('Header Text:', 'wp-slidenote'); ?>
			</label>
			<input type="text" value="<?php echo attribute_escape($headerText); ?>" id="<?php echo $this->get_field_id('headerText'); ?>" name="<?php echo $this->get_field_name('headerText'); ?>" class="widefat" />
		</p>
		<p>
			<label for="contentText" style="display:block;">
				<?php _e('Content Text:', 'wp-slidenote'); ?>
			</label>
			<input type="text" value="<?php echo attribute_escape($contentText); ?>" id="<?php echo $this->get_field_id('contentText'); ?>" name="<?php echo $this->get_field_name('contentText'); ?>" class="widefat" />
		</p>
		<p>
			<label for="where">
				<?php _e('Where To Display (640 is default)?', 'wp-slidenote'); ?>
			</label>
			<input type="text" value="<?php echo attribute_escape($where); ?>" id="<?php echo $this->get_field_id('where'); ?>" name="<?php echo $this->get_field_name('where'); ?>" class="widefat" />
		</p>
		<p>
			<label for="corner">
				<?php _e('Which corner?', 'wp-slidenote'); ?>
			</label>
			<select id="<?php echo $this->get_field_id('corner'); ?>" name="<?php echo $this->get_field_name('corner'); ?>">
				<option <?php if('left' == $instance['corner']): echo 'selected="selected"'; endif; ?> value="<?php _e('left', 'wp-slidenote'); ?>">
					<?php _e('Left', 'wp-slidenote'); ?>
				</option>
				<option <?php if('right' == $instance['corner']): echo 'selected="selected"'; endif; ?> value="<?php _e('right', 'wp-slidenote'); ?>">
					<?php _e('Right', 'wp-slidenote'); ?>
				</option>
			</select>
		</p>
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('closeImage'); ?>" name="<?php echo $this->get_field_name('closeImage'); ?>" <?php if(strtolower($instance['closeImage']) == 'on'): echo 'checked="yes"'; endif; ?> />
			<label for="cornerImage">
				<?php _e('Display close image?', 'wp-slidenote'); ?>
			</label>
		</p>
	<?php
	} // end form
	
} // end class
add_action('widgets_init', create_function('', 'return register_widget("SlideNote_Widget");'));

/*---------------------------------------------------------------*
 * Short Codes
 *---------------------------------------------------------------*/

function slidenote_func($atts) {
	
	extract(
		shortcode_atts(
			array(
				'where' => '640',
				'corner' => 'left',
				'closeImage' => '',
				'titleelement' => 'h3',
				'title' => '',
				'contentelement' => 'p',
				'content' => ''
			), 
		$atts)
	);
	
	$str = '<script type="text/javascript" src="' . WP_PLUGIN_URL . '/slidenote-for-wordpress/javascript/slidenote.widget.js?closeImage=' . $closeImage . '&where=' . $where . '&corner=' . $corner . '"></script>';
	$str .= '<div class="wp-slidenote"><' . $titleelement . '>' . $title . '</'. $titleelement . '><' . $contentelement . '>' . $content . '</' . $contentelement . '></div>';
	
	return $str;
	
} // end slidenote_func
add_shortcode('slidenote', 'slidenote_func');

?>