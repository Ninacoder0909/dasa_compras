<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcompra'];
$producto = $_REQUEST['vproducto'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];
$deposito =  $_REQUEST['vdeposito'];




$sql = "SELECT sp_compras_detalle(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($deposito) ? $deposito : 0) . "," .
    (!empty($producto) ? $producto : 0) . "," .
    (!empty($precio) ? $precio : 0) . "," .
    (!empty($cantidad) ? $cantidad : 0) . ") AS comprasdetalle;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['comprasdetalle'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['comprasdetalle'];
    header("location:compras_detalle.php?vidcompra=" . $_REQUEST['vidcompra']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:compras_detalle.php?vidcompra=" . $_REQUEST['vidcompra']);
}
