//Start site scripts:
(function($) {

// Cover behaviour for imgs  
// ---------
    function resizeBg() {
        $("img.cover, .slide .cover").each(function(){
            var theWindow        = $(this).parent(),
                $bg              = $(this),
                aspectRatio      = $bg.width() / $bg.height();
                                        
            
                
                if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
                    $bg
                        .removeClass('bgwidth')
                        .addClass('bgheight');
                } else {
                    $bg
                        .removeClass('bgheight')
                        .addClass('bgwidth');
                }
                            
            
        });
    }

    $(window).on('load', function() { // makes sure the whole site is loaded     

// Hide the close link
        $('.nav-toggle-close').hide();

// Preloader
// ---------    
        $('#preloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({'overflow':'visible'}).delay(120000).removeClass('loading');; 

// Trigger Cover behaviour for imgs and listen to window resizes  
// ---------
        resizeBg();                                  
        $(window).resize(resizeBg).trigger("resize");

    });

// End of on page load events

// Click on most Links: add class for any loading effects
// ---------
    $('a').not('.nav-toggle, .frontpage_more_button, .casestudy_gallery_close, .instagram a, .button').on('click', function() {
        $('body').addClass('loading');
    })

// Click Nav Toggle: Navigation toggler
// --------------------------
    $('.nav-toggle-close').hide();

    $('.nav-toggle').on('click', function(e){
        e.preventDefault();
        $('body').toggleClass('nav-open');
    });

	
// On Scroll: Header scroll minification
// --------------------------
    $(window).scroll(function () {
        // IF we scroll down

        var headsize = 5;        

        if ( $(document).scrollTop() > headsize ) {	 
            if (!$('body').hasClass('header-minimized')) {          
                $('body').addClass('header-minimized');
            }
        } 
        else {
                $('body').removeClass('header-minimized');
        }
    });

// Anchor Link Smooth Scrolling
// ----------------------------
    $(function() {
        $('a.anchorlink').bind('click',function(event){
          var $anchor = $(this);

          $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 45
          }, 1000,'easeInOutExpo');

          event.preventDefault();
        });
    });

// Frontpage Carousel *sigh*
// ----------------------------
	$(document).ready( function() {
		$('.frontpage_hero_carousel .slide:first').addClass('active');
		var i = 1;	
		var amountOfSlides = $('.frontpage_hero_carousel .slide').length;
		function cycleimages()
		{
		    var timeBetweenSlides = 5;  // 1 Seconds
		 	$('.frontpage_hero_carousel .slide.active').removeClass('active');	   	
		   	$('.frontpage_hero_carousel .slide:nth-child(' + i + ')').addClass('active');
		   	//goddamit!
			if(i == amountOfSlides){
				i = 1;
			} else {
				i++;	
			};    	

		    setTimeout(cycleimages, timeBetweenSlides*1000);
		};
		cycleimages(); // execute function
	})

// Gallery Button
// ----------------------------
    $('.gallery-button, .casestudy-header').on('click', function(){
        $('.casestudy_gallery_wrapper').css('display', 'block');
        $('.casestudy_gallery_fullpage').fullpage();
        resizeBg();
    });

    $('.casestudy_gallery_close').on('click', function(e){
    	e.preventDefault();
        $.fn.fullpage.destroy('all');
        $('.casestudy_gallery_wrapper').css('display', 'none');
    })

// Scroll Events
// -----------------------------
	$(window).on('scroll', function(){
		
		// Sticky Sidebar Logo
		if ($('#sidebar').length) {
			var logo_offset = $('#sidebar').offset().top - $(window).scrollTop();
			if ( logo_offset < 0 ){
				$('.sidebar_logo').addClass('sticky');
			}
			else {
				if ( $('.sidebar_logo').hasClass('sticky') ){
					$('.sidebar_logo').removeClass('sticky');
				}
			}
		};

		// Sticky Factsheet
		var factsheet_offset = $('.entry-content').offset().top - $(window).scrollTop();
		if ( factsheet_offset < 0 ){
			$('.factsheet').addClass('sticky');
		}
		else {
			if ( $('.factsheet').hasClass('sticky') ){
				$('.factsheet').removeClass('sticky');
			}
		}

	});
	
})( jQuery );