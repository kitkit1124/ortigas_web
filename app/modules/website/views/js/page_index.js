$(function() {
    $("#carousel .carousel-item").first().addClass('active');
    $("#carousel .carousel-indicator_button").first().addClass('active');
    $(".carousel-inner").click(function(){
    	location.href = $(this).attr('data-link');
    });
 		transparent_nav();
 		set_video_height();

		$(window).scroll(function() {
		   transparent_nav();
		});

		$(window).resize(function() {
		   set_video_height();
		   transparent_nav();
		});
});

function transparent_nav(){
	if($(window).width() > 1170) {
		if($(window).scrollTop() > 120) {
			default_theme();
		}
		else{
			white_theme();
		}
	}
	else{
		default_theme();
	}
}

function set_video_height(){
	var height = $(window).height();
	var width = $(window).width();
	$('#video_player').css({'height': height,'width':width});
	$('#slider img').css({'height' : height, 'max-height' : height});
}

function default_theme(){
	$(".navbar").css({"background-color": "#f8f9fa", "border-bottom":"1px solid #C0C0C0"});

	if(nav_color_theme=="White"){
		$(".oclogo img").css({"filter": "unset"});
		$("a.nav-link.base_nav.nav_estates").css({"color": "rgba(0,0,0,.5)"});
		$(".nav_search_button i").css({"color": "#d3d3d3"});
		//$(".navbar-nav li.base_nav_li:last-child a").css({"border": "2px solid #A9A9A9"});
	}
}

function white_theme(){
	$(".navbar").css({"background-color": "transparent", "border-bottom":"1px solid transparent"});

	if(nav_color_theme=="White"){
	$(".oclogo img").css({"filter": "brightness(0) invert(1)"});
	$("a.nav-link.base_nav.nav_estates").css({"color": "#FFF"});
	$(".nav_search_button i").css({"color": "#FFF"});
	//$(".navbar-nav li.base_nav_li:last-child a").css({"border": "2px solid #FFF"});
	}
}