(function($) {
	$(document).ready(function() {
		// equals home blocks
		$('.primary-home .block-wrap').css({'min-height': $('.secondary-home .block-wrap').css('height')});

		//Slideshow
		var slideLoaded = imagesLoaded($('.slideshow'));
		slideLoaded.on('done', configureSlide);
		$('.slideshow').owlCarousel({
			items:1,
			loop:false,
			center:true,
			margin:10,
			URLhashListener:true,
			onInitialized: configureSlide
		});
	});
	$(window).load(function() {
		//JS
	});
	function configureSlide() {
		$('.slideshow-wrap .col-sm-3').height($('.slideshow-wrap .col-sm-9').height());
	}
})(jQuery);