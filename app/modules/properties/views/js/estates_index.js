$(function() {
    
    $('#location_id').change(function(){
    	var oTable = $('#dt-images').dataTable();
    	oTable.fnFilter($(this).val());

    });

 	$('#dt-images').fadeIn(2000);

   	var oTable = $('#dt-images').dataTable({
		"bProcessing": false,
		"lengthChange": false,
        "bFilter": true,
        "bInfo": false,
		"bServerSide": true,
		"sAjaxSource": site_url + "properties/categories/datatables?category="+category_name+"&location_id="+location_id,
		"lengthMenu": [[6, 8, -1], [6, 8, "All"]],
		"pagingType": "simple_numbers",
		"bAutoWidth": false,
		"aaSorting": [[ 0, "ASC" ]],
		"aoColumnDefs": 
		[
			{
				"aTargets": [0],
				"mRender": function (data, type, full) {

					var price ='&nbsp;';
					if(full[24]){
						price = full[24].replace("000000","M");
						price = price.replace("500000",".5M");
						price = 'PRICE STARTS AT PHP '+ price;
					}

					div =  '<div class="estates properties col-lg-6">';
						div += '<a href="' + site_url + 'estates/property/' + full[5] +'">';
							div += '<div class="image_wrapper">';
								div += '<div class="image_container">';
									div += '<img class="lazy" src="' + upload_url + img_selector(full[7],'large') +'" width="100%" draggable="false" alt="' + full[22] + '" title="' + full[22] +'" />';
								div += '</div>'; //image_container
							div += '</div>'; //image_wrapper

							div += '<div class="property_content_wrapper">';
								div += '<div class="property_title">'+ full[1] +'<span><i class="fa fa-map-marker" aria-hidden="true"></i> '+ full[4] + '</span></div>';
								div += '<div class="estate_title_dup">'+ full[2] +'</div>';
								div += '<div class="property_price"><i>'+ price +'</i></div>';
								div += '<div class="estate_content">'+ full[23] +'</div>';
							div += '</div>'; //property_content_wrapper
					
						div += '</a>';
					div += '</div>' ; //estates

					return div;
				},
			},
			{
				"aTargets": [1,2,3,4,5,6,7,8,9,10],
				"mRender": function (data, type, full) {
					return '<span style="display:none;">' + data + '</span>';
				},
			},
		],
		"fnDrawCallback": function( oTable ) {
			// hide the table
			$('#dt-images').hide();

			// then recreate the table as divs
			var html = '';
			$('tr', this).each(function() {
				$('td', this).each(function() {
					html += $(this).html();
					// console.log(html);
				});
			});

			$('#thumbnails').html(html);
		}
	});


});

function searchEstate(id){

/*	$.ajax({method: "POST",url: site_url + 'properties/categories/search',
		data: { 
			location_id	: $('#location_id').val(),
			category_name : category_name,
			[csrf_name]: $('#csrf').val()
		}	}) 

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
				'<div class="estate_content">'+ value.estate_snippet_quote +'</div>'+
				'</div>'+
				'</a></div>';

				$('.properties_of_estate').append(html);
			});
		}
	});*/
}