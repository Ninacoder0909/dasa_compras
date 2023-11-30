<?php 

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre']; //tambien se puede usar request

$sql = "SELECT sp_ref_tpersona(" . $operacion . "," . $codigo . ",'". $nombre . "') as tpersona;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['tpersona'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:tpersona_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['tpersona'];
    header("location:tpersona_index.php");
}