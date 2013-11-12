jQuery(function() {
	jQuery('.products li img').css({opacity:0});
});

jQuery(window).bind('load', function() {
	 var i = 0;
	 var imgs = jQuery('.products li img').length;
	 var int = setInterval(function() {
		 //console.log(i); check to make sure interval properly stops
		 if(i >= imgs) clearInterval(int);
		 jQuery('.products li img').eq(i).animate({opacity:1}, 300);
		 i++;
	 }, 300);
});