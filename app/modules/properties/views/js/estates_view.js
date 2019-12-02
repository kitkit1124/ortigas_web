$(function() {
    $('.estate_button').click(function(){
        var anchor = $(this).attr('data-anchor');
        scrollToAnchor('.' + anchor);
    });   

     $(".regular").slick({
        dots: false,
        infinite: false,
        slidesToShow: 7,
        slidesToScroll: 1
    });
     
});



function scrollToAnchor(aid){
	var y_axis = $(aid).offset().top;
	y_axis = y_axis - 260;
    $('html,body').animate({scrollTop: y_axis}, 1000);
}


function initMap() {
    var myLatlng = new google.maps.LatLng($('#estate_latitude').val(), $('#estate_longtitude').val());
    

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