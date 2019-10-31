$(function() {

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
	
	if(email.length < 1 || email.length > 50) 
	{
		return false;		
	}
	
     return true;

	// }
  }
}
	$('#form-submit').click(function(e){
		var ckbox = $('#agreement');
		e.preventDefault();
		 if (ckbox.is(':checked')) {
			 if(!$('#same-email').is(':checked')) {		
					 $biller = $('#biller-email').val();
					
					 if (IsEmail($biller)==true) 
					{
						$("#reservation-form").submit();
					}
    				else
					{
						$('#error-same-email').css('display','block')
					}
				}
				else
				{
					$("#reservation-form").submit();
				}
			
          // 
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
			$('#error-same-email').css('display','none')
			$('#biller-email').attr( 'type','hidden');
		}
             
    });
});