(function($) {
	$(document).ready(function() {
		// equals home blocks
		if ($(window).width()>990)
			$('.primary-home .block-wrap').css({'min-height': $('.secondary-home .block-wrap').css('height')});

		//Slideshow
		var slideLoaded = imagesLoaded($('.slideshow'));
		slideLoaded.on('done', configureSlide);
		$elem = $('.slideshow').owlCarousel({
			items:1,
			loop:true,
			center:true,
			margin:10,
			URLhashListener:true,
			onInitialized: progressBar,
			onTranslated : moved,
			onDragged : pauseOnDragging
		});

		//Video play
		$('.play').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$('.play').hide();
			$('.play').parent().addClass('playing');
			$('.play').parent().children('.wp-post-image').hide();
			$('.play').parent().children('.video-wrap').show();
		});

		//Equal heights
		imagesLoaded($('.row.equals')).on('done', function() {
			$(".row.equals").each(function() {
				var heights = $(this).find(".col-sm-6").map(function() {
				    return $(this).outerHeight();
				}).get(), maxHeight = Math.max.apply(null, heights);

				$(this).find(".col-sm-6").outerHeight(maxHeight);
			});
		});
		
	});
	$(window).load(function() {
		//JS
	});
	function configureSlide() {
		$('.slideshow-wrap .col-sm-3').height($('.slideshow-wrap .col-sm-9').height());
	}

	var time = 15; // time in seconds
	var $progressBar,
		$bar, 
		$elem, 
		isPause, 
		tick,
		percentTime;

	function progressBar(event) {
		$progressBar = $("<div>",{id:"progressBar"});
		$bar = $("<div>",{id:"bar"});
		$progressBar.append($bar).appendTo($('.slideshow-wrap'));
		start();
	}
    function start() {
      //reset timer
      percentTime = 0;
      isPause = false;
      //run interval every 0.01 second
      tick = setInterval(interval, 20);
    };
 
    function interval() {
      if(isPause === false){
        percentTime += 1 / time;
        $bar.css({
           width: percentTime+"%"
         });
        if(percentTime >= 100) {
        	moved();
          	$elem.trigger('next.owl.carousel')
        }
      }
    }
 
    //pause while dragging 
    function pauseOnDragging(){
      isPause = true;
    }
 
    //moved callback
    function moved(){
      //clear interval
      clearTimeout(tick);
      //start again
      start();
    }
})(jQuery);