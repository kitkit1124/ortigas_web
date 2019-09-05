$(function() {
	 $(".carousel-item").first().addClass('active');
	 $(".carousel-indicator_button").first().addClass('active');


    set_slider_position()

    $(window).resize(function(){
         set_slider_position()
    });
});


function set_slider_position(){
    var slider_canvas = $('#slider img').height();
    var slider_text_canvas = $('#slider h3').height();
    var slider_text_position = (slider_canvas - slider_text_canvas) / 2;
    $('#slider .banner_margin').css({'top': slider_text_position + 'px'});
}