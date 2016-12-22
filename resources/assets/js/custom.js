var app = {};
app.host = 'http://api.blazbluz.com/v1/';
app.handleError = function(data) {
	var message;
	if (typeof data === 'string') {
		message = data;
	} else {
		message = "<ul>";
		$.each(data, function(index, value) {
			message += "<li>" + value + "</li>";
		});
		message += "</ul>";
	}
	return message;
};

$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
		loop:true,
	    margin:15,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:2,
	            nav:true,
	            dots:false
	        }
	    },
	    navClass: ['fa fa-chevron-left fa-2x owl-prev', 'fa fa-chevron-right fa-2x owl-next'],
	    navText: [ '', '' ]
	});

	$('.play-video').magnificPopup({
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});
	new WOW().init();

	$('.countdown').downCount({
        date: '06/06/2016 23:59:00' // m/d/y
    });

    $('.zoom').magnify();
    $('.select-image').click(function(e) {
    	e.preventDefault();
    	$('.select-image').removeClass('active');
    	$(this).addClass('active');
    	var img = $(this).attr('data-img');

    	$('.preview-zoom a').attr('href', img);
    	$('.preview-zoom img').attr('src', img);
    	$('.preview-zoom .magnify-lens').css({'background': 'url(' + img + ')'});

    	$('html, body').animate({
	        scrollTop: $(".preview-zoom").offset().top
	    }, 500);
    });

    $('.coupon-open').click(function(e) {
    	e.preventDefault();
    	$(this).fadeOut(500);
    	$('.form-coupon').delay(400).fadeIn(500);
    });
});

