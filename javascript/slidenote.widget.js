/*
 * SlideNote Widget For WordPress
 * A widget for displaying sliding notifications on your WordPres site. Built on top of jQuery's SlideNote plugin.
 *
 * Copyright 2010 Tom McFarlin, http://tommcfarlin.com
 * SlideNote is released under the MIT License
 * SlideNote Widget For WordPress is GPL2
 *
 * More information: http://slidenote.info
 */
jQuery(function($) {
	
	var sCloseImageUrl, iWhere, sCorner;
	$('script').each(function() {
		if($(this).attr('src') !== undefined && $(this).attr('src').indexOf('slidenote.widget.js') !== -1) {
			var aParameters = $(this).attr('src').split('?')[1].split('&');
			sCloseImageUrl = aParameters[0].split('=')[1];
			iWhere = aParameters[1].split('=')[1];
			sCorner = aParameters[2].split('=')[1];
			return;
		}
	});
	
	if(sCloseImageUrl.length === 0) {
		$('div.wp-slidenote').slideNote({
			where: iWhere,
			corner: sCorner
		});
	} else {
		$('div.wp-slidenote').slideNote({
			closeImage: sCloseImageUrl,
			where: iWhere,
			corner: sCorner
		}).children('img').css('float', sCorner === 'left' ? 'right' : 'left').addClass('slidenote_image_left');	
	}
	
});