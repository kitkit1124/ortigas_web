$(document).ready(function(){

   Pace.on('hide', function(){
     $('.navi-bar, #banner_image, #slider, .container, .content, #footer, #video_label, #footer, .news_related, #news, .recommended_links_container, #roles, #video_player, .image_container img')
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
    $('#new_search .default_search').hide();
    $('#back_to_top_button').hide();

    $("img.lazy").lazy({
      effect: "fadeIn",
      effectTime: 500,
      threshold: 100,            
	  afterLoad: function(element) {
	  $(element).css('background-image','unset');	
      }
    });

    $('.estate_links, .nav_estates').hover(function(){
        $('li.nav-item.base_nav_li:hover ul.ul_sub_menu_categ.owl-carousel .owl-item.active').css('animation-name','unset');
        setTimeout(function(){ 
             $('li.nav-item.base_nav_li:hover ul.ul_sub_menu_categ.owl-carousel .owl-item.active').css('animation-name','fadeIn');
        }, 1);

         $('li.nav-item.base_nav_li:hover ul.ul_sub_menu_categ .li_sub_menu_categ').css('animation-name','unset');
        setTimeout(function(){ 
             $('li.nav-item.base_nav_li:hover ul.ul_sub_menu_categ .li_sub_menu_categ').css('animation-name','fadeIn');
        }, 1);
    });


    $('.owl-carousel').owlCarousel({
        margin: 0,
        nav:true,
        dots:false,
        navText : ["<i class='fa fa-chevron-left owl-prev' aria-hidden='true'></i>","<i class='fa fa-chevron-right owl-next' aria-hidden='true'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })


    $(window).scroll(function() {
       transparent_nav();
    });

        resize();
        set_banner_position();
        transparent_nav();
        set_video_height();

    $(window).resize(function(){
        resize();
        set_banner_position();
        transparent_nav();
        set_video_height();
    });

    $('.navbar-nav li.base_nav_li').mouseover(function(){
        $(".navi-bar").css({"border-bottom":"none"});
    }).mouseout(function(){
       transparent_nav();
    });

    $('.slick-next').html('next');
    $('.img_link').mouseenter(function(){
        $('.img_link .img_holder img').hide();
        $('.ul_sub_menu_categ .img_holder img').attr('src', upload_url + $(this).attr('data-img')).fadeIn(500);;
    });

    $('.sub_menu_properties li').mouseenter(function(){
      $('.ul_sub_menu_categ .img_holder img').attr('src', upload_url + $(this).attr('data-img'));
    });


    $(".navbar-toggler").click(function(){
        $('.global_search').hide(0);
        $('.nav_search_button_mobile').css('opacity','1');
        $("#mobile_navbar").slideToggle(900);
    });

    $('.inquiry_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor, 100);
    });   


    $('#new_search .default_search input').keydown(function(event){
        if(event.keyCode == 13) {
            searchGlobal();
        }
    });

    // $('#new_search .nav_search_button_mobile').click(function(){
    //     $('.global_search').slideToggle();
    // }); 

    $('.close_global_search').click(function(){
        $('.global_search').slideToggle();
        $('.nav_search_button_mobile').css('opacity','1');
    }); 
    

    $('#back_to_top_button').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    })

    $('.nav_search_button').click(function(){
        //    $('.global_search').fadeToggle();
        var x = $('.default_search').animate({
            width: 'toggle'
        });

        $('#new_search').css('opacity','1');

        $('#back_to_top_button').css('opacity','0');

        $(this).hide(0,function(){
            $('.nav_close_button').slideDown()
        });
        
        $('.oclogo_img').css('position','absolute').animate({left: '-200px'});

    }); 

     $('.nav_close_button').click(function(){
        var x = $('.default_search').animate({
            width: 'toggle'
        });

        $(this).hide(0,function(){
            $('.nav_search_button').slideDown(function(){
                $('#back_to_top_button').css('opacity','1');
            })
        });

        $('.oclogo_img').css('position','absolute').animate({left: '20px'});
    });

    $('.nav_search_button_mobile').click(function(){
           $('.global_search').slideToggle();
           $(this).css('opacity','0')
    }); 

    $('.global_search .default_search input').keydown(function(event){
        if(event.keyCode == 13) {
            searchGlobal();
        }
    });

    $('.global_search .default_search i').click(function(){
        searchGlobal();
    });

    // $('.subscribe_button_modal').click(function(){

    //     $.ajax({method: "POST",url: site_url + 'subscribers/subscribers/form',
    //         data: { 
    //             subscriber_email     : $('#subscription_email').val(),
    //             [csrf_name]: $('#csrf').val()
    //         } 
    //     })
    //     .done(function(data) {
    //         var o = jQuery.parseJSON(data);
    //         if (o.success === false) {
    //             // shows the error message
    //             // alertify.error(o.message);
    //              $('#subscribe_denied').trigger('click');
    //             // displays individual error messages
    //             if (o.errors) {
    //               for (var form_name in o.errors) {

    //                  $('#error-' + form_name).html(o.errors[form_name]);

    //                 $('#error-' + form_name + ' .text-danger').append('<i class="fa fa-exclamation-circle" aria-hidden="true"></i>');
    //               }
    //             }
    //         } else {
    //              $('#subscribe_success').trigger('click');

    //              $.ajax({method: "GET",url: site_url + 'subscribers/subscribers/form',
    //                 data: { 
    //                     subscriber_email     : $('#subscription_email').val(),
    //                     [csrf_name]: $('#csrf').val()
    //                 } 
    //             })
    //         }
    //     });
    // });

   

    
});

function scrollToAnchor(aid, top){
    var y_axis = $(aid).offset().top;
    y_axis = y_axis - top;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}

   
function searchGlobal(){
    if($('#keyword').val().length >= 255){
        alertify.error('The search field cannot exceed 255 characters in length.');
    }else{
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
}


function resize(){
    // $('#banner_logo_image').css('height',$('#banner_image img').height());
}

function set_banner_position(){
    var banner_canvas = $('.estate_banner_img').height();
    var banner_text_canvas = $('#banner_image h1').height();
    var banner_image_canvas = $('.estate_logo_img').height();
    var navbar_canvas = $('.navi-bar').height();
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

function img_selector(img,size)
{

   
    if(img.substr(-3) == 'png') {
            src = img.replace(".png", "_"+size+".png"); 
    }
    else{
            src = img.replace(".jpg", "_"+size+".jpg"); 
    }

    return src;
}

function default_theme(){
    $(".navi-bar").css({"background-color": "#f8f9fa", "border-bottom":"1px solid #C0C0C0"});

    $('.oclogo_img img').attr('src',upload_url+'data/images/ortigaslogo.png')

    if(nav_color_theme=="White"){
        // $(".oclogo img").css({"filter": "unset"});
        $("a.nav-link.base_nav.nav_estates").css({"color": "#646263"});
        $(".nav_search_button i, .nav_close_button i").css({"color": "#d3d3d3"});
        //$(".navbar-nav li.base_nav_li:last-child a").css({"border": "2px solid #A9A9A9"});
    }
}



function white_theme(){
    $(".navi-bar").css({"background-color": "transparent", "border-bottom":"1px solid transparent"});

    

    if(nav_color_theme=="White"){
    // $(".oclogo img").css({"filter": "brightness(0) invert(1)"});
    $("a.nav-link.base_nav.nav_estates").css({"color": "#FFF"});
    $(".nav_search_button i, .nav_close_button i").css({"color": "#FFF"});
    //$(".navbar-nav li.base_nav_li:last-child a").css({"border": "2px solid #FFF"});    
    }

    nav_color_override();
}

nav_color_override();

function nav_color_override(){
    if(uri_string == 'oclp-data-privacy-policy' || (uri_string.includes("careers") == true && uri_string.length > 8) || (uri_string.includes("news") == true && uri_string.length > 5) ){
        $('.oclogo_img img').attr('src',upload_url+'data/images/ortigaslogo.png');
        $("a.nav-link.base_nav.nav_estates").css({"color": "#646263"});
        $(".nav_search_button i, .nav_close_button i").css({"color": "#d3d3d3"});
        if(uri_string.includes("news/tags") == true){
            $('.oclogo_img img').attr('src',upload_url+'data/images/ortigaslogo-green-white.svg')
            $("a.nav-link.base_nav.nav_estates").css({"color": "#FFF"});
            $(".nav_search_button i, .nav_close_button i").css({"color": "#FFF"});
        }
    }
    else{
        $('.oclogo_img img').attr('src',upload_url+'data/images/ortigaslogo-green-white.svg')
        // $('.oclogo_img img').attr('src',upload_url+'data/images/ortigaslogo-white.png')
    }
}

function transparent_nav(){
    if($(window).width() > 1170) {
        if($(window).scrollTop() > 80) {
            $('#back_to_top_button').fadeIn(500);
            $('.main_menu').css('display','');
            default_theme();
             
        }
        else{
             
            $('#back_to_top_button').fadeOut(500);
            $('.main_menu').css('display','block');
             $('.oclogo:hover li.nav-item.base_nav_li').css('animation-name','');
        setTimeout(function(){ 
             $('.oclogo:hover li.nav-item.base_nav_li').css('animation-name','');
        }, 1);
            white_theme();
        }
    }
    else{
        default_theme();
    }
}


function set_video_height(){
    var height = $(window).height() - ($(window).height() * 0.27);
    var width = $(window).width();
    $('#video_player').css({'height': height,'width':width});
    $(' #banner_image img, #header_ #slider img').css({'height' : height, 'max-height' : height});
}

function set_property_slider(){
    var width = $('#slider .carousel-indicators img').width();
    $('#slider .carousel-indicators img').css({'height': width});

}
