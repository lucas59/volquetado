<?php
require_once '../logica/usuario.php';

if (isset($_POST['submit'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $tipo = $_POST['tipo'];
    $pass = $_POST['pass'];
    $passc = $_POST['passc'];
    $celular = $_POST['celular'];
    $fecha = $_POST['fecha'];
    include '../conexion/abrir_conexion.php';
    if ($pass != $passc) {
        header('location: ../Vistas/altaUser.php?mensaje=Verifique la contraseña');
    } else {
        $passencry = sha1($pass);
        //verifico si existe ese usuario
        $existe= usuario::existeUser($cedula);
        
        if ($existe > 0) {
            header('location: ../Vistas/altaUser.php?mensaje=Este usuario ya existe');
        } else {
            $sql = "INSERT INTO usuarios (ci, nombre, apellido,cargo,celular,direccion,password)
VALUES ('.$cedula', '.$nombre', '.$apellido','.$tipo','.$celular','.$direccion','.$passencry')";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado == TRUE) {
                header('location: ../Vistas/oficina.php?mensaje=Usuario ingresado al sistema con exito');
            } else {
                header('location: ../Vistas/oficina.php?noexito=fallo la consulta');
            }
        }
    }
    include '../conexion/cerrar_conexion.php';
}
?>
