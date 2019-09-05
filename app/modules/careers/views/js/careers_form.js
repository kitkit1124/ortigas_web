$(function() {

	$('#agreement').change(function(){
		if($(this).prop("checked") == true){
		  $('#form_submit').removeAttr('disabled');
		}
		else{
		  $('#form_submit').prop('disabled','disabled');
		}
	});

	$('#form_application, #form_landing').on('hidden.bs.modal', function () {
      location.reload();
	});

  $('#form_submit').click(function(){
    $.post(site_url + "careers_ops/careers_ops/valdidate_save", {
      
         job_career_id: $('#job_career_title').val(),
         job_applicant_name: $('#job_applicant_name').val(),
         job_email: $('#job_email').val(),
         job_mobile: $('#job_mobile').val(),
         job_document: $('#job_document').val(),
         job_referred: $('#job_referred').val(),
         job_agreement: $('#job_agreement:checked').val(),

         job_captcha    : grecaptcha.getResponse(), 
         [csrf_name]: $('#csrf').val()
    },
    function(data, status){
      // handles the returned data
      var o = jQuery.parseJSON(data);

      if (o.success === false) {
    
        // shows the error message
        alertify.error(o.message);
        // $('#message_denied').trigger('click')
        
        // displays individual error messages
        if (o.errors) {
          for (var form_name in o.errors) {
            if(o.errors[form_name]){
             $('#error-' + form_name).html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i>'+ o.errors[form_name]);
            }
            else{
               $('#error-' + form_name).html('');
            }
          }
        }
      } else{  
            $('#form_application').modal().hide();
            $('#message_success').trigger('click');
           // setTimeout(function(){ location.reload(); }, 3000);
      }
         
    });

    
  });
});