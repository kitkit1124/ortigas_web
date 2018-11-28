$(function() {

	$('#form_landing').on('hidden.bs.modal', function () {
      location.reload();
	});

	
	// $('#message_section').change(function(){
	// 	$.ajax({method: "POST",url: "website/contact/get_projects",
	// 		data: { 
	// 			message_section : $(this).val(), 
	// 			[csrf_name]: $('#csrf').val(),
	// 		} 
	// 	})
	// 	.done(function( data ) {
	// 		o = jQuery.parseJSON(data);
	// 		$.each(o, function( index, value ) {
	// 			$('#message_section_id').append('<option value="' + value.property_id + '">' + value.property_name + '</option>');
	// 		});
	// 	});
	// });

	$('#message_agreement').change(function(){
		// if($(this).prop("checked") == true){
		//   $('.contact_submit').removeAttr('disabled');
		// }
		// else{
		//   $('.contact_submit').prop('disabled','disabled');
		// }
	});

	$('.contact_submit').click(function(){

		$.ajax({method: "POST",url: site_url + 'messages/messages/form',
			data: { 
				message_type	    : 'Contact',
				message_section	    : $('#message_section').val(),
				message_section_id	: $('#message_section_id').val(),
				message_name		: $('#message_name').val(),
				message_email		: $('#message_email').val(),
				message_mobile		: $('#message_mobile').val(),
				message_location	: $('#message_location').val(),
				message_content		: $('#message_content').val(),
				message_status  	: 0,

				message_agreement	: $('#message_agreement:checked').val(),
				message_captcha		: grecaptcha.getResponse(), 

				[csrf_name]: $('#csrf').val()
			} 
		})
		.done(function(data) {

			var o = jQuery.parseJSON(data);
			if (o.success === false) {
				// shows the error message
		        alertify.error(o.message);

		        // displays individual error messages
		        if (o.errors) {
		          for (var form_name in o.errors) {
		          	 $('#error-' + form_name).html(o.errors[form_name]);

		            $('#error-' + form_name + ' .text-danger').append('<i class="fa fa-exclamation-circle" aria-hidden="true"></i>');
		          }
		        }
			} else {
           		 $('#form_landing_button').trigger('click');

			}
		});

	});

});