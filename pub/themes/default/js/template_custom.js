$(document).ready(function(){

   Pace.on('hide', function(){
     $('.navbar, #banner_image, #slider, .container, .content, #footer, #video_label, #footer, .news_related, #news, .recommended_links_container, #roles, #video_player, .image_container img')
     .css({'opacity':'1'});
   
    
    });
      set_banner_position(); 
});

$(document).mouseup(function(e) 
{
    var container = $(".global_search");

    if(!is_sGlobal){
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.fadeOut();
        }
    }
    
});

$(function(){

    $("img.lazy").lazy({
      effect: "fadeIn",
      effectTime: 500,
      threshold: 0
    });

    $('.slick-next').html('next');
    $('.img_link').mouseenter(function(){
        $('.img_link img').hide();
        $('.ul_sub_menu_categ img').attr('src', upload_url + $(this).attr('data-img')).fadeIn(500);;
    });

    // $('.sub_menu_properties li').mouseenter(function(){
    //   $('.ul_sub_menu_categ img').attr('src', upload_url + $(this).attr('data-img'));
    // });


    $(".navbar-toggler").click(function(){
        $("#main_navbar").slideToggle( "slow", function() {
            // Animation complete.
          });
    });

    $('.li_nav_estates_active_list, .li_nav_estates_active_list .a_sub_menu_estates').mouseenter(function(){
        // $('.li_nav_estates_active').css('background-color','#FFF');
    });

    $('.li_nav_estates_active, .nav_estates').mouseenter(function(){
        // $('.li_nav_estates_active').css('background-color','#e6f1eb');
        // $('.global_search').fadeOut()

    });

    $('.li_nav_estates_active, .nav_estates, .li_nav_estates_active_list') .mouseout(function(){
        // $('.li_nav_estates_active').css('background-color','#e6f1eb');
    });


    $('.inquiry_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor, 100);
    });   

    $('.nav_search_button, .close_global_search').click(function(){
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




    $('.subscribe_button').click(function(){

        $.ajax({method: "POST",url: site_url + 'subscribers/subscribers/form',
            data: { 
                subscriber_email     : $('#subscription_email').val(),
                [csrf_name]: $('#csrf').val()
            } 
        })
        .done(function(data) {

            var o = jQuery.parseJSON(data);
            if (o.success === false) {
                // shows the error message
                // alertify.error(o.message);
                 $('#subscribe_denied').trigger('click');
                // displays individual error messages
                if (o.errors) {
                  for (var form_name in o.errors) {

                     $('#error-' + form_name).html(o.errors[form_name]);

                    $('#error-' + form_name + ' .text-danger').append('<i class="fa fa-exclamation-circle" aria-hidden="true"></i>');
                  }
                }
            } else {
                 $('#subscribe_success').trigger('click');

                 $.ajax({method: "GET",url: site_url + 'subscribers/subscribers/form',
                    data: { 
                        subscriber_email     : $('#subscription_email').val(),
                        [csrf_name]: $('#csrf').val()
                    } 
                })

                 

            }
        });

    });

   

    
});

function scrollToAnchor(aid, top){
    var y_axis = $(aid).offset().top;
    y_axis = y_axis - top;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}

   
function searchGlobal(){
    $.ajax({method: "POST",url: site_url + 'properties/search/sglobal',
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
    // $('#banner_logo_image').css('height',$('#banner_image img').height());
}

function set_banner_position(){
    var banner_canvas = $('.estate_banner_img').height();
    var banner_text_canvas = $('#banner_image h1').height();
    var banner_image_canvas = $('.estate_logo_img').height();
    var navbar_canvas = $('.navbar').height();
    var banner_estate_canvas = $('#banner_image h5').height();
    var social_canvas = $('.social_media_properties').height();
    
    if(banner_image_canvas == undefined){ banner_image_canvas = banner_text_canvas; }

    var banner_image_position = (banner_canvas - banner_image_canvas) / 2 + navbar_canvas + 1;
    var banner_text_position = (banner_canvas - banner_text_canvas) / 2;
    var banner_estate_position = (banner_canvas - banner_estate_canvas) / 2 + navbar_canvas - 12 + banner_text_canvas;
    var social_canvas_position = (banner_canvas + banner_image_canvas) / 2 + navbar_canvas;

    $('.banner_gradient').css('height', banner_canvas);
    

    $('.estate_logo_img').css({'top':banner_image_position + 'px'}).fadeIn(500);
    $('#banner_image .banner_margin').css({'top':banner_text_position + 'px'}).fadeIn(500);
    $('#banner_image h5').css({'top':banner_estate_position + 'px'}).fadeIn();


    if($(window).width() <= 1024){
        $('.social_media_properties').css({'top':social_canvas_position + 'px', 'right': 'unset'});
    }
    else{
        $('.social_media_properties').css({'top': '120px'});
    }

}

