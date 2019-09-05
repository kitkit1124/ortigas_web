$(function() {
	/*$('.news_filter').click(function(){
    	var oTable = $('#dt-images').dataTable();

    	if($(this).text() == 'ALL'){
    		oTable.fnFilter('');
    	}
    	else{
    		oTable.fnFilter($(this).text());
    	}

    });*/

	var q_string = "";
	if(param_tags){
		q_string = '?tags='+param_tags;
	}

	if(param_date){
		q_string = '?qdate='+param_date;
	}


  	var oTable = $('#dt-images').dataTable({
		"bProcessing": false,
		"lengthChange": false,
        "bFilter": true,
        "bInfo": false,
		"bServerSide": true,
		"sAjaxSource": site_url + "website/news/datatables"+q_string,
		"lengthMenu": [[4, 8, -1], [4, 8, "All"]],
		"pagingType": "simple_numbers",
		"bAutoWidth": false,
		"aaSorting": [[ 0, "ASC" ]],
		"aoColumnDefs": 
		[
			{
				"aTargets": [0],
				"mRender": function (data, type, full) {
		
					div =  '<div class="news_result">';
						div +=  '<div class="row">';
							div +=  '<div class="news_image col-sm-4">';
								div += '<a href="' + site_url + 'news/' + full[2] +'">';
									div += '<img class="lazy" src="' + upload_url + img_selector(full[5],'large') +'" width="100%" draggable="false" alt="' + full[6] + '" title="' + full[6] +'" />';
								div += '</a>';
							div += '</div>';
							div +=  '<div class="news_details col-sm-8">';
								div += '<a class="news_link_img" href="' + site_url + 'news/' + full[2] +'">';
									div +=  '<h2>' + full[1] + '</h2>';
								div += '</a>';
							
								div += '<label>';
									div += '<span class="dtpost"><i>Date Posted '+ full[8] + '</i></span>';
									div += '<i class="fa fa-tag"></i><span class="news_tags" data-news-tag-id="' + full[0] + '"></span>';
								div += '</label>';
							
								div += '<div class="news_text">';
									div += full[7];
								div += '</div>'; 

								div += '<a class="default-button" href="' + site_url + 'news/' + full[2] +'" >';
									div +=  'Read More';
								div += '</a>';

							div += '</div>';
						div += '</div>';
					div += '</div>';
							
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


			$('.news_tags').each(function(){

				var news_tag_obj = $(this);
				var id = $(this).attr('data-news-tag-id');
				var current_tag = '';

				$.ajax({method: "GET",url: site_url + "website/news/get_current_tags",data: { post_id : id } })
				.done(function( data ) {
					data = jQuery.parseJSON(data);
					$.each(data, function( index, value ) {
						if(value.news_tag_name){
							current_tag += ' '+value.news_tag_name+',';
						}
					});

					current_tag = current_tag.slice(0, -1);
					$(news_tag_obj).append(current_tag);
				});
			});


		}
	});

});