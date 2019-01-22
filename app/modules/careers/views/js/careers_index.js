$(function() {

	 $(".carousel-item").first().addClass('active');
	 $(".carousel-indicator_button").first().addClass('active');

	$('.search_tab input').keydown(function(event){
		if(event.keyCode == 13) {
			searchCareer();
			event.preventDefault();
			return false;
		}
	});

	$('.button_search').click(function(){
		searchCareer();
	});
});

function searchCareer(){
	$.ajax({method: "POST",url: 'careers/careers/search', data: $('.search_tab form').serialize() })
	.done(function(data) {

		var data = jQuery.parseJSON(data);
		if (data.success === false) {
			// shows the error message
		} else {

			$('#careers_content .row').html('');
			var html = '';


			$.each(data.result, function( index, value ) {	
				if(value.career_modified_on){ dtpost = value.career_modified_on } else { dtpost = value.career_created_on}		


				var formattedDate = new Date(dtpost);
				var d = formattedDate.getDate();
				var m =  formattedDate.getMonth();
				m += 1;  // JavaScript months are 0-11
				var y = formattedDate.getFullYear();

				html = '<div class="career_box residences col-sm-4"><div class="image_wrapper"><div class="details">'+
				'<p class="title">' + value.career_position_title + '</p>' + 
				'<p class="dept">' + value.department_name +'</p>'+
				'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + '</p>' + 
				'<a href="' + '" class="default-button">View Details</a>'+
				'</div><div class="image_container">'+
				//'<img src="' + site_url +  value.career_image + '" width="100%" alt="" draggable="false"/>'+
				'</div></div></div>';

				$('#careers_content .row').append(html);
			});
		}
	});
}