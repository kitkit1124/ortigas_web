$(function() {
    $('.estate_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor);
    });   
});

function scrollToAnchor(aid){
    $('html,body').animate({scrollTop: $(aid).offset().top}, 1000);
}
