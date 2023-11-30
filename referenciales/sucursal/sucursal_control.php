<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$idciudad = $_REQUEST['vidciudad'];
$sucdescri = $_REQUEST['vsucdescri'];
$suctelefono = $_REQUEST['vsuctel'];
$sucdirec = $_REQUEST['vsucdirec'];

$sql = "SELECT sp_ref_sucursal(" . $operacion . "," . (!empty($codigo)? $codigo:0) . ",". (!empty($idciudad)? $idciudad:0). ",'" . (!empty($sucdescri) ? $sucdescri:0). "','". (!empty($suctelefono) ? $suctelefono:0). "','". (!empty($sucdirec) ? $sucdirec:0) . "') as sucursal;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sucursal'] != NULL) {
    $valor = explode("*" , $resultado[0]['sucursal']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:sucursal_index.php");
}