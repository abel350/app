
$("#login").click(function(e){
	e.preventDefault();
	var correo = $("#inputEmail").val();
	var pass = $("#inputPassword").val();
	var formData = $("#formulario").serialize();
	
	datos = {'email': correo, 'password':pass};
	obj = JSON.stringify(formData);
	
    $.ajax({
	  type: 'POST',
	  data: formData,
	  url: 'recursos/acceder.php',
	  success: function (data) {
	  	var json = JSON.stringify(data);
	    console.log(data);
	  	if (data == 'Unauthorized'){
	 		alert ('Usuario no registrado');
	 	}else
	 	if (data == 'Bad Request'){
	 		alert ('Verifica tus datos');
	 	}else
	 	    if (data =! ''){
		    alert('Bienvenido '+ correo);
		    window.location.assign("tablero.php");
	 	}
	  },
	  fail: function(data) {
			alert('Ocurrió un Error');
		},
		complete: function(data){		
		}
	});
});