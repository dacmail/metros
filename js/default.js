(function($) {
	$(document).ready(function() {
		// equals home blocks
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