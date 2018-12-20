
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
        if ($existe==1) {
            echo "yaesta";        
        }else if($existe==2){
            $resultado = volquetas::agregarVolqueta($numero,$lat,$long,$fecha,$circuito,2);
            if($resultado==true){
                echo "exito";
            }else{
                echo "fallo";
            }   
        }else if($existe==0){
            $resultado = volquetas::agregarVolqueta($numero,$lat,$long,$fecha,$circuito,0);
            if($resultado==true){
                echo "exito";
            }else{
                echo "fallo";
            }       

        }

    }else if($accion=="eliminarVolqueta"){
        $numero=$_POST['numero'];
        $lat= $_POST['lat'];
        $long= $_POST['long'];

        $eliminar=volquetas::borrar($numero,$lat,$long);
        if($eliminar==true){
            echo "borrada";
        }else{
            echo "error";
        }
        return;
    }else if($accion=="listarVolquetas"){
        $circuito=$_POST['circuito'];
        $arreglo=volquetas::listarVolquetasDeCircuito($circuito);
        echo json_encode($arreglo);
    }
}
?>