$( document ).ready(function() {	
	$("#tabla").hide();	
});


$("#detalles").on("click", function(e){
	e.preventDefault();
	$("#tabla").toggle(500);	
});

