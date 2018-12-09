
function reportar(circuito,numero){
	document.getElementById("circuito").value=circuito;
	document.getElementById("numero").value=numero;
	$("#modalReportar").modal()
}
function aceptarDatos(circuito,numero,estadoFisico,estadoContenido,contenidoFuera){
	console.log(numero);
	document.getElementById("circuitoCorrecto").value=circuito;
	document.getElementById("numeroCorrecto").value=numero;
	document.getElementById("estadoFisico").value=estadoFisico;
	document.getElementById("estadoContenido").value=estadoContenido;
	document.getElementById("contenidoFuera").value=contenidoFuera;
	$("#modalAceptar").modal()
}

function nuevoReporte(circuito){
	$("#modalAgregar").modal();
}
function nuevoReport(circuito){
	var estadoFisico = document.getElementById("estadoF").value;
	var estadoContenido = document.getElementById("estadoC").value;
	var nota = document.getElementById("notita").value;
	var volqueta= document.getElementById("volqueta").value;	
	var residuos= document.getElementById("residuos").checked;
	$.ajax({
		url: '/volquetado/logica/reportar.php',
		type: 'POST',
		data: {
			accion:"nuevoReporte",
			volqueta:volqueta,
			circuito:circuito,
			estadoContenido:estadoContenido,
			estadoFisico:estadoFisico,
			nota:nota,
			residuos:residuos
		},
		success: function(response){
			console.log(response);
			if(response.localeCompare("1")){ 
				location.reload();
			}
		}
		
	});

};

$("#close").click(function(){
	document.getElementById("descripcion").value = " ";
});

function btnReportar(){
	console.log("asdas");
	var estadoFisico = document.getElementById("estadoF").value;
	var estadoContenido = document.getElementById("estadoC").value;
	var nota = document.getElementById("descripcion").value;	
	var circuito = document.getElementById("circuito").value;	
	var numero= document.getElementById("numero").value;	
	var residuosFuera= document.getElementById("residuos").checked;

	$.ajax({
		url: '/volquetado/logica/reportar.php',
		type: 'POST',
		data: {
			accion:"reportar",
			numero:numero,
			circuito:circuito,
			estadoContenido:estadoContenido,
			estadoFisico:estadoFisico,
			nota:nota,
			residuo:residuosFuera
		},
		success: function(response){
			console.log(response);
			if(response.localeCompare("1")){ 
				location.reload();
			}
		}
	});	
};

function confirmarReporte(){
	var circuito = document.getElementById("circuitoCorrecto").value;	
	var numero= document.getElementById("numeroCorrecto").value;
	var estadoContenido = document.getElementById("estadoContenido").value;	
	var estadoFisico= document.getElementById("estadoFisico").value;
	var residuos= document.getElementById("contenidoFuera").checked;
	$.ajax({
		url:'/volquetado/logica/reportar.php',
		type:'POST',
		data:{
			accion:"aceptarReporte",
			circuito:circuito,
			numero:numero,
			estadoFisico:estadoFisico,
			estadoContenido:estadoContenido,
			residuos:residuos
		},
		success:function(response){
			console.log(response);
			if(response.localeCompare("1")){ 
				console.log("Exito");

			}
		}
	});	

};

$("#volver").click(function(){
	$("#modalAceptar").modal('hide');
});