<?php
session_start();
require '../../../conexion.php';
require '../../../estilos/css_lte.ctp';
?>
<form accept-charset="UTF8" class="form-horizontal">
 
    <input name="opcion" value="2" id="opcion" type="hidden"/>
    <div class="col-md-6 col-md-offset-0" style=" margin-top: -14px; border: none;">
        <br>
        <div class="list-group">
            <a href="#" class="list-group-item active"  style="background-color: #ABD3D1;color: black;text-align: center;font-size: 20px">Informes de Nota Remision por Estado</a>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Estados</label>
            <div class="col-sm-6">
                <select id="vestado" class="form-control select2" style="width: 215px;">
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="ANULADO">ANULADO</option>
                    <option value="CONFIRMADO">CONFIRMADO</option>
                    <option value="EN USO">EN USO</option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <div class="col-md-1 pull-right">
                    <a onclick="enviar();" rel="tooltip" data-tittle="Imprimir" class="btn btn-primary"
                       role="button"> 
                        <span class="fa fa-print"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php require '../../../estilos/js_lte.ctp'; ?>
<script>
    function enviar() {
        window.open("/dasa_compras/informes/compras/nremision/nremision_print.php?vciudad=" + "'" + $('#vestado').val() + "'" + '&vopcion=' + $('#opcion').val(), '_blank');

    }
</script>

