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

var counter = 0;
var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

var wideTable = $('#widetable').dataTable({
	"bProcessing": false,
	"lengthChange": false,
	"bFilter": false,
	"bInfo": false,
	"bServerSide": true,
	"sAjaxSource": site_url + "careers/datatables/",
	"aoAjaxData": $('.search_tab form').serialize(),
	"pageLength" : 6,
	// "lengthMenu": [[9, 18, -1], [9, 18, "All"]],
	"pagingType": "simple_numbers",
	"bAutoWidth": false,
	"aaSorting": [[ 0, "ASC" ]],
	"aoColumnDefs": 
	[
		{
			"aTargets": [0],
			"mRender": function (data, type, full) {
				counter++;
				if(counter%2){
					var direct = 'flex-row-reverse';
				} else{
					var direct = 'flex-row';
				}

				if(full[17]==null || full[17]==''){
					var posted = full[16];
				}else{
					var posted = full[17];
				}

				var date = new Date(posted);
				var day = date.getDate();
				var month = date.getMonth();
				var year = date.getFullYear();
				var date_posted = monthNames[month]+' '+day+', '+year;

				div = '<div class="container row col-md-12 '+direct+'">';
					div +=	'<div class="career_box col-md-6">';
						div +=	'<div class="image_wrapper">';
							div +=	'<div class="details">';
								div +=	'<p class="title">' + full[1] + '</p>' ; 
								div +=	'<p class="dept">' + full[4] +'</p>';
								div +=	'<p class="divi">' + full[6] +'</p>';
								div +=	'<p class="dtpost">Date Posted ' + date_posted +'</p>';
								div +=	'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + full[10] +'</p>';
								div +=	'<a href="' + site_url + 'careers/'+full[7]+'/'+full[2]+'" class="default-button">View Details</a>';
							div +=	'</div>';	
						div +=	'</div>';
					div +=	'</div>';
					div +=	'<div class="career_box col-md-6">';
						div +=	'<div class="image_wrapper">';
							div +=	'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  full[13] + '"  alt="' + full[14] + '"  title="' + full[14] + '" draggable="false"/>';
						div +=	'</div>';	
					div +=	'</div>';
				div +=	'</div>';
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
	"fnDrawCallback": function( wideTable ) {
		// hide the table

		$('#widetable').hide();

		// then recreate the table as divs
		var html = '';
		$('tr', this).each(function() {
			$('td', this).each(function() {
				html += $(this).html();
				// console.log(html);
			});
		});

		$('#wide').html(html);
	}
});

var narrowTable = $('#narrowtable').dataTable({
	"bProcessing": false,
	"lengthChange": false,
	"bFilter": false,
	"bInfo": false,
	"bServerSide": true,
	"sAjaxSource": site_url + "careers/datatables/",
	"pageLength" : 6,
	// "lengthMenu": [[9, 18, -1], [9, 18, "All"]],
	"pagingType": "simple_numbers",
	"bAutoWidth": false,
	"aaSorting": [[ 0, "ASC" ]],
	"aoColumnDefs": 
	[
		{
			"aTargets": [0],
			"mRender": function (data, type, full) {

				if(full[17]==null || full[17]==''){
					var posted = full[16];
				}else{
					var posted = full[17];
				}

				var date = new Date(posted);
				var day = date.getDate();
				var month = date.getMonth();
				var year = date.getFullYear();
				var date_posted = monthNames[month]+' '+day+', '+year;

				div = '<div class="card col-sm-12 career_box border-0">';
					div +=	'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  full[13] + '"  alt="' + full[14] + '"  title="' + full[14] + '" draggable="false"/>';
					div +=	'<div class="card-body details px-0">';
						div +=	'<p class="title">' + full[1] + '</p>' ; 
						div +=	'<p class="dept">' + full[4] +'</p>';
						div +=	'<p class="divi">' + full[6] +'</p>';
						div +=	'<p class="dtpost">Date Posted ' + date_posted +'</p>';
						div +=	'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + full[10];
						div +=	'<a href="' + site_url + 'careers/'+full[7]+'/'+full[2]+'" class="button default-button-2 pull pull-right mt-0">View Details</a>';
						div +=	'</p>';
					div +=	'</div>';
				div +=	'</div>';
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
	"fnDrawCallback": function( narrowTable ) {
		// hide the table

		$('#narrowtable').hide();

		// then recreate the table as divs
		var html = '';
		$('tr', this).each(function() {
			$('td', this).each(function() {
				html += $(this).html();
				// console.log(html);
			});
		});

		$('#narrow').html(html);
	}
});

var allTable = $('#allTable').dataTable({
	"bProcessing": false,
	"lengthChange": false,
	"bFilter": false,
	"bInfo": false,
	"bServerSide": true,
	"sAjaxSource": site_url + "careers/datatables/",
	"pageLength" : 6,
	// "lengthMenu": [[9, 18, -1], [9, 18, "All"]],
	"pagingType": "simple_numbers",
	"bAutoWidth": false,
	"aaSorting": [[ 0, "ASC" ]],
	"aoColumnDefs": 
	[
		{
			"aTargets": [0],
			"mRender": function (data, type, full) {

				if(full[17]==null || full[17]==''){
					var posted = full[16];
				}else{
					var posted = full[17];
				}

				var date = new Date(posted);
				var day = date.getDate();
				var month = date.getMonth();
				var year = date.getFullYear();
				var date_posted = monthNames[month]+' '+day+', '+year;

				div = '<div class="col-md-4">';
					div +=	'<div class="card p-0 border-0 shadow rounded-0">';
						div +=	'<div class="card-header border-0 text-center font-weight-bold">';
							div +=	'<span class="title text-uppercase">' + full[1] + '</span>' ; 
						div +=	'</div>';

						div +=	'<div class="card-body details">';
							div +=	'<p class="dept">' + full[4] +'</p>';
							div +=	'<p class="dtpost">Date Posted ' + date_posted +'</p>';
							div +=	'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + full[10]+'</p>';
							div +=	'<a href="' + site_url + 'careers/'+full[7]+'/'+full[2]+'" class="button default-button-2 pull pull-right mt-0">View Details</a>';
						div +=	'</div>';
					div +=	'</div>';
				div +=	'</div>';
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
	"fnDrawCallback": function( narrowTable ) {
		// hide the table

		$('#allTable').hide();

		// then recreate the table as divs
		var html = '';
		$('tr', this).each(function() {
			$('td', this).each(function() {
				html += $(this).html();
				// console.log(html);
			});
		});

		$('#alldiv').html(html);
	}
});

var screen = 'wide';

(function($) {
	$("#narrow").hide();
	$("#narrowtable_wrapper").hide();

    var $window = $(window),
        $html = $('html');

    function resize() {
        if ($window.width() <= 991) {
			$("#wide").hide();
			$("#widetable_wrapper").hide();
			$("#narrow").show();
			$("#narrowtable_wrapper").show();
			screen = 'narrow';
        }else{
			$("#narrow").hide();
			$("#narrowtable_wrapper").hide();
			$("#wide").show();
			$("#widetable_wrapper").show();
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
					// m += 1;  // JavaScript months are 0-11
					var y = formattedDate.getFullYear();
					var date_posted = monthNames[m]+' '+d+', '+y;

					// console.log(upload_url +  value.career_image);
					// if(ctr%2){
					// 	html = '<div class="career_box col-md-6"><div class="image_wrapper"><div class="details">'+
					// 	'<p class="title">' + value.career_position_title + '</p>' + 
					// 	'<p class="dept">' + value.department_name +'</p>'+
					// 	'<p class="divi">' + value.division_name +'</p>'+
					// 	'<p class="dtpost">Date Posted ' + dtpost +'</p>'+
					// 	'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + '</p>' + 
					// 	'<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="default-button">View Details</a>'+
					// 	'</div></div></div>'+
					// 	'<div class="career_box col-md-6"><div class="image_wrapper">'+
					// 	'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  value.career_image + '"  alt="' + value.career_alt_image + '"  title="' + value.career_alt_image + '" draggable="false"/>'+
					// 	'</div></div>';
					// 	ctr++;
					// }
					// else{
					// 	html = '</div></div></div>'+
					// 	'<div class="career_box col-md-6"><div class="image_wrapper">'+
					// 	'<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  value.career_image + '"  alt="' + value.career_alt_image + '"  title="' + value.career_alt_image + '" draggable="false"/>'+
					// 	'</div></div>'+
					// 	'<div class="career_box col-md-6"><div class="image_wrapper"><div class="details">'+
					// 	'<p class="title">' + value.career_position_title + '</p>' + 
					// 	'<p class="dept">' + value.department_name +'</p>'+
					// 	'<p class="divi">' + value.division_name +'</p>'+
					// 	'<p class="dtpost">Date Posted ' + dtpost +'</p>'+
					// 	'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + '</p>' + 
					// 	'<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="default-button">View Details</a>';
					// 	ctr++;
					// }
					
					// $('#careers_content #wide.row').append(html);

					// html = '<div class="card col-sm-12 career_box border-0">'+
					// '<img class="estate_banner_img lazy mh-100 mw-100" src="' + upload_url +  value.career_image + '"  alt="' + value.career_alt_image + '"  title="' + value.career_alt_image + '" draggable="false"/>'+
					// '<div class="card-body details px-0">'+
					// '<p class="title">' + value.career_position_title + '</p>' + 
					// '<p class="dept">' + value.department_name +'</p>'+
					// '<p class="divi">' + value.division_name +'</p>'+
					// '<p class="dtpost">Date Posted ' + dtpost +'</p>'+
					// '<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location + 
					// '<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="button default-button-2 pull pull-right mt-0">View Details</a>'+
					// '</p></div></div>';
					
					// $('#careers_content #narrow.row').append(html);

					html = '<div class="col-md-4">'+
					'<div class="card p-0 border-0 shadow rounded-0">'+
					'<div class="card-header border-0 text-center font-weight-bold">'+
					'<span class="title text-uppercase">' + value.career_position_title + '</span>' + 
					'</div>'+
					'<div class="card-body details">'+
					'<p class="dept">' + value.department_name +'</p>'+
					'<p class="dtpost">Date Posted ' + date_posted +'</p>'+
					'<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i>' + value.career_location+'</p>'+
					'<a href="' + site_url + 'careers/'+value.division_slug+'/'+value.career_slug+'" class="button default-button-2 pull pull-right mt-0">View Details</a>'+
					'</div></div>';
					
					$('#careers_content #alldiv.row').append(html);
				});
			}
			else{
				$('.found_no_career').fadeIn(500);
			}
		}
	});

	
}