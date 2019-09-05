$(function() {
	
	
	
	// handles the submit action
	$('#submit').click(function(e){
		// change the button to loading state
		var btn = $(this);
		btn.button('loading');

		// prevents a submit button from submitting a form
		e.preventDefault();

		// submits the data to the backend
		$.post(ajax_url, {
			company: $('#company').val(),
			first_name: $('#first_name').val(),
			last_name: $('#last_name').val(),
			phone: $('#phone').val(),

			[csrf_name]: $('input[name=' + csrf_name + ']').val(),
		},
		function(data, status){
			// handles the returned data
			var o = jQuery.parseJSON(data);
			if (o.success === false) {
				// reset the button
				btn.button('reset');
				
				// shows the error message
				alertify.error(o.message);

				// displays individual error messages
				if (o.errors) {
					for (var form_name in o.errors) {
						$('#error-' + form_name).html(o.errors[form_name]);
					}
				}
			} else {
				window.location.reload(true);
			}
		}).fail(function() {
			// shows the error message
			alertify.alert('Error', unknown_form_error);

			// reset the button
			btn.button('reset');
		});
	});

	// disables the enter key
	$('form input').keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
});