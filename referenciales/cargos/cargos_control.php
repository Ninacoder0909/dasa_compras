<?php 

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre']; //tambien se puede usar request

$sql = "SELECT sp_ref_cargo(" . $operacion . "," . $codigo . ",'". $nombre . "') as cargos;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['cargos'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:cargos_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['cargos'];
    header("location:cargos_index.php");
}