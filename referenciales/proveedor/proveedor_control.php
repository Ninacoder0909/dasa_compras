<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$idciudad = $_REQUEST['vidciudad'];
$rsocial = $_REQUEST['vrsocial'];
$ruc  = $_REQUEST['vruc'];
$direc = $_REQUEST['vdirec'];
$tel = $_REQUEST['vtel'];

$sql = "SELECT sp_ref_proveedor(" . $operacion . "," . (!empty($codigo)? $codigo:0) . ",". (!empty($idciudad)? $idciudad:0). ",'" . (!empty($rsocial) ? $rsocial:0). "','". (!empty($ruc) ? $ruc:0). "','". (!empty($direc) ? $direc:0). "','". (!empty($tel) ? $tel:0) . "') as proveedor;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['proveedor'] != NULL) {
    $valor = explode("*" , $resultado[0]['proveedor']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:proveedor_index.php");
}