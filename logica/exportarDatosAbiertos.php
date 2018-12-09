<?php
//include database configuration file
include '../conexion/abrir_conexion.php';

$conexion = DB::conexion();
//get records from database
$resultado = mysqli_query($conexion,"SELECT * FROM volquetas ORDER BY circuito");

if($resultado->num_rows > 0){
    $delimiter = ";";
    $filename = "volquetas" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Circuito', 'Nro', 'Estado', 'Fecha Ingreso', 'Latitud', 'Longitud'."\r\n");
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $resultado->fetch_assoc()){
        $lineData = array($row['circuito'], $row['nro'], $row['estadoFisico'], $row['fechaIngreso'], $row['lat'], $row['lng']."\r\n");
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>