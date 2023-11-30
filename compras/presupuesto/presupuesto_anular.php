<?php
require '../../conexion.php';
session_start();

$gru = $_REQUEST['vidpresupuesto'];
?>

<div class="panel-body">
    <form action="presupuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
        <div class="panel-body se">
            <div class="row">
                <?php $resultado = consultas::get_datos("SELECT * FROM v_presupuesto WHERE id_presupuesto =" . $_REQUEST['vidpresupuesto']); ?>
                <div class="form-group">
                    <h4 class="modal-title" style="text-align: center;"><strong>¿Desea anular el presupuesto N° <?php echo $gru ?>?</strong></h4>
                    <input class="form-control" type="hidden" name="voperacion" value="3">
                    <input class="form-control" type="hidden" name="vidproveedor" value="3">
                    <input class="form-control" type="hidden" name="vidpedido" readonly="" value="<?php echo $resultado[0]['id_pedido']; ?>">
                    <input class="form-control" type="hidden" name="vusuario" readonly="" value="<?php echo $resultado[0]['usu_cod']; ?>">
                    <input class="form-control" type="hidden" name="vidpresupuesto" readonly="" value="<?php echo $resultado[0]['id_presupuesto']; ?>">
                    <input class="form-control" type="hidden" name="vfecha" readonly="" value="<?php echo $resultado[0]['fecha']; ?>">
                    <input class="form-control" type="hidden" name="vidproveedore" readonly="" value="<?php echo $resultado[0]['prv_razon_social']; ?>">
                    <input class="form-control" type="hidden" name="valido" readonly="" value="<?php echo $resultado[0]['pres_validez']; ?>">
                    <input class="form-control" type="hidden" name="fecsistema" readonly="" value="<?php echo $resultado[0]['fecha_sistema']; ?>">
                    <input class="form-control" type="hidden" name="vtotal" readonly="" value="<?php echo $resultado[0]['pres_total']; ?>">
                    <input class="form-control" type="hidden" name="vestado" readonly="" value="<?php echo $resultado[0]['estado']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
            <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-trash-o"></i> Anular
            </button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cancelar
            </button>
        </div>
    </form>
</div>