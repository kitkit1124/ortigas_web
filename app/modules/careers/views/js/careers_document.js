Dropzone.autoDiscover = false;

$(function() {

	var myDropzone = new Dropzone("#dropzone");

	myDropzone.on("success", function(file, response) {

	
		var ext = file.name.split('.').pop();
		var thumb = "";
		switch(ext){
		case "docx":
		case "doc":
			thumb = 'fa fa-file-word-o fa-5x color_doc';
			break;

		case "pdf":
			thumb = 'fa fa-file-pdf-o fa-5x color_pdf';
			break;
		}

		var response = jQuery.parseJSON(response);

	

		if (response.status == 'failed') {
			alertify.error(jQuery(response.error).text());

		} else {
			// shows the success message
			alertify.success('File Upload Successful.');

			$('#job_document').val(response.document_file);

			$('.file_upload').hide();

			$('.file_thumbnail').html('<i class="'+ thumb +'"></i><span>'+ file.name +'</span>');
			$('.file_thumbnail').fadeIn();
		}

			$('.dz-image, .dz-preview').remove();
			$('.dz-message').show();
		
	});


	$('.file_thumbnail').click(function(){
		$(this).hide();
		$('.file_upload').fadeIn();
	});

	// disables the enter key
	$('form input').keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
});