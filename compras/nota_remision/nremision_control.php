<?php

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vnremision'];
$timbrado = $_REQUEST['vnrotimp'];
$fecha = $_REQUEST['vfecha'];
$orden = $_REQUEST['vidorden'];
$factura = $_REQUEST['vnrofactura'];
$usuario = $_REQUEST['vusuario'];
$vencimiento = $_REQUEST['vetimp'];
$conductor = $_REQUEST['vconductor'];
$cedula = $_REQUEST['vcedula'];
$chapa = $_REQUEST['vchapa'];
$modelo = $_REQUEST['vmodelo'];
$color = $_REQUEST['vcolor'];

$sql = "SELECT sp_nremision(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($timbrado) ? $timbrado : 0) . ",'" .
    (!empty($fecha) ? $fecha : "0001-01-01") . "'," .
    (!empty($usuario) ? $usuario : 0) . ",'" .
    (!empty($conductor) ? $conductor : 'VACIO') . "','" .
    (!empty($cedula) ? $cedula : 'VACIO') . "','" .
    (!empty($chapa) ? $chapa : 'VACIO') . "','" .
    (!empty($color) ? $color : 'VACIO') . "','" .
    (!empty($modelo) ? $modelo : 'VACIO') . "'," .
    (!empty($orden) ? $orden : 0) . ",'" .
    (!empty($factura) ? $factura : 'VACIO') . "') AS nremision;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nremision'] != NULL) {
    $valor = explode("*", $resultado[0]['nremision']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nremision_index.php");
}
