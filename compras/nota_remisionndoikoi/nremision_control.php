<?php 

require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vnremision']; //
$auto = $_REQUEST['auto'];  //
$motivo = $_REQUEST['vmotivo']; //
$fechai = $_REQUEST['fechainicio']; //
$timbrado = $_REQUEST['vtimbrado']; //
$sucsalida = $_REQUEST['vsucsalida']; //
$sucentrada = $_REQUEST['vsucentrada'];  //
$usuario = $_REQUEST['vusuario']; //
$chofer = $_REQUEST['vidchofer']; //

$sql = "SELECT sp_nremision(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($auto) ? $auto:0).",'".
        (!empty($motivo) ? $motivo:'VACIO')."','".
        (!empty($fechai) ? $fechai:"0001-01-01 00:00:00")."','".
        (!empty($timbrado) ? $timbrado:'VACIO')."',".
        (!empty($sucsalida) ? $sucsalida:0).",".
        (!empty($sucentrada) ? $sucentrada:0).",".
        (!empty($usuario) ? $usuario:0).",".
        (!empty($chofer) ? $chofer:0).") AS nremision;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nremision'] != NULL) {
    $valor = explode("*" , $resultado[0]['nremision']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:nremision_index.php");
}