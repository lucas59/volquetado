$("#agregarCircuito").click(function(){
	var circuito = document.getElementById('circuito').value;
	if(circuito===''){
		return;
	}
	console.log(circuito);
	$.ajax({
		url: '../logica/oficina.php',
		type: 'POST',
		data: {
			accion:"agregarCircuito",
			circuito:circuito
		},
		success: function(response){
			console.log(response);
			if(response==="ok"){
				$("#exampleModal").modal('hide');
				document.getElementById('contenedorMensajeExito').style.display='block';
				document.getElementById('contenedorMensaje').style.display='none';
				document.getElementById("mensajeExito").value="Se a registrado exitosamente un nuevo circuito";
			}else{
				document.getElementById('contenedorMensaje').style.display='block';
				document.getElementById('contenedorMensajeExito').style.display='none';
				var cadena = "Ya existe el circuito ".concat(circuito.toUpperCase());
				document.getElementById("mensaje").value=cadena;
			}
		},
		error: function(response){
			console.log(response);
		}
	});

});