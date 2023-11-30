<?php 

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre']; //tambien se puede usar request

$sql = "SELECT sp_ref_modulos(" . $operacion . "," . $codigo . ",'". $nombre . "') as modulos;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['modulos'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:modulos_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['modulos'];
    header("location:modulos_index.php");
}