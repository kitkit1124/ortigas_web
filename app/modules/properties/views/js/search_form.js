$(function() {


	$('.property_search .button_search').click(function(){
		searchProperty();
	});

});


function searchProperty(){
	$.ajax({method: "POST",url: site_url + 'properties/search/index',
		data: { 
			location_id	: $('#locations_id').val(),
			dev_id : $('#dev_id').val(),
		
			[csrf_name]: $('#csrfs').val()
		} 
	})
	.done(function(data) {

		var data = jQuery.parseJSON(data);
		if (data.success === false) {
			// shows the error message
		} else {
			window.location.replace(site_url + 'property_search?loc=' + data.location + '&dev=' + data.dev);
		}
	});

	
}

