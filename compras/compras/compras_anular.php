<?php
require '../../conexion.php';
session_start();

$gru = $_REQUEST['vidcompra'];
?>

<div class="panel-body">
    <form action="compra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
        <div class="panel-body se">
            <div class="row">
                <?php $resultado = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra =" . $_REQUEST['vidcompra']); ?>
                <div class="form-group">
                    <h4 class="modal-title" style="text-align: center;"><strong>¿Desea anular la Compra N° <?php echo ' ' . $resultado[0]['id_compra']; ?>?</strong></h4>
                    <input class="form-control" type="hidden" name="voperacion" value="3">
                    <input class="form-control" type="hidden" name="vidorden" value="1">
                    <input class="form-control" type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                    <input class="form-control" type="hidden" name="vidproveedor" value="<?php echo $resultado[0]['prv_cod']; ?>">
                    <input class="form-control" type="hidden" name="vidcompra" value="<?php echo $resultado[0]['id_compra']; ?>">
                    <input class="form-control" type="hidden" name="vsucursal" readonly="" value="<?php echo $resultado[0]['id_sucursal']; ?>">
                    <input class="form-control" type="hidden" name="vnrofactura" readonly="" value="<?php echo $resultado[0]['nro_factura']; ?>">
                    <input class="form-control" type="hidden" name="vnrotimp" readonly="" value="<?php echo $resultado[0]['timbrado']; ?>">
                    <input class="form-control" type="hidden" name="vfecha" readonly="" value="<?php echo $resultado[0]['fechac']; ?>">
                    <input class="form-control" type="hidden" name="vcantidadcuota" readonly="" value="<?php echo $resultado[0]['cuota']; ?>">
                    <input class="form-control" type="hidden" name="vintervalo" readonly="" value="<?php echo $resultado[0]['intervalo']; ?>">
                    <input class="form-control" type="hidden" name="vetimp" readonly="" value="<?php echo $resultado[0]['tim_vencimiento']; ?>">
                </div>
                <div class="form-group">
                    <br>
                    <label class="col-lg-5 col-sm-4 col-xs-4" style="font-family: serif; color: tomato">Ingrese la contraseña de anulacion*</label>
                    <div class="col-lg-6 col-sm-4 col-xs-4">
                        <input style="padding: 8px" class="form-control" type="password" name="vcondicion" required="">
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;padding-top: 1em;padding-right: 1em;padding: 5px">
            <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-trash-o"></i> Anular
            </button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cancelar
            </button>
        </div>
    </form>
</div>