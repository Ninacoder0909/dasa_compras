<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vncredito']; //
$motivo = $_REQUEST['vmotivo']; //
$fechasis = $_REQUEST['vfechasis']; 
$fecharec = $_REQUEST['vfechareci']; 
$comprap = $_REQUEST['vidcompra']; 
$usuario = $_REQUEST['vusuario']; 

$sql = "SELECT sp_ncredito(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($motivo) ? $motivo:0).",'".
        (!empty($fechasis) ? $fechasis:"0001-01-01 00:00:00")."','".
        (!empty($fecha) ? $fecha:"00001-01-01 00:00:00")."',".
        (!empty($comprap) ? $comprap:0).",".
        (!empty($usuario) ? $usuario:0).") AS ncredito;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ncredito'] != NULL) {
    $valor = explode("*" , $resultado[0]['ncredito']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ncredito_index.php");
}