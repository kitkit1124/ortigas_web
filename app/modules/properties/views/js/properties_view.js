$(function() {
    
    $(window).scroll(function() {

        if($(window).width() > 1024 && $(window).height() > $(".stick_side").height() + 90) {
            var footer_section = $('#footer').height() + $(".stick_side").height();
            var footer_position =  $('#footer').offset().top - footer_section;

            if($(window).scrollTop() > 430) {
               
                $(".stick_side").css({
                    "position":"sticky",
                    "top":"120px",
                    "-ms-flex":"0 0 15%",
                    "flex":"0 0 15%",
                    "max-width":"315px"
                });
               
            }

            else if($(window).scrollTop() > footer_position) {
               
                $(".stick_side").css({
                    "position":"absolute",
                    "bottom": $('#footer').height() +'px',

                });  
            }

            else{
                 $(".stick_side").css({
                    "position":"sticky",
                    "top":"unset",
                    "-ms-flex":"unset",
                    "flex":"unset",
                    "max-width":"unset"
                });
            }
        }
    });

    $(window).resize(function(){
        if($(window).width() < 1024) {
            $(".stick_side").css({
                "position":"relative",
                "top":"unset",
                "-ms-flex":"unset",
                "flex":"unset",
                "max-width":"unset"
            });
            $(".related_properties_result").show();
            $(".stick_side").css({"top":"unset"});
            $(".inquiry_border_bottom").css({"height":"3px"});
            $(".inquiry_form").css({"padding-bottom":"20px"});
        }
    });

    $(".regular").slick({
        dots: false,
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 1
    });


    $('.estate_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('#' + anchor);
    });   

    $(".carousel-item").first().addClass('active');
    $(".carousel-indicator_button").first().addClass('active');

    $("#unit-floorplan li").first().children().addClass('active');
    $("#unit-floorplan .tab-content .tab-pane").first().addClass('active').removeClass('fade');

	var id = $('#unit-floorplan li a.active').attr('data-id');
	get_range_size(id);

    $('#unit-floorplan li').click(function() {
    	var id = $('a', this,).attr('data-id');
    	get_range_size(id);
    	$('#range_size').html('&nbsp;');
    });	

    $('#select-floorplan option').first().text('SELECT FLOOR').prop('disabled','disabled');
    $('#select-floorplan2 option').first().text('SELECT FLOOR').prop('disabled','disabled');

    $('#select-floorplan2').change(function() {
        $('#select-floorplan').trigger('change');
    });

    $('#select-floorplan').change(function() {
  
    	if($('#check_available_button').attr('data-action') == "check"){
    		var id = $(this).val();
    	}
    	else{
    		var id = $('#select-floorplan2').val();
    	}

    	get_specific_floor(id);
    	get_available_units(id);
    });

    $('#check_available_button').click(function(){
    	if($(this).attr('data-action') == "check"){
    		$(this).attr('data-action','else');
    		$(this).text('Hide Available Units');


    		$('#unit-img').css({'float':'left'}).animate({
			    width: "50%",
			  }, 500 , function(){
			  	
			  	if($('#select-floorplan').val()){
    				$("#select-floorplan").trigger('change');
    			}else{
    				$("#unit-reserve table").toggle('slide');
    			}
			  });		
    	}
    	 else{
    	 	$(this).attr('data-action','check');
    	 	$(this).text('Check Available Units');
    	 	$('#unit-img').css({'float':'left'}).animate({
			    width: "100%",
			  }, 1500 );

    	 	$("#unit-reserve table").toggle('slide');
    		
    	}    
    	$('.unit-reservation-heading, #select-floorplan').toggle('slide');
    	
    });

    $('.unit_floorplan_thumb').mouseenter(function(){
        $('.unit-floorplan_title').html($(this).attr('data-title'));
    });

    $('#dataprivacy').click(function(){
		if($(this).prop("checked") == true){
			$('#reservation_form button').css('opacity',1).removeAttr('disabled');
		}
		else{
			$('#reservation_form button').css('opacity',.5).prop('disabled','disabled');
		}
    });

    $('#reservation_form form button').click(function(){
    	$('#reservation_form').fadeOut();
    	$('#unit_payment_method').fadeIn();

    });

    $('#unit_payment_method img').click(function(){
    	$('#unit_payment_method img').css('box-shadow', 'none');
    	$(this).css('box-shadow', '0px 0px 5px 5px green');
    })

    $("#reservation_button").click(function(){
    	$.ajax({method: "POST",url: site_url + "properties/properties/save",
    		data: { 
    			res: 0,
    			inq: $('#reservation_inquiry_type').val(),
    			pid: $('#reservation_property_id').val(),
    			uid: $('#reservation_unit_id').val(),
    			nam: $('#reservation_name').val(),
    			ema: $('#reservation_email').val(),
    			mob: $('#reservation_mobile').val(),
    			add: $('#reservation_address').val(),
    			pyg: $("input[name='reservation_payment_method']:checked").val(),

    			[csrf_name]: $('#csrf').val()
    		}
    	});
    });

});

function scrollToAnchor(aid){
    $('html,body').animate({scrollTop: $(aid).offset().top - 150}, 1000);
}


function get_range_size($id){
	
	var id = $id;
	if(id){
		$.ajax({method: "GET",url: site_url + "properties/properties/get_unit_room_size_range",data: { room_id : id } })
		.done(function( data ) {
			data = jQuery.parseJSON(data);
			$.each(data, function( index, value ) {
				if(value.min_size){
					var min_sqf = value.min_size * 10.7639;
					var max_sqf = value.max_size * 10.7639;
					$('#range_size').html(value.min_size + ' - ' + value.max_size + '&nbsp;&nbsp;SQM. | ' + Math.round(min_sqf) + '  - ' + Math.round(max_sqf) + '&nbsp;&nbsp;SQFT.');
                    $('.unit-floorplan_title').hide().html(value.room_type_name).fadeIn();
				}
			});
		});
	} 	
}

function get_specific_floor($id){
	
	var id = $id;
	if(id){
		$.ajax({method: "GET",url: site_url + "properties/properties/get_specific_floor",data: { floor_id : id } })
		.done(function( data ) {
			data = jQuery.parseJSON(data);
			$('#floorplan_image').fadeOut(100, function(){
				$('#floorplan_image')
                    .attr("src", upload_url + data.floor_image)
                    .attr("alt", data.floor_alt_image)
                    .attr("title", data.floor_alt_image);

                $('.floorplan_image_link').attr('href', site_url+'properties/properties/floorplan_image?img='+ upload_url + data.floor_image);

			    $('#floorplan_image').fadeIn(100);
			});
		});
	} 	
}

function get_available_units($id){
	
	var id = $id;
	if(id){
		$.ajax({method: "GET",url: site_url + "properties/properties/get_available_units",data: { floor_id : id } })
		.done(function( data ) {
			data = jQuery.parseJSON(data);

			

		if($('#check_available_button').attr('data-action') != "check"){
			$('#unit-reserve table').html('');
			$('#unit-reserve table').hide();

    		html = '<th>Unit</th><th>SQM</th><th></th>';
			$('#unit-reserve table').append(html);
			$.each(data, function( index, value ) {

               var params = value.unit_id + ",'" + value.unit_number +"'";
				html = '<tr><td>'+ value.unit_number +'</td><td>'+value.unit_size +'</td><td><button onclick="select_unit('+ params +')">Reserve</button></td</tr>';
				$('#unit-reserve table').append(html);
				
			});
			$('#unit-reserve table').fadeIn(500);
    	}    

		
		});
	} 	
}

function select_unit(unit_id,unit_no){

    var unit_num = unit_no.replace("/", "");

	$('#building-floorplan').fadeOut();
	$('#reservation_form').fadeIn();
	$('#reservation_form #reservation_unit_id').val(uid);
	$('#reservation_form #reservation_unit_text').val(uno);

}

function initMap() {
    var myLatlng = new google.maps.LatLng($('#property_latitude').val(), $('#property_longitude').val());
    

    var mapOptions = {
      zoom: parseInt('16'),
      center: myLatlng,
      styles: 	[
                    {
                        "elementType": "geometry",
                        "stylers": [{"color": "#f5f5f5"}]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [{"saturation": -95},{"visibility": "on"}]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#616161"}]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [{"color": "#f5f5f5"}]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#bdbdbd"}]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [{"color": "#eeeeee"}]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#757575"}]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [{"color": "#e5e5e5"}]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#9e9e9e"}]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [{"color": "#ffffff"}]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#757575"}]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [{"color": "#dadada"}]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#616161"}]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#9e9e9e"}]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [{"color": "#e5e5e5"}]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [{"color": "#eeeeee"}]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{"color": "#c9c9c9"}]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#9e9e9e"}]
                    }
                  ]
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

/*    // map marker
    var marker = new google.maps.Marker({
        map: map,
    });
    marker.bindTo('position', map, 'center');*/

/*    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
*/
   /* google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++) {
            bounds.extend(place.geometry.location);
        }

        map.fitBounds(bounds);
        map.setZoom(16);     
        google.maps.event.addListener(map, 'bounds_changed', function() {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);    
            $('#property_latitude').val(map.getCenter().lat());
            $('#property_longitude').val(map.getCenter().lng());
            $('#zoom').val(map.getZoom());
        });
    });*/

    if($('#property_latitude').val() != 0  &&  $('#property_longitude').val() !=0){ 
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        geocodeLatLng(geocoder, map, infowindow);
    }

    
/*    // drag event
    google.maps.event.addListener(map,'dragend',function(event) {
        $('#property_latitude').val(map.getCenter().lat());
        $('#property_longitude').val(map.getCenter().lng());
    });

    // zoom event
    google.maps.event.addListener(map,'zoom_changed',function(event) {
        $('#zoom').val(map.getZoom());
    });*/
}


function geocodeLatLng(geocoder, map, infowindow) {
    var latlng = new google.maps.LatLng($('#property_latitude').val(), $('#property_longitude').val());

    geocoder.geocode({'location': latlng}, function(results, status) {
      if (status === 'OK') {
        if (results[0]) {
          map.setZoom(15);
          var marker = new google.maps.Marker({
            position: latlng,
            map: map
          });
          var formatted_address = results[0].formatted_address
          if(map_name){
            formatted_address = map_name;
          }
          infowindow.setContent(formatted_address);
          infowindow.open(map, marker);
        } else {
          window.alert('No results found');
        }
      } else {
        window.alert('Geocoder failed due to: ' + status);
      }
    });
}