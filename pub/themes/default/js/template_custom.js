$(document).ready(function(){
$('.content, #footer, #slider').fadeIn(500);
});
$(function(){

    $(".navbar-toggler").click(function(){
        $("#main_navbar").slideToggle( "slow", function() {
            // Animation complete.
          });
    });

    $('.li_nav_estates_active_list, .li_nav_estates_active_list .a_sub_menu_estates').mouseenter(function(){
        $('.li_nav_estates_active').css('background-color','#FFF');
    });

    $('.li_nav_estates_active, .nav_estates').mouseenter(function(){
        $('.li_nav_estates_active').css('background-color','#e6f1eb');
        // $('.global_search').fadeOut()

    });

    $('.li_nav_estates_active, .nav_estates, .li_nav_estates_active_list') .mouseout(function(){
        $('.li_nav_estates_active').css('background-color','#e6f1eb');
    });


    $('.inquiry_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor, 100);
    });   

    $('.nav_search_button').click(function(){
           $('.global_search').fadeToggle();
    }); 

    $('.nav_search_button_mobile').click(function(){
           $('.global_search').slideToggle();
    }); 

    $('#roles').mouseenter(function(){
         // $('.global_search').fadeOut()
    });


    $('.global_search .default_search input').keydown(function(event){
        if(event.keyCode == 13) {
            searchGlobal();
        }
    });

    $('.global_search .default_search i').click(function(){
        searchGlobal();
    });

    resize()
     set_banner_position()
    $(window).resize(function(){
         resize()
         set_banner_position()
    });

   

    
});

function scrollToAnchor(aid, top){
    var y_axis = $(aid).offset().top;
    y_axis = y_axis - top;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}

   
function searchGlobal(){
    $.ajax({method: "POST",url: site_url + 'properties/search/global',
        data: { 
            keyword : $('#keyword').val(),
            search_filter : $('input[name="global_search_filter"]:checked').val(),
            [csrf_name]: $('#csrf').val(),
        } 
    })
    .done(function(data) {

        var data = jQuery.parseJSON(data);
        if (data.success === false) {
            // shows the error message
        } else {
            window.location.replace(site_url + 'search?keyword=' + data.keyword + '&search_filter=' + data.search_filter);
        }
    });
}


function resize(){
    $('#banner_logo_image').css('height',$('#banner_image img').height());
}

function set_banner_position(){
    var banner_canvas = $('#banner_image img').height();
    var banner_text_canvas = $('#banner_image h1').height();
    var navbar_canvas = $('.navbar').height();
    var banner_estate_canvas = $('#banner_image h5').height();
  //  var social_canvas = $('#.social_media_properties').height();
    
    
    
    var banner_text_position = (banner_canvas - banner_text_canvas) / 2 + navbar_canvas;
    var banner_estate_position = (banner_canvas - banner_estate_canvas) / 2 + navbar_canvas - 6 + banner_text_canvas;
    // var social_canvas_position = (banner_canvas - social_canvas) / 2 + navbar_canvas - 6 + banner_text_canvas ;


    $('#banner_image h1').css({'top':banner_text_position + 'px'});
    $('#banner_image h5').css({'top':banner_estate_position + 'px'});
    // $('.social_media_properties').css({'top':social_canvas_position + 'px'});

}