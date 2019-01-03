
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
                echo "fallooo";
            }       
        }

    }else if($accion=="eliminarVolqueta"){
        $numero=$_POST['numero'];
        $circuito= $_POST['circuito'];

        $eliminar=volquetas::borrar($numero,$circuito);
        if($eliminar==true){
            echo "1";
        }else{
            echo "0";
        }
        return;
    }else if($accion=="listarVolquetas"){
        $circuito=$_POST['circuito'];
        //echo $circuito;
        $arreglo=volquetas::listarVolquetasParaMostrar($circuito);
        echo json_encode($arreglo);
    }
}
?>