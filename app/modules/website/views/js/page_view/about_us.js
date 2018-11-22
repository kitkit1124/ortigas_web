// $('.content table, .content tr, .content td, .content img').removeAttr('style');
//$('.content table').removeAttr('style');	
// $('.content table td:first-child').first().css('display','none');
// $('.content table tr').first().append( $('.content table td:first-child').html() );
$(function() {
	
    $('.content table, .content tr, .content td, .content img').removeAttr('style');
    $(window).resize(function(){
         resize()
    });
   
});

function resize(){
	if($(window).width() < 768){
    	$('.content table, .content tr, .content td, .content img').removeAttr('style');
    }
}