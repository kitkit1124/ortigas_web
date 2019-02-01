$(function(){

	$('.ccc').click(function(){
		$('.oclp').removeClass('dp_active');
		$(this).addClass('dp_active')

		$('.oclp_content').hide();
		$('.ccc_content').fadeIn(300);
		
	});

	$('.oclp').click(function(){
		$('.ccc').removeClass('dp_active');
		$(this).addClass('dp_active');
		$('.ccc_content').hide();
		$('.oclp_content').fadeIn(300);
	});
})