$(function() {
	$('#form-submit').click(function(e){
		var ckbox = $('#agreement');
		e.preventDefault();
		 if (ckbox.is(':checked')) {
           $("#reservation-form").submit();
        } else {
		
		alertify
  .alert("Please read and accept our terms and conditions..", function(){
   
  });
		}
	});
	 $('#same-email').change(function() {
        if(!$(this).is(':checked')) {
           $('#biller-email').attr( 'type','email');
        }
		else
		{
			$('#biller-email').attr( 'type','hidden');
		}
             
    });
});