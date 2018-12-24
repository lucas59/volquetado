function reportar(circuito,numero){
	document.getElementById("circuito").value=circuito;
	document.getElementById("numero").value=numero;
	$("#modalReportar").modal()
}
function aceptarDatos(circuito,numero,estadoFisico,estadoContenido,contenidoFuera){
	console.log(numero);
	console.log('llego');
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

function previewFile() {
	var preview = document.getElementById('vistaPrevia');
	var file    = document.querySelector('input[type=file]').files[0];
	var reader  = new FileReader();
	//console.log(file);

	reader.onloadend = function () {
		preview.src = reader.result;
	}

	if (file) {
		reader.readAsDataURL(file);
	} else {
		preview.src = "";
	}
}

function nuevoReport(circuito){
	var estadoFisico = document.getElementById("estadoF").value;
	var estadoContenido = document.getElementById("estadoC").value;
	var nota = document.getElementById("notita").value;
	var volqueta= document.getElementById("volqueta").value;	
	var residuos= document.getElementById("residuos").checked;

	var inputFileImage = document.getElementById("imagenNuevoReporte");
	var file = inputFileImage.files[0];
	var data = new FormData();
	data.append('archivo',file);
	data.append('estadoContenido',estadoContenido);
	data.append('estadoFisico',estadoFisico);
	data.append('nota',nota);
	data.append('volqueta',volqueta);
	data.append('accion','nuevoReporte');
	data.append('circuito',circuito);
	data.append('residuos',residuos);
	data.append('inspeccionado',"1");
	
	$.ajax({
		url: '/volquetado/logica/reportar.php',
		type: 'POST',
		data:data,
		contentType: false, //importante enviar este parametro en false
        processData: false, //importante enviar este parametro en false
        success: function(response){
        	console.log(response);
        	if(response==1){ 
        		location.reload();
        	}else{
        		location.reload();
        	}
        }
    });
};

$("#close").click(function(){
	document.getElementById("descripcion").value = " ";
});

function handleFileSelect(evt) {
  var f = file.target.files[0]; // FileList object
  var reader = new FileReader();
  // Closure to capture the file information.
  reader.onload = (function(theFile) {
  	return function(e) {
  		var binaryData = e.target.result;
      //Converting Binary Data to base 64
      var base64String = window.btoa(binaryData);
  };
})(f);
  // Read in the image file as a data URL.
  reader.readAsBinaryString(f);
}


function btnReportar(){
	var estadoFisico = document.getElementById("estadoF").value;
	var estadoContenido = document.getElementById("estadoC").value;
	var nota = document.getElementById("descripcion").value;	
	var circuito = document.getElementById("circuito").value;	
	var numero= document.getElementById("numero").value;	
	var residuosFuera= document.getElementById("residuos").checked;
	//******************************************
	var inputFileImage = document.getElementById("imagen");
	var file = inputFileImage.files[0];
	var data = new FormData();
	data.append('archivo',file);
	data.append('estadoFisico',estadoFisico);
	data.append('estadoContenido',estadoContenido);
	data.append('nota',nota);
	data.append('circuito',circuito);
	data.append('numero',numero);
	data.append('residuosFuera',residuosFuera);
	data.append('accion',"reportar");
	data.append('inspeccionado',"1");
	data.append('residuo',residuosFuera);
	$.ajax({
		url: '/volquetado/logica/reportar.php',
		type: 'POST',
		data:data,
		contentType: false, //importante enviar este parametro en false
        processData: false, //importante enviar este parametro en false
        success: function(response){
        	console.log(response);
        	if(response==1){ 
        		location.reload();
        	}else{
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