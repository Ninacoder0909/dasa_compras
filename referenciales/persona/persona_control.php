<?php 

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidcodigo'];
$idciudad = $_REQUEST['vidciudad'];//
$tipopercod = $_REQUEST['vtipopercod']; //   
$pernombre = $_REQUEST['vpernombre'];//
$perapellido = $_REQUEST['vperapellido'];//
$pernrodoc = $_REQUEST['vpernrodoc'];//
$perruc = $_REQUEST['vperruc'];//
$perdireccion = $_REQUEST['vperdireccion']; //
$pertelefono = $_REQUEST['vpertelefono'];//
$peremail = $_REQUEST['vperemail'];//
$persexo = $_REQUEST['vpersexo'];//
$perfechanacimiento = $_REQUEST['vperfechanacimiento'];//
$razonsocial = $_REQUEST['vrazonsocial'];
$perimagen = $_REQUEST['vperimagen'];


$sql = "SELECT sp_ref_persona(" . $operacion . ",".
        (!empty($codigo) ? $codigo:0).",".
        (!empty($idciudad) ? $idciudad:0).",".
        (!empty($tipopercod) ? $tipopercod:0).",'".
        (!empty($pernombre) ? $pernombre:"VACIO")."','".
        (!empty($perapellido) ? $perapellido:"VACIO")."','".
        (!empty($pernrodoc) ? $pernrodoc:"VACIO")."','".
        (!empty($perruc) ? $perruc: "VACIO")."','".
        (!empty($perdireccion) ? $perdireccion:"VACIO")."','".
        (!empty($pertelefono) ? $pertelefono:"VACIO")."','".
        (!empty($peremail) ? $peremail:"VACIO")."','".
        (!empty($persexo) ? $persexo:"VACIO")."','".
        (!empty($perfechanacimiento) ? $perfechanacimiento:"2000/01/01")."','".
        (!empty($razonsocial) ? $razonsocial:"VACIO")."','".
        (!empty($perimagen) ? $perimagen:"VACIO")."') AS persona;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['persona'] != NULL) {
    $valor = explode("*" , $resultado[0]['persona']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:persona_index.php");
}