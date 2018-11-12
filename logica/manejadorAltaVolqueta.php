
<?php 
require ('volquetas.php');

if(isset(($_POST['accion']))){
    $response = array();
    $accion=$_POST['accion'];

    if($accion == "altaVolqueta"){
        $numero= $_POST['numero'];
        $circuito= $_POST['circuito'];
        $lat= $_POST['lat'];
        $long= $_POST['long'];
        $fecha = date ("Y-m-d");
        $existe = volquetas::existe($numero,$circuito);
        if ($existe==true) {
            echo "yaesta";        
        }else{
        $resultado = volquetas::agregarVolqueta($numero,$lat,$long,$fecha,$circuito);
        if($resultado==true){
            echo "exito";
        }else{
            echo "fallo";
        }       
       }
   }
}
?>