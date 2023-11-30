<?php 

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre']; //tambien se puede usar request

$sql = "SELECT sp_ref_umedida(" . $operacion . "," . $codigo . ",'". $nombre . "') as umedida;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['umedida'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:umedida_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['umedida'];
    header("location:umedida_index.php");
}