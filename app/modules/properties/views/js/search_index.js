$(function() {
	$('.prop_search_link').click(function(){
		$('.default_search').fadeOut(200,function(){
			$('.advance_search').fadeIn(500)
			;
		});
	});

	$('.adv_prop_search_link').click(function(){
		$('.advance_search').fadeOut(200,function(){
			$('.default_search').fadeIn(500)
		});
	});

	$('.filterby').attr('checked','checked');
  	if(c){	$('.filterby #c').attr('checked','checked');	}
 	if(r){	$('.filterby #r').attr('checked','checked');	}
 	if(o){	$('.filterby #o').attr('checked','checked');	}
 	if(m){	$('.filterby #m').attr('checked','checked');	}
 	if(n){	$('.filterby #n').attr('checked','checked');	}


	
	$('.filterby',this).click(function(){
		if($(this).prop("checked") == true){
			$(this).siblings('label').addClass('filter_true');
			$(this).siblings('i').css('opacity',1);
			$(this).val('1');
			$(this).prop("checked","");
		}
		else{
			$(this).siblings('label').removeClass('filter_true');
			$(this).siblings('i').css('opacity',0);
			$(this).val('0');
			$(this).prop("checked",'checked');
		}
	});

	$('.default_search i').click(function(){
		
		var filter = $('.default_search  input').val();
		var filter_by = $('.filter form').serialize();

		$.ajax({method: "POST",url: post_url,
			data: { 
				q : filter,
				filter_by : filter_by
			} 
		})
		.done(function(data) {

			var data = jQuery.parseJSON(data);
			if (data.success === false) {
				// shows the error message
			} else {
				window.location.replace(site_url + 'search?q=' + data.filter);
			}
		
			// data = jQuery.parseJSON(data);
			// $.each(data.residences, function( index, value ) {
			// 	var html = '<div class="estates properties col-sm-4"><a href="'+ site_url + 'estates/property/' + value.property_slug + '"><div class="image_wrapper"><div class="property"><p>'+ value.property_name +'</p></div><div class="image_container"><img src="'+ cms_url + value.property_image +'" width="100%" alt="" draggable="false"/></div></div></a></div>';
			// 	$('.search_result').append(html);
			// });
		});
	});


});