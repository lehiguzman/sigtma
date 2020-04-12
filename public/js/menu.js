$(document).ready( function() {			
		//Funciones jquery globales
		$('.list-group div a').click(function(){
			if($(this).hasClass('prueba')) {
				$(this).removeClass("prueba");	
			} else {
				$('.list-group div a').removeClass('prueba');
				$(this).addClass("prueba");
			}    		
		});

	$('.list-group div').click( function(e)  {
		e.preventDefault();			

		$('.list-group div ul li a').click( function(e)  { 			
			return false;
		});
		
		if( $(this).hasClass('activado')) {
			$(this).removeClass('activado');				
			$(this).children('ul').slideUp();
			$(this).children('a').children('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');		
		} else {			
			$('.list-group div ul').slideUp();
			$('.list-group div').removeClass('activado');
			if( $('.list-group div a i').hasClass('fa-chevron-down') ) {
				$('.list-group div a i').removeClass('fa-chevron-down').addClass('fa-chevron-right');	
			}		
			
			$(this).addClass('activado');			
			$(this).children('ul').slideDown();
			$(this).children('a').children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');			
		}
	});	
});