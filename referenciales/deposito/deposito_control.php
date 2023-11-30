<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcodigo'];
$idsucursal = $_REQUEST['vidsucursal'];//
$depdescri = $_REQUEST['vdepdescri']; //   
$suctelefono = $_REQUEST['vsuctelefono'];//
$sucdireccion = $_REQUEST['vsucdireccion']; //

$sql = "SELECT sp_ref_deposito(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($idsucursal) ? $idsucursal:0).",'".
        (!empty($depdescri) ? $depdescri:"VACIO")."','".
        (!empty($suctelefono) ? $suctelefono:"VACIO")."','".
        (!empty($sucdireccion) ? $sucdireccion:"VACIO")."') AS deposito;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deposito'] != NULL) {
    $valor = explode("*" , $resultado[0]['deposito']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:deposito_index.php");
}