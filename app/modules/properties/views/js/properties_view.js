$(function() {
      
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

    $('#select-floorplan').change(function() {
    	var id = $(this,).val();
    	get_specific_floor(id);
    });
});

function scrollToAnchor(aid){
    $('html,body').animate({scrollTop: $(aid).offset().top}, 1000);
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
				$('#floorplan_image').attr("src", cms_url + data.floor_image);
			    $('#floorplan_image').fadeIn(100);
			});
		});
	} 	
}