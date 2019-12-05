$(function() {
    $("#carousel .carousel-item").first().addClass('active');
    $("#carousel .carousel-indicator_button").first().addClass('active');
    $(".carousel-inner").click(function(){
    	location.href = $(this).attr('data-link');
    });

    $('.scroll_down').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('#' + anchor);

    });

    function scrollToAnchor(hash){
	    $('html,body').animate({scrollTop: $(hash).offset().top - 120}, 1000);
	}

});