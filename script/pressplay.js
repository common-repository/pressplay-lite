jQuery(document).ready(function(){
	jQuery('a[href$=".mp3"]').addClass('sm2_button');
	var btn = jQuery('<span class="btn-pressplay">&nbsp;</span>');
	jQuery('.sm2_button').prepend(btn)
});