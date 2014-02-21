(function ($) {
	"use strict";
    //superfish menu
    $(function () {
        $('ul.sf-menu').superfish({
		delay: 1000,
		animation:  {
			opacity:'show',
			height:'show'
			},
		disableHI:  false
		});
    });
    //prettyphoto		
    $("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
        theme: 'pp_default',
        default_width: 500,
        overlay_gallery: true
    });
	//comment form box click function
	var $submit_button;
	var $website_box;
	$submit_button = $(".form-submit #submit");
	$website_box = $(".last-input input");
	$submit_button.click(function() {
            if( $website_box.attr("value") === "Website" ) {
 
                // Set it to an empty string
                $website_box.attr("value", "");
            }
	});
	
	//initialize twitter feed
    $(function () {
		var $twitts = $('.twitter-feed').children('.tweet');
		var i = 0;
		if($twitts.eq(i).height() > 50)
			$twitts.eq(i).css('marginTop', -10)
		setInterval(function(){
			$twitts.eq(i).fadeOut(200);
			i = ++i == $twitts.length ? 0 : i;
			$twitts.eq(i).delay(200).fadeIn(200);
			if($twitts.eq(i).height() > 50) 
				$twitts.eq(i).css('marginTop', -10);
			else
				$twitts.eq(i).css('marginTop', 0);
		}, 5000);
	});
})(jQuery);

/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */