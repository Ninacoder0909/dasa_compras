<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpresupuesto'];
$proveedor = $_REQUEST['vidproveedor'];
$pedido = $_REQUEST['vidpedido'];
$usuario = $_REQUEST['vusuario'];
$fsistema = $_REQUEST['fecsistema'];
$validez = $_REQUEST['valido'];
$fecha = $_REQUEST['vfecha'];
$sucur = $_REQUEST['vsucursal'];



$sql = "SELECT sp_presupuesto(" . $operacion . "," .
    (!empty($codigo) ? $codigo : 0) . "," .
    (!empty($sucur) ? $sucur : 0) . "," .
    (!empty($proveedor) ? $proveedor : 0) . "," .
    (!empty($pedido) ? $pedido : 0) . "," .
    (!empty($usuario) ? $usuario : 0) . ",'" .
    (!empty($fsistema) ? $fsistema : "2000/01/01") . "','" .
    (!empty($validez) ? $validez : "2000/01/01") . "','" .
    (!empty($fecha) ? $fecha : "2000/01/01") . "') AS presupuesto;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['presupuesto'] != NULL) {
    $valor = explode("*", $resultado[0]['presupuesto']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:presupuesto_index.php");
}
