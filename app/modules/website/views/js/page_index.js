$(function() {
    $("#carousel .carousel-item").first().addClass('active');
    $("#carousel .carousel-indicator_button").first().addClass('active');
    $(".carousel-inner").click(function(){
    	location.href = $(this).attr('data-link');
    });
});