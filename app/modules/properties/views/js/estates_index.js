$(function() {
    
    $('#location_id').change(function(){
    	searchEstate($(this).val());
    });
});


function searchEstate(id){
	
	$.ajax({method: "POST",url: site_url + 'properties/categories/search',
		data: { 
			location_id	: $('#location_id').val(),
			category_name : category_name,
			[csrf_name]: $('#csrf').val()
		} 
	})
	.done(function(data) {

		var data = jQuery.parseJSON(data);
		if (data.success === false) {
			// shows the error message
		} else {

			$('.properties_of_estate').html('');
			var html = '';


			$.each(data.result, function( index, value ) {	
				if(value.career_modified_on){ dtpost = value.career_modified_on } else { dtpost = value.career_created_on}		

				html = '<div class="estates properties col-sm-4">'+
				'<a href="' + site_url + '"estates/property/"' + value.property_slug + '">'+
				'<div class="image_wrapper">'+
				'<div class="image_container">'+
				'<img src="' + upload_url +  value.property_image + '" width="100%" alt="" draggable="false"/>'+
				'</div>'+
				'</div>'+
				'<div class="property_content_wrapper">'+
				'<div class="property_title">'+ value.property_name +'</div>'+
				'<div class="estate_title_dup">'+ value.estate_name +'</div>'+
				'<div class="estate_content">'+ value.estate_text +'</div>'+
				'</div>'+
				'</a></div>';

				$('.properties_of_estate').append(html);
			});
		}
	});
}

				