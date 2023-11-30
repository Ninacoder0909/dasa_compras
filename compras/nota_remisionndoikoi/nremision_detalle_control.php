<?php 

require '../../conexion.php';
session_start();
        
$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vidremision']; //
$producto = $_REQUEST['vproducto']; //
$deposito = $_REQUEST['vdeposito']; //
$cantidad = $_REQUEST['vcantidad']; //
$destino = $_REQUEST['vdepodestino']; //



$sql = "SELECT sp_nremision_detalle(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).",".
        (!empty($destino) ? $destino:0).") AS nremision;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['nremision'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['nremision'];
    header("location:nremision_detalle.php?vidremision=". $_REQUEST['vidremision']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nremision_detalle.php?vidremision=" .$_REQUEST['vidremision']);
}