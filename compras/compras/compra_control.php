<?php

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vidcompra']; //
$usuario = $_REQUEST['vusuario']; //
$remi = $_REQUEST['vidremision']; //
$proveedor = $_REQUEST['vidproveedor'];
$fecha = $_REQUEST['vfecha']; //
$nrofactura = $_REQUEST['vnrofactura']; //
$nrotimp = $_REQUEST['vnrotimp']; //
$condicion = $_REQUEST['vcondicion']; //
$canticuo = $_REQUEST['vcantidadcuota']; //
$intervalo = $_REQUEST['vintervalo']; //
$ventimp = $_REQUEST['vetimp'];
$orden = $_REQUEST['vidorden'];
$sucur = $_REQUEST['vsucursal'];

$sql = "SELECT sp_compras(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($sucur) ? $sucur : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . "," .
    (!empty($remi) ? $remi : 0) . "," .
    (!empty($proveedor) ? $proveedor : 0) . ",'" .
    (!empty($fecha) ? $fecha : "01-01-0001") . "','" .
    (!empty($nrofactura) ? $nrofactura : "VACIO") . "'," .
    (!empty($nrotimp) ? $nrotimp : 0) . ",'" .
    (!empty($condicion) ? $condicion : "VACIO") . "'," .
    (!empty($canticuo) ? $canticuo : 0) . "," .
    (!empty($intervalo) ? $intervalo : 0) . ",'" .
    (!empty($ventimp) ? $ventimp : "01-01-0001") . "'," .
    (!empty($orden) ? $orden : 0) . ") AS compras;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['compras'] != NULL) {
    $valor = explode("*", $resultado[0]['compras']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:compras_index.php");
}
