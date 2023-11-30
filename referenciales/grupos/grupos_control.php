<?php 

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre']; //tambien se puede usar request

$sql = "SELECT sp_ref_grupos(" . $operacion . "," . $codigo . ",'". $nombre . "') as grupos;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['grupos'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:grupos_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['grupos'];
    header("location:grupos_index.php");
}