<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidtimpuesto'];
$nombre = $_REQUEST['vdescri']; //tambien se puede usar request
$porcen = $_REQUEST['vporcen'];

$sql = "SELECT sp_ref_tipo_impuesto(" . $operacion . "," . $codigo . ",'" . $nombre . "',". $porcen . ") as timpuesto;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['timpuesto'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:timpuesto_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['timpuesto'];
    header("location:timpuesto_index.php");
}