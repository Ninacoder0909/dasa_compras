<?php

require '../../conexion.php';
session_start();



$operacion = $_REQUEST['voperacion'];
$usuario = $_REQUEST['vusuario'];
$fecha = $_REQUEST['vfecha'];



$sql = "SELECT sp_ajustes(" . $operacion . "," .
    (!empty($usuario) ? $usuario : 0) . ",'" .
    (!empty($fecha) ? $fecha : 0) . "') AS ajustes;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ajustes'] != NULL) {
    $valor = explode("*", $resultado[0]['ajustes']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ajustes_index.php");
}
