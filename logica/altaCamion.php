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
    
    if ($exite == true) {
                header('location: ../Vistas/altaCamion.php?yaesta=Ya se encuentra esta matricula registrada');
    } else {
        $exito = camion::ingresar($padron,$matricula,$marca,$modelo,$tipo,$padron);
        
        if($exito==true){
                header('location: ../Vistas/altaCamion.php?exito=Se a registrado con exito');
        } else {
            header('location: ../Vistas/altaCamion.php?fallo=Fallo la consulta');
        }
    }
}
?>