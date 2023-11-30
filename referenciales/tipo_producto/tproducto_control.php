<?php 

require '../../conexion.php';
session_start();

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre']; //tambien se puede usar request

$sql = "SELECT sp_ref_tproducto(" . $operacion . "," . $codigo . ",'". $nombre . "') as tproducto;";
$resultado = consultas::get_datos($sql);

if($resultado[0]['tproducto'] == null){
    $_SESSION['mensaje'] = 'Error de proceso';
    header("location:tproducto_index.php");
} else {
    $_SESSION['mensaje'] = $resultado[0]['tproducto'];
    header("location:tproducto_index.php");
}