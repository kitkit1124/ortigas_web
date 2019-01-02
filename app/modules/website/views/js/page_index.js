$(function() {
    $("#carousel .carousel-item").first().addClass('active');
    $("#carousel .carousel-indicator_button").first().addClass('active');

 		transparent_nav();
 		set_video_height();

		$(window).scroll(function() {
		   transparent_nav();
		});

		$(window).resize(function() {
		   set_video_height();
		});

});

function transparent_nav(){
	if($(window).scrollTop() > 120) {
		$(".navbar").css({"background-color": "#f8f9fa", "border-bottom":"1px solid #C0C0C0"});
	}
	else{
		$(".navbar").css({"background-color": "transparent", "border-bottom":"1px solid transparent"});
	}
}

function set_video_height(){
	var height = $(window).height();
	$('.video_division').css('height', height);
	$('#slider img').css({'height' : height, 'max-height' : height});
}