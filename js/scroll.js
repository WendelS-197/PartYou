$(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
    	if ($(window).scrollTop() > 100) {
			$('.scroll-mapa').addClass('show');
		} else {
			$('.scroll-mapa').removeClass('show');
		}
	});
});
 