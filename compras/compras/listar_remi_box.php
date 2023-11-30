<?php
session_start();

require '../../conexion.php';
$idproducto = $_REQUEST['vidpedido'];
$productos = consultas::get_datos("SELECT * FROM remision WHERE estado = 'CONFIRMADO' and id_ordenc in (select id_ordenc from orden_compra where estado ='CONFIRMADO' AND prv_cod = " . $idproducto . ")");
?>

<?php if (!empty($productos)) { ?>
    <div class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nota de remision</label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <select class="form-control" name="vidremision" id="remision" onchange="obtenerrem();ver_boton_registrar()" onclick="obtenerrem();ver_boton_registrar()">
                <option id="valorremi" value="">Debe seleccionar una Nota de remision</option>
                <?php
                if (!empty($productos)) {
                    foreach ($productos as $m) {
                ?>
                        <option value="<?php echo $m['id_remision']; ?>"><?php echo $m['id_remision']; ?><?php echo ' | '; ?><?php echo $m['fecha']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                <?php }
                ?>
            </select>
        </div>
    </div>
<?php } else { ?>
    <div id="detalles_fact" class="box-body no-padding">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="alert alert-danger flat">
                <span class="glyphicon glyphicon-info-sign"></span> No hay registros de nota de remision
            </div>
        </div>
    </div>
    <input type="hidden" id="presupuesto" value=0 onchange="obtenerpresu()" <?php } ?>