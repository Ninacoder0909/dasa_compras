<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['viddebito'];
$precio = $_REQUEST['vprecio'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcanti'];

$sql = "SELECT sp_ndebito_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($precio) ? $precio : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . ") AS ndebitodet;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['ndebitodet'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['ndebitodet'];
    header("location:ndebito_detalle.php?viddebito=" . $_REQUEST['viddebito']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ndebito_detalle.php?viddebito=" . $_REQUEST['viddebito']);
}
