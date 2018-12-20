$('#registrar').click(function(){
	var cedula=document.getElementById('cedula').value;
	var nombre=document.getElementById('nombre').value;
	var apellido=document.getElementById('apellido').value;
	var tipo=document.getElementById('tipo').value;
	var fecha=document.getElementById('fecha').value;
	var libreta=document.getElementById('libreta').value;
	var direccion=document.getElementById('direccion').value;
	var celular=document.getElementById('celular').value;
	
	if(tipo!='recolector'){
		var pass=document.getElementById('pass').value;
		var passc=document.getElementById('passc').value;

		if(pass!=passc){
			$('#modal').modal();
			document.getElementById('mensajeExiste').style.display='block';
			document.getElementById('mensajeYaExiste').innerHTML='Contraseñas no coinciden.';
			return;
		}	
	}

	if(new Date(fecha).getTime() > new Date().getTime()){
		$('#modal').modal();
		document.getElementById('mensajeExiste').style.display='block';
		document.getElementById('mensajeYaExiste').innerHTML='Fecha de nacimiento invalida.';
		return;
	}
	$.ajax({
		url: '../logica/altaUsuario.php',
		type: 'POST',
		data: {
			accion:'altaUsuario',
			cedula:cedula,
			nombre:nombre,
			apellido:apellido,
			tipo:tipo,
			nacimiento:fecha,
			libreta:libreta,
			direccion:direccion,
			celular:celular,
			pass:pass
		},
		success: function(response){
			console.log(response);
			if(response=="exito"){
				$('#modal').modal();
				document.getElementById('mensaje').style.display='block';
				document.getElementById('mensajeExito').innerHTML='Se registro correctamente el nuevo usuario.';
				document.getElementById('mensajeExiste').style.display='none';
				
				document.getElementById('cedula').value= "";
				document.getElementById('nombre').value= "";
				document.getElementById('pass').value= "";
				document.getElementById('passc').value= "";
				document.getElementById('apellido').value= "";
				document.getElementById('tipo').value= "";
				document.getElementById('direccion').value= "";
				document.getElementById('celular').value= "";
			}else if(response=="ya existe"){
				$('#modal').modal();
				document.getElementById('mensajeExiste').style.display='block';
				document.getElementById('mensajeYaExiste').innerHTML='El usuario ya existe.';
				document.getElementById('mensaje').style.display='none';
				document.getElementById('cedula').value= "";
				
			}else if(response=="error"){
				$('#modal').modal();
				document.getElementById('mensaje').style.display='none';
				document.getElementById('mensajeExiste').style.display='block';
				document.getElementById('mensajeYaExiste').innerHTML='Error en el sistema.';
			}

		}
	});
});

$('#tipo').change(function(){
	var tipo = document.getElementById('tipo').value;
	console.log(tipo);
	if(tipo==='recolector'){
		console.log("entro");
		$("#pass").disabled =false;
		$("#passc").disabled=false;
	}
});

$("#aceptar").click(function(){
	$("#modal").modal('hide');
})