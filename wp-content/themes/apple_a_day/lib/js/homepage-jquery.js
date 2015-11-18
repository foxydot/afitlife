jQuery(document).ready(function($) {	
	$('.home-footer div.widget:first-child').addClass('first-child');
	$('.home-footer div.widget:last-child').addClass('last-child');
	$('.home-footer div.widget:nth-child(even)').addClass('even');
	$('.home-footer div.widget:nth-child(odd)').addClass('odd');
	
	var numwidgets = $('.home-footer div.widget').length;
	$('.home-footer').addClass('cols-'+numwidgets);
});