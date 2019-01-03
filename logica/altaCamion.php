<?php

require ('../conexion/abrir_conexion.php');
require ('../logica/camion.php');

if (isset($_POST['submit'])) {

    $padron = $_POST['padron'];
    $matricula = $_POST['matricula'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];

    $exite = camion::existeCamion($padron,$matricula);
    echo $exite;
    if ($exite == 1) {
        header('location: ../Vistas/altaCamion.php?yaesta=Ya se encuentra esta matricula registrada');
    } else if($exite == 2) {
        $salida=camion::habilidatCamion($padron,$matricula,$marca,$modelo,$tipo);
        if($salida == false){
            echo 'llego';
            header('location: ../Vistas/altaCamion.php?fallo=Fallo la consulta');        
        }else{
            header('location: ../Vistas/altaCamion.php?exito=Se a registrado con exito');    
        }
    }else if($exite == 0){
        $exito = camion::ingresar($padron,$matricula,$marca,$modelo,$tipo,$padron);

        if($exito==true){
            header('location: ../Vistas/altaCamion.php?exito=Se a registrado con exito');
        } else {
            header('location: ../Vistas/altaCamion.php?fallo=Fallo la consulta');
        }
    }
}else if($_POST['accion']=='eliminarCamion'){
    $padron = $_POST['padron'];
    $matricula = $_POST['matricula'];
    $salida=camion::borrarCamion($padron,$matricula);
    if($salida==true){
        echo 'borrado';
    }else{
        echo "error";}
    }else if($_POST['accion']=='activarCamion'){
         $padron = $_POST['padron'];
    $matricula = $_POST['matricula'];
    $salida=camion::activarCamion($padron,$matricula);
    if($salida==true){
        echo 'activado';
    }else{
        echo "error";}
    }
    ?>