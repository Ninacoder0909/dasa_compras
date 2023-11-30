<?php
require '../../conexion.php';
session_start();

$gru = $_REQUEST['vidremision'];
?>

<div class="panel-body" >
    <form action = "nremision_control.php" method = "post" accept-charset = "utf-8" class = "form-horizontal">
        <div class = "panel-body se">
            <div class="row"  >
                <?php $resultado = consultas::get_datos("SELECT * FROM v_nremision WHERE id_remision =" . $_REQUEST['vidremision']); ?>
                <div class="form-group"  >
                    <h4 class = "modal-title" style="text-align: center;"><strong>¿Desea anular la Nota de Remision N° <?php echo ' ' . $resultado[0]['id_remision']; ?>?</strong></h4>
                    <input class="form-control" type="hidden" name="voperacion" value="3">
                    <input class="form-control" type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                    <input class="form-control" type="hidden" name="vnremision" value="<?php echo $resultado[0]['id_remision']; ?>">
                    
                </div>
                <div class="form-group" >
                    <br>
                    <label class="col-lg-5 col-sm-4 col-xs-4" style="font-family: serif; color: tomato">Ingrese la contraseña de anulacion*</label>
                    <div class="col-lg-6 col-sm-4 col-xs-4">
                        <input style="padding: 8px" class="form-control" type="password" name="vtimbrado" required="">
                    </div>
                </div>

            </div>
        </div>  
        <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;padding-top: 1em;padding-right: 1em;padding: 5px">
            <button    type="submit" class="btn btn-success pull-left">
                <i  class="fa fa-trash-o"></i> Anular
            </button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cancelar
            </button>
        </div>
    </form>
</div>

