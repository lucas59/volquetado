<?php
require ('../logica/usuario.php');
require_once ('../conexion/abrir_conexion.php');

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if($accion=='altaUsuario'){
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $tipo = $_POST['tipo'];
        $pass = $_POST['pass'];
        $celular = $_POST['celular'];
        $fecha = $_POST['nacimiento'];
        $libreta=$_POST['libreta'];
    $passencry = sha1($pass);//verifico si existe ese usuario
    $existe = usuario::existe($cedula);
    if($existe==true){
        echo "ya existe";
        return;
    }else{
        $ingresar=usuario::registrar($cedula,$nombre,$apellido,$direccion,$tipo,$passencry,$celular,$fecha,$libreta);
        if($ingresar==true){
            echo 'exito';
        }else{
            echo "error";
        }
    }
} else if($accion=='eliminarUsuario'){
    $cedula = $_POST['ci'];
    $salida = usuario::eliminarUsuario($cedula);
    if($salida == true){
        echo 'borrado';
    }else{
        echo "error";
    }
}
}

?>
