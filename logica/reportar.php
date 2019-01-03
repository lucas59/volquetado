<?php 
include '../conexion/abrir_conexion.php';
include '../logica/reporte.php';
require ('../lib/pclzip.lib.php');

if (isset($_POST["accion"])) {
	$accion=$_POST["accion"];
	if($accion=="reportar"){
		$circuito=$_POST["circuito"];
		$numero=$_POST["numero"];
		$estadoFisico=$_POST["estadoFisico"];
		$estadoContenido=$_POST["estadoContenido"];
		$residuosFuera=$_POST["residuo"];
		$nota=$_POST["nota"];
		$inspeccionado=$_POST["inspeccionado"];
		$base64=null;
		if(isset($_FILES["archivo"])){
			//Nombre del archivo
			$nombreArchivo = $_FILES['archivo']['name'];
	//Extensiones permitidas
			$extensiones = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
	//Obtenemos la extensión (en minúsculas) para poder comparar
			$extension = explode('.', $nombreArchivo);
			$extension = end($extension);
			$extension = strtolower($extension);
	//Verificamos que sea una extensión permitida, si no lo es mostramos un mensaje de error
			if(!in_array($extension, $extensiones)) {
				echo 'Sólo se permiten archivos con las siguientes extensiones: '.implode(', ', $extensiones);
				return;
			} else {
		$tamañoArchivo = $_FILES['archivo']['size']; //Obtenemos el tamaño del archivo en Bytes
		$tamañoArchivoKB = round(intval(strval( $tamañoArchivo / 1024 ))); //Pasamos el tamaño del archivo a KB

		$tamañoMaximoKB = "1024"; //Tamaño máximo expresado en KB
		$tamañoMaximoBytes = $tamañoMaximoKB * 1024; // -> 2097152 Bytes -> 2 MB

		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo "El archivo ".$nombreArchivo." es demasiado grande. El tamaño máximo del archivo es de ".$tamañoMaximoKB."Kb.";
			return;
		}else{
			$base64 = base64_encode(file_get_contents($_FILES["archivo"]["tmp_name"]));
		}
	}
}
$fecha = new DateTime();
$resultado=reporte::agregarReporte($circuito,$numero,$fecha->format('Y-m-d H:i:s'), $estadoFisico, $estadoContenido, $nota, $residuosFuera, $inspeccionado,$base64);
if($resultado){
	echo '1';
}else{
	echo '0';
}
return;
}else if ($accion=="aceptarReporte") {
	$circuito=$_POST["circuito"];
	$numero=$_POST["numero"];
	$estadoContenido=$_POST["estadoContenido"];
	$estadoFisico=$_POST["estadoFisico"];
	$residuos=$_POST["residuos"];
	$resultado = reporte::aceptarReporte($circuito,$numero,$estadoContenido,$estadoFisico,$residuos);
	if($resultado==true){
		echo true;
	}else{
		echo false;
	}
}else if($accion=="nuevoReporte"){
	$circuito=$_POST["circuito"];
	$volqueta=$_POST["volqueta"];
	$estadoContenido=$_POST["estadoContenido"];
	$estadoFisico=$_POST["estadoFisico"];
	$residuos=$_POST["residuos"];
	$nota=$_POST["nota"];
	$base64=null;
	if(isset($_FILES["archivo"])){
			//Nombre del archivo
		$nombreArchivo = $_FILES['archivo']['name'];
	//Extensiones permitidas
		$extensiones = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
	//Obtenemos la extensión (en minúsculas) para poder comparar
		$extension = explode('.', $nombreArchivo);
		$extension = end($extension);
		$extension = strtolower($extension);
	//Verificamos que sea una extensión permitida, si no lo es mostramos un mensaje de error
		if(!in_array($extension, $extensiones)) {
			echo 'Sólo se permiten archivos con las siguientes extensiones: '.implode(', ', $extensiones);
			return;
		} else {
		$tamañoArchivo = $_FILES['archivo']['size']; //Obtenemos el tamaño del archivo en Bytes
		$tamañoArchivoKB = round(intval(strval( $tamañoArchivo / 1024 ))); //Pasamos el tamaño del archivo a KB

		$tamañoMaximoKB = "1024"; //Tamaño máximo expresado en KB
		$tamañoMaximoBytes = $tamañoMaximoKB * 1024; // -> 2097152 Bytes -> 2 MB

		//Comprobamos el tamaño del archivo, y mostramos un mensaje si es mayor al tamaño expresado en Bytes
		if($tamañoArchivo > $tamañoMaximoBytes) {
			echo "El archivo ".$nombreArchivo." es demasiado grande. El tamaño máximo del archivo es de ".$tamañoMaximoKB."Kb.";
			return;
		}else{
			$base64 = base64_encode(file_get_contents($_FILES["archivo"]["tmp_name"]));
		}
	}
}
$fecha = new DateTime();
$inspeccionado=$_POST["inspeccionado"];
$resultado = reporte::agregarReporte($circuito,$volqueta,$fecha->format('Y-m-d H:i:s'),$estadoFisico,$estadoContenido,$nota,$residuos,$inspeccionado,$base64);
if($resultado==true){
	echo '1';
}else{
	echo '0';
}
return;
}
}

function optimizar_imagen($origen, $destino, $calidad) {

	$info = getimagesize($origen);

	if ($info['mime'] == 'image/jpeg'){
		$imagen = imagecreatefromjpeg($origen);
	}

	else if ($info['mime'] == 'image/gif'){
		$imagen = imagecreatefromgif($origen);
	}

	else if ($info['mime'] == 'image/png'){
		$imagen = imagecreatefrompng($origen);
	}

	imagejpeg($imagen, $destino, $calidad);

	return $destino;

}
?>