<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidajuste'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];
$motivo = $_REQUEST['vidmotivo'];




$sql = "SELECT sp_ajustes_det(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($motivo) ? $motivo : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . ") AS ajust;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['ajust'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['ajust'];
    header("location:ajuste_det.php?vidpedido=" . $_REQUEST['vidajuste']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ajuste_det.php?vidpedido=" . $_REQUEST['vidajuste']);
}
