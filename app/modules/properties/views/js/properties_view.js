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