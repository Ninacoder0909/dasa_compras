<?php 

require '../../conexion.php';
session_start();




$operacion = $_REQUEST['voperacion']; //
$codigo = $_REQUEST['vcodigo'];     //
$nick = $_REQUEST['vusunick'];     //
$clave = $_REQUEST['vusuclave']; 
$estado = 'ACTIVO';                 //
$sucursal = $_REQUEST['vidsucursal'];
$empleado = $_REQUEST['vidempleado']; //
$grupo = $_REQUEST['vgrucod'];   //       
$foto = $_REQUEST['vusufoto'];

$sql = "SELECT sp_ref_usuario(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",'".
        (!empty($nick) ? $nick:"VACIO")."','".
        (!empty($clave) ? $clave:"VACIO")."','".
        (!empty($estado) ? $estado:"VACIO")."',".
        (!empty($sucursal) ? $sucursal:0).",".
        (!empty($empleado) ? $empleado:0).",".
        (!empty($grupo) ? $grupo:0).",'".
        (!empty($foto) ? $foto:"VACIO")."') AS usuario;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['usuario'] != NULL) {
    $valor = explode("*" , $resultado[0]['usuario']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:usuarios_index.php");
}