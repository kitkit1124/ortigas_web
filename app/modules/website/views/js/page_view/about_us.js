// $('.content table, .content tr, .content td, .content img').removeAttr('style');
//$('.content table').removeAttr('style');	
// $('.content table td:first-child').first().css('display','none');
// $('.content table tr').first().append( $('.content table td:first-child').html() );
$(function() {
	
    $('.content table, .content tr, .content td, .content img').removeAttr('style');
    $(window).resize(function(){
         resize()
    });

//     #table1 td:first-child{
// 	width: 570px;
// }
// #table1 td:last-child{
// 	width: 430px;
// }
	
	 
	
   
});

function resize(){
	if($(window).width() < 768){
    	$('.content table, .content tr, .content td, .content img').removeAttr('style');
    }  

     if($(window).width() > 1024){
		//$('#table2 td:lst-child p').show();
		$('#table2d').html('');
		$('#table2 td:first-child p').css({'height':'auto', 'padding':'20px', 'overflow':'auto'});
		
	}else{
		$('#table2 td:first-child p').css({'height':'0', 'padding':'0', 'overflow':'hidden'});
		$('#table2d').html('<br><br>'+$('#table2 td:first-child p').html());
	}
}