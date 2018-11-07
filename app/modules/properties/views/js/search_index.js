$(function() {


	$('.adv_prop_search_link').click(function(){
	
	});


	$('.default_search input').keydown(function(event){
		if(event.keyCode == 13) {
			searchProperty();
		}
	});

	$('.default_search i, .button_search').click(function(){
		searchProperty();
	});



});

function searchProperty(){
	$.ajax({method: "POST",url: post_url,
		data: { 
			filter : $('#keyword').val(),
			location_id	: $('#locations_id').val(),
			category_id	: $('#categories_id').val(),
			price_range_id : $('#price_range_id').val(),
		
			[csrf_name]: $('#csrf').val()
		} 
	})
	.done(function(data) {

		var data = jQuery.parseJSON(data);
		if (data.success === false) {
			// shows the error message
		} else {
			window.location.replace(site_url + 'search?keyword=' + data.filter + '&location=' + data.location + '&category=' + data.category + '&range=' + data.range);
		}
	});

	
}

