$(function() {
    $('.estate_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor);
    });   

     $(".regular").slick({
        dots: false,
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 1
    });
     
});



function scrollToAnchor(aid){
	var y_axis = $(aid).offset().top;
	y_axis = y_axis - 210;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}


function initMap() {
    var myLatlng = new google.maps.LatLng($('#estate_latitude').val(), $('#estate_longtitude').val());
    

	var mapOptions = {
      zoom: parseInt('16'),
      center: myLatlng,
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

/*    // map marker
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
            $('#estate_latitude').val(map.getCenter().lat());
            $('#estate_longtitude').val(map.getCenter().lng());
            $('#zoom').val(map.getZoom());
        });
    });*/

    if($('#estate_latitude').val() != 0  &&  $('#estate_longtitude').val() !=0){ 
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        geocodeLatLng(geocoder, map, infowindow);
    }
    
    // // drag event
    // google.maps.event.addListener(map,'dragend',function(event) {
    //     $('#estate_latitude').val(map.getCenter().lat());
    //     $('#estate_longtitude').val(map.getCenter().lng());
    // });

    // // zoom event
    // google.maps.event.addListener(map,'zoom_changed',function(event) {
    //     $('#zoom').val(map.getZoom());
    // });
}

function geocodeLatLng(geocoder, map, infowindow) {
	var latlng = new google.maps.LatLng($('#estate_latitude').val(), $('#estate_longtitude').val());

	geocoder.geocode({'location': latlng}, function(results, status) {
	  if (status === 'OK') {
	    if (results[0]) {
	      map.setZoom(15);
	      var marker = new google.maps.Marker({
	        position: latlng,
	        map: map
	      });
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