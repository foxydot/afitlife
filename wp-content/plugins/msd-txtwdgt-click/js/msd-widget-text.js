jQuery(document).ready(function($) {	
	$('.msd-widget-text').parent().css('position','relative');
	$('.msd-widget-text').height(function(){
		return $(this).parent().height()+40;
	});
	$('.msd-widget-text').width(function(){
		return $(this).parent().width();
	});
});