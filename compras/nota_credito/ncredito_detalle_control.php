<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vidcredito']; //
$deposito = $_REQUEST['vdeposito']; //
$producto = $_REQUEST['vproducto']; //
$cantidad = $_REQUEST['vcantidad']; //
$precio = $_REQUEST['vprecio']; //


$sql = "SELECT sp_ncredito_detalle(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
         (!empty($deposito) ? $deposito:0).",".
        (!empty($producto) ? $producto:0).",".
        (!empty($cantidad) ? $cantidad:0).",".
        (!empty($precio) ? $precio:0).") AS ncredito;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['ncredito'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['ncredito'];
    header("location:ncredito_detalle.php?vidcredito=". $_REQUEST['vidcredito']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ndebito_detalle.php?vidcredito=" .$_REQUEST['vidcredito']);
}