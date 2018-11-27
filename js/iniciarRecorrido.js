$("#iniciar").click(function(){
	var circuito = document.getElementById("circuito").value;
	var camion=getRadioButtonSelectedValue(document.camiones.camion);
	var arreglo = camion.split("-");
	var padron= arreglo[0];
	var matricula= arreglo[1]; 
	var recolectores=getRecolectores(document.recolectores);

	$.ajax({
		url: '../logica/iniciarCircuito.php',
		type: 'POST',
		data: {
			circuito:circuito,
			padronCamion:padron,
			matriculaCamion:matricula,
			recolectores:recolectores
		},
		success: function(response){
			console.log(response);
			if(response==="inicio"){
				location.href ="../vistas/choferActivo.php";
			}else{
				console.log("errorrr");
			}

		},
		error: function(response){
			console.log(response);
		}
	});


});

function getRadioButtonSelectedValue(ctrl)
{
	for(i=0;i<ctrl.length;i++)
		if(ctrl[i].checked) 
			return ctrl[i].value;
	}


	function getRecolectores(ctrl){
		var arreglo=[];
		for(i=0;i<ctrl.length; i++){
			if((document.recolectores[i].type == 'checkbox') && (document.recolectores[i].checked == true)){
				arreglo[i]=document.recolectores[i].value;
			}
		}
		return arreglo;
	}