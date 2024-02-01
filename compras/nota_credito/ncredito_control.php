<?php

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vncredito']; //
$fechasis = $_REQUEST['vfechasis'];
$fecharec = $_REQUEST['vfechareci'];
$comprap = $_REQUEST['vidcompra'];
$usuario = $_REQUEST['vusuario'];
$motivo = $_REQUEST['vmotivo'];
$vsucursal = $_REQUEST['vsucursal'];
$nrofac = $_REQUEST['vnrofactura'];
$timbrado = $_REQUEST['vnrotimp'];
$timven = $_REQUEST['vetimp'];

$sql = "SELECT sp_credito(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . ",'" .
    (!empty($fechasis) ? $fechasis : "2000/01/01") . "','" .
    (!empty($fecha) ? $fecha : "2000/01/01") . "'," .
    (!empty($comprap) ? $comprap : 0) . "," .
    (!empty($motivo) ? $motivo : 0) . "," .
    (!empty($vsucursal) ? $vsucursal : 0) . ",'" .
    (!empty($nrofac) ? $nrofac : 0) . "'," .
    (!empty($timbrado) ? $timbrado : 0) . ",'" .
    (!empty($timven) ? $timven : "2000/01/01") . "'," .
    (!empty($usuario) ? $usuario : 0) . ") AS ncredito;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ncredito'] != NULL) {
    $valor = explode("*", $resultado[0]['ncredito']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ncredito_index.php");
}
