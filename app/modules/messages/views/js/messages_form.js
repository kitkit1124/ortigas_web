$(function() {

	$('#form_landing').on('hidden.bs.modal', function () {
      location.reload();
	});

	$('.inquiry_submit').click(function(){
		$.ajax({method: "POST",url: site_url + 'messages/messages/form',
			data: { 
				message_section	    : section,
				message_section_id	: section_id,
				message_name		: $('#inquiry_name').val(),
				message_email		: $('#inquiry_email').val(),
				message_content		: $('#inquiry_message').val(),
				message_status  	: 0,

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