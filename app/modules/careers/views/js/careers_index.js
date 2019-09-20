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

	$('.no_career_div h2, .no_career_div p').removeAttr('style');

});

var screen = 'wide';

(function($) {
	$("#narrow").hide();

    var $window = $(window),
        $html = $('html');

    function resize() {
        if ($window.width() <= 991) {
			$("#wide").hide();
			$("#narrow").show();
			screen = 'narrow';
        }else{
			$("#narrow").hide();
			$("#wide").show();
			screen = 'wide';
		}
    }

    $window
        .resize(resize)
        .trigger('resize');
})(jQuery);

function searchCareer(){
	$.ajax({method: "POST",url: site_url+ 'careers_ops/careers_ops/search', data: $('.search_tab form').serialize() })
	.done(function(data) {

		var data = jQuery.parseJSON(data);
		if (data.success === false) {
			// shows the error message
		} else {

			$('#careers_content .row').html('');
			$('.found_no_career').hide();
			var html = '';
			var ctr = 0;
			if(data.result){
				$.each(data.result, function( index, value ) {	
					if(value.career_modified_on){ dtpost = value.career_modified_on } else { dtpost = value.career_created_on}		
					

					var formattedDate = new Date(dtpost);
					var d = formattedDate.getDate();
					var m =  formattedDate.getMonth();
					m += 1;  // JavaScript months are 0-11
					var y = formattedDate.getFullYear();
					console.log(upload_url +  value.career_image);
					if(ctr%2){
						html = '<div class="career_box col-md-6"><div class="image_wrapper"><div class="details">'+
						'<p class="title">' + value.career_position_title + '</p>' + 
						'<p class="dept">' + value.department_name +'</p>'+
						'<p class="divi">' + value.division_name +'</p>'+
						'<p class="dtpost">Date Posted ' + dtpost +'</p>'+
						'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + '</p>' + 
						'<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="default-button">View Details</a>'+
						'</div></div></div>'+
						'<div class="career_box col-md-6"><div class="image_wrapper">'+
						'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  value.career_image + '"  alt="' + value.career_alt_image + '"  title="' + value.career_alt_image + '" draggable="false"/>'+
						'</div></div>';
						ctr++;
					}
					else{
						html = '</div></div></div>'+
						'<div class="career_box col-md-6"><div class="image_wrapper">'+
						'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  value.career_image + '"  alt="' + value.career_alt_image + '"  title="' + value.career_alt_image + '" draggable="false"/>'+
						'</div></div>'+
						'<div class="career_box col-md-6"><div class="image_wrapper"><div class="details">'+
						'<p class="title">' + value.career_position_title + '</p>' + 
						'<p class="dept">' + value.department_name +'</p>'+
						'<p class="divi">' + value.division_name +'</p>'+
						'<p class="dtpost">Date Posted ' + dtpost +'</p>'+
						'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + '</p>' + 
						'<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="default-button">View Details</a>';
						ctr++;
					}
					
					$('#careers_content #wide.row').append(html);

					html = '<div class="card col-sm-12 career_box border-0">'+
					'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  value.career_image + '"  alt="' + value.career_alt_image + '"  title="' + value.career_alt_image + '" draggable="false"/>'+
					'<div class="card-body details px-0">'+
					'<p class="title">' + value.career_position_title + '</p>' + 
					'<p class="dept">' + value.department_name +'</p>'+
					'<p class="divi">' + value.division_name +'</p>'+
					'<p class="dtpost">Date Posted ' + dtpost +'</p>'+
					'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + 
					'<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="button default-button-2 pull pull-right mt-0">View Details</a>'+
					'</p></div></div>';
					
					$('#careers_content #narrow.row').append(html);
				});
			}
			else{
				$('.found_no_career').fadeIn(500);
			}
		}
	});
}