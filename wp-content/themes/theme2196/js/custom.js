// Rewritten version
// By @mathias, @cheeaun and @jdalton

this.ttips = function(){	
	/* CONFIG */		
		xOffset = 10;
		yOffset = 20;		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$(".display-icons a").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + 10 + "px")
			.css("opacity",0)
		$("#tooltip").animate({opacity:1},300);
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("a.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};

(function(doc) {

var addEvent = 'addEventListener',
type = 'gesturestart',
qsa = 'querySelectorAll',
scales = [1, 1],
meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

function fix() {
meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
doc.removeEventListener(type, fix, true);
}

if ((meta = meta[meta.length - 1]) && addEvent in doc) {
fix();
scales = [.25, 1.6];
doc[addEvent](type, fix, true);
}

}(document));

jQuery(document).ready(function(){
													 
// ---------------------------------------------------------
// Tabs
// ---------------------------------------------------------
jQuery(".tabs").each(function(){

		jQuery(this).find(".tab").hide();
		jQuery(this).find(".tab-menu li:first a").addClass("active").show();
		jQuery(this).find(".tab:first").show();

});

jQuery(".tabs").each(function(){

		jQuery(this).find(".tab-menu a").click(function() {

				jQuery(this).parent().parent().find("a").removeClass("active");
				jQuery(this).addClass("active");
				jQuery(this).parent().parent().parent().parent().find(".tab").hide();
				var activeTab = jQuery(this).attr("href");
				jQuery(activeTab).fadeIn();
				return false;

		});

});


// ---------------------------------------------------------
// Toggle
// ---------------------------------------------------------

jQuery(".toggle").each(function(){

		jQuery(this).find(".box").hide();

});

jQuery(".toggle").each(function(){

		jQuery(this).find(".trigger").click(function() {

				jQuery(this).toggleClass("active").next().stop(true, true).slideToggle("normal");

				return false;

		});

});



jQuery(".recent-posts.team li:nth-child(3n)").addClass("nomargin");
jQuery(".home-page-content .post_list li:nth-child(3n)").addClass("nomargin");
jQuery(".footer-widget .post_list li:nth-child(2n)").addClass("nomargin");


jQuery(".sub-pager a:first").addClass('cur');
jQuery(".product_list_widget li").contents().filter(function(){ return this.nodeType != 1; }).wrap("<b/>");

jQuery("#billing-company").parent().addClass('form-row-first');
jQuery("#billing-euvatno").parent().addClass('form-row-last').after('<div class="clear"></div>');
// ---------------------------------------------------------
// Social Icons
// ---------------------------------------------------------




// ---------------------------------------------------------
// Back to Top
// ---------------------------------------------------------

// fade in #back-top
jQuery(function () {
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-top').fadeIn();
		} else {
			jQuery('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	jQuery('#back-top a').click(function () {
		jQuery('body,html').stop(false, false).animate({
			scrollTop: 0
		}, 800);
		return false;
	});
});


});