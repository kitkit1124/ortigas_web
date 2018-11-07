$(function(){
    $('.li_nav_estates_active_list, .li_nav_estates_active_list .a_sub_menu_estates').mouseenter(function(){
        $('.li_nav_estates_active').css('background-color','#FFF');
    });

    $('.li_nav_estates_active, .nav_estates').mouseenter(function(){
        $('.li_nav_estates_active').css('background-color','#e6f1eb');
    });

     $('.li_nav_estates_active, .nav_estates, .li_nav_estates_active_list') .mouseout(function(){
        $('.li_nav_estates_active').css('background-color','#e6f1eb');
    });


    $('.inquiry_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor, 100);
    });   

   /* $( window ).scroll(function() {
  
        if ($(window).scrollTop() > 130){
         $('.navbar').css({'padding-top': '10px', 'padding-bottom' : '10px'});
         $('.oclogo').css({'width': 'auto', 'top' : '3px'});
        }
        else{
           $('.navbar').css({'padding-top': '80px', 'padding-bottom' : '0px'});
            $('.oclogo').css({'width': '100%', 'top' : '15px'});
        }
    });*/
});

function scrollToAnchor(aid, top){
    var y_axis = $(aid).offset().top;
    y_axis = y_axis - top;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}
