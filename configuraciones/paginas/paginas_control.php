<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$direccion = $_REQUEST['vdireccion'];
$nombre = $_REQUEST['vnombre'];
$modulo = $_REQUEST['vmodulo'];

$sql = "SELECT sp_paginas(" . $operacion . "," . (!empty($codigo)? $codigo:0) . ",'". (!empty($direccion)? $direccion:0). "','". (!empty($nombre) ? $nombre:0). "',". (!empty($modulo) ? $modulo:0) . ") as pag;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['pag'] != NULL) {
    $valor = explode("*" , $resultado[0]['pag']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:paginas_index.php");
}