$(function() {
    $("#carousel .carousel-item").first().addClass('active');
    $("#carousel .carousel-indicator_button").first().addClass('active');

 
		$(window).scroll(function() {
		   if($(window).scrollTop() > 120) {
		   		$(".navbar").css({"background-color": "#f8f9fa", "border-bottom":"1px solid #C0C0C0"});
		   }
		   else{
		   	$(".navbar").css({"background-color": "transparent", "border-bottom":"1px solid transparent"});
		   }
		});


});