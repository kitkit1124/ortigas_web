$(function() {
    $('.estate_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor);
    });   
});



function scrollToAnchor(aid){
	var y_axis = $(aid).offset().top;
	y_axis = y_axis - 210;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}
