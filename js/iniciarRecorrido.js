$("#iniciar").click(function(){
	var circuito = document.getElementById("circuito").value;
	var camion= document.getElementById("vehiculos").value;
	console.log(camion);
	var recolector1=document.getElementById('recolector1').value;
	var recolector2=document.getElementById('recolector2').value;
	console.log(recolector2);
	console.log(recolector1);
//	var recolectores=getRecolectores(document.recolectores);
	$.ajax({
		url: '../logica/iniciarCircuito.php',
		type: 'POST',
		data: {
			circuito:circuito,
			camion:camion,
			recolector1:recolector1,
			recolector2:recolector2
		},
		success: function(response){
			console.log(response);
			if(response==="inicio"){
				location.href ="../vistas/choferActivo.php?circuito="+circuito+"";
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