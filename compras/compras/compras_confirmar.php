<?php
require '../../conexion.php';
session_start();

if (isset($_REQUEST['vidcompra'])) {
    $gru = $_REQUEST['vidcompra'];
} else {
    echo 'VALORES VACIOS';
}
?>

<div class="panel-body">
    <div class="panel-body se">
        <form action="compra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">

            <h4 class="modal-title" style="text-align: center"><strong>¿Desea confirmar la Compra N° <?php echo $gru ?> ?</strong></h4>
            <input name="voperacion" value="2" type="hidden">
            <input class="form-control" name="vidcompra" type="hidden" value="<?php echo $gru ?>" readonly="" id="codigo" onkeypress="return soloNum(event)" required="">
            <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
                <button type="submit" class="btn btn-success pull-left">
                    <span class="glyphicon glyphicon-ok-sign"></span> Confirmar
                </button>
                <button type="reset" data-dismiss="modal" class="btn btn-danger">
                    <i class="fa fa-close"></i> Cancelar
                </button>
            </div>
        </form>
    </div>