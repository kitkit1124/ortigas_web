	$(document).ready(function(){

		setTimeout(function(){ $('#pac-input').fadeIn(); }, 3000);
		
	});

$(function() {

	$('#form_landing').on('hidden.bs.modal', function () {
      location.reload();
	});

	
	// $('#message_section').change(function(){
	// 	$.ajax({method: "POST",url: "website/contact/get_projects",
	// 		data: { 
	// 			message_section : $(this).val(), 
	// 			[csrf_name]: $('#csrf').val(),
	// 		} 
	// 	})
	// 	.done(function( data ) {
	// 		o = jQuery.parseJSON(data);
	// 		$.each(o, function( index, value ) {
	// 			$('#message_section_id').append('<option value="' + value.property_id + '">' + value.property_name + '</option>');
	// 		});
	// 	});
	// });

	$('#message_section').change(function(){
		var section = $(this).val();

		
	    $("option[value='Please select Inquiry Type']",this).remove();


		if(section=='Sales Inquiry'){
			$.ajax({method: "GET",url: "properties/get_select_properties", data: 'property_availability=true'})
			.done(function( data ) {
				d = jQuery.parseJSON(data);
				$('#message_section_id').html('');
				$('.message_section_id_label').text('SELECT PROJECT');
				$.each(d, function( index, value ) {
					$('#message_section_id').append('<option value="' + value.property_id + '">' + value.property_name + '</option>');
				});
			});
		}
		if(section=='Leasing Inquiry'){
			$.ajax({method: "GET",url: "properties/get_prop_lease"})
			.done(function( data ) {
				d = jQuery.parseJSON(data);
				$('#message_section_id').html('');
				$('.message_section_id_label').text('SELECT SPACES');
				$.each(d, function( index, value ) {
					$('#message_section_id').append('<option value="' + value.lease_id + '">' + value.lease_name + '</option>');
				});
			});
		}
		if(section=='Career Inquiry'){
			$.ajax({method: "GET",url: site_url + "careers_ops/careers_ops/get_careers"})
			.done(function( data ) {
				d = jQuery.parseJSON(data);
				$('#message_section_id').html('');
				if(d){
					$('.message_section_id_label').text('SELECT POSITION');
					$.each(d, function( index, value ) {
						$('#message_section_id').append('<option value="' + value.career_id + '">' + value.career_position_title + ' - ' + value.division_name + '</option>');
					});
				}
				else{
					$('#message_section_id').append('<option value="0">No Jobs Available</option>');
					alertify.error('Careers: No Jobs Available');
				}
			});
		}
	})

	$('#message_agreement').change(function(){
		// if($(this).prop("checked") == true){
		//   $('.contact_submit').removeAttr('disabled');
		// }
		// else{
		//   $('.contact_submit').prop('disabled','disabled');
		// }
	});

	$('.contact_submit').click(function(){

		$.ajax({method: "POST",url: site_url + 'messages/messages/form',
			data: { 
				message_type	    : 'Contact',
				message_section	    : $('#message_section').val(),
				message_section_id	: $('#message_section_id').val(),
				message_name		: $('#message_name').val(),
				message_email		: $('#message_email').val(),
				message_mobile		: $('#message_mobile').val(),
				message_location	: $('#message_location').val(),
				message_content		: $('#message_content').val(),
				message_status  	: 0,

				message_agreement	: $('#message_agreement:checked').val(),
				message_captcha		: grecaptcha.getResponse(), 

				[csrf_name]: $('#csrf').val()
			} 
		})
		.done(function(data) {

			var o = jQuery.parseJSON(data);
			if (o.success === false) {
				// shows the error message
		        // alertify.error(o.message);
		         $('#message_denied').trigger('click')
		         
		        // displays individual error messages
		        if (o.errors) {
		          for (var form_name in o.errors) {
		          	 $('#error-' + form_name).html(o.errors[form_name]);

		            $('#error-' + form_name + ' .text-danger'); //.append('<i class="fa fa-exclamation-circle" aria-hidden="true"></i>');
		          }
		        }
			} else {
           		  $('#message_success').trigger('click');
           		  $('.contact_form form').find("input[type=text], textarea").val("");
           		  // setTimeout(function(){ location.reload(); }, 3000);

			}
		});

	});
});


function initMap() {
	    var myLatlng = new google.maps.LatLng(latitude, longitude);
	    

		var mapOptions = {
	      zoom: parseInt('16'),
	      center: myLatlng,
	    }
	    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

	    // map marker
	    var marker = new google.maps.Marker({
	        map: map,
	    });
	    marker.bindTo('position', map, 'center');

	    // Create the search box and link it to the UI element.
	    var input = document.getElementById('pac-input');
	    var searchBox = new google.maps.places.SearchBox(input);
	    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	    google.maps.event.addListener(searchBox, 'places_changed', function() {
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
	            $('#latitude').val(map.getCenter().lat());
	            $('#longitude').val(map.getCenter().lng());
	            $('#zoom').val(map.getZoom());
	        });
	    });


	     /*   var geocoder = new google.maps.Geocoder;
		    var infowindow = new google.maps.InfoWindow;
		    geocodeLatLng(geocoder, map, infowindow);*/

	    // drag event
	    google.maps.event.addListener(map,'dragend',function(event) {
	        $('#estate_latitude').val(map.getCenter().lat());
	        $('#estate_longtitude').val(map.getCenter().lng());
	    });

	    // zoom event
	    google.maps.event.addListener(map,'zoom_changed',function(event) {
	        $('#zoom').val(map.getZoom());
	    });
	}

	function geocodeLatLng(geocoder, map, infowindow) {
		var latlng = new google.maps.LatLng(latitude, longtitude);

		geocoder.geocode({'location': latlng}, function(results, status) {
		  if (status === 'OK') {
		    if (results[0]) {
		      map.setZoom(15);
		      var marker = new google.maps.Marker({
		        position: latlng,
		        map: map
		      });
		      console.log(results[0]);
		      infowindow.setContent(results[0].formatted_address);
		      infowindow.open(map, marker);
		    } else {
		      window.alert('No results found');
		    }
		  } else {
		    window.alert('Geocoder failed due to: ' + status);
		  }
		});
	}
