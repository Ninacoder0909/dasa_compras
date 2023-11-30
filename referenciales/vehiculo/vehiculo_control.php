<?php 

        
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$descripcion = $_REQUEST['vdescripcion'];
$vnro_chasis = $_REQUEST['vnro_chasis'];

$sql = "SELECT sp_vehiculo(" . $operacion . "," . (!empty($codigo)? $codigo:0) . ",'". (!empty($descripcion)? $descripcion:'vacio'). "','". (!empty($vnro_chasis) ? $vnro_chasis:'vacio') . "') as vehiculo;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['vehiculo'] != NULL) {
    $valor = explode("*" , $resultado[0]['vehiculo']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:vehiculo_index.php");
}