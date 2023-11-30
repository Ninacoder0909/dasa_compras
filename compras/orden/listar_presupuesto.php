<?php
session_start();

require '../../conexion.php';
$idproducto = $_REQUEST['vidpedido'];
$productos = consultas::get_datos("SELECT * FROM v_presupuesto WHERE estado = 'CONFIRMADO' AND prv_cod = " . $idproducto);
?>

<?php if (!empty($productos)) { ?>
    <div id="presupo" class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Presupuesto</label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <select style="margin-left: 5px;" class="form-control" name="vidpresupuesto" id="presupuesto" required="" onchange="bloquear();obtenerpresu();ver_bot()" onclick="obtenerpresu();ver_bot()">
                <option id="valor" value="">Debe seleccionar un presupuesto</option>
                <?php
                if (!empty($productos)) {
                    foreach ($productos as $m) {
                ?>
                        <option value="<?php echo $m['id_presupuesto']; ?>"><?php echo $m['id_presupuesto']; ?><?php echo ' | '; ?><?php echo $m['fecha']; ?><?php echo '  '; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="">Debe seleccionar al menos una marca</option>
                <?php }
                ?>
            </select></br>
            <button id="clc" style="display: none; margin-left: 5px;" onclick="limpiarSelects()">Limpiar</button>
        </div>
    </div>

<?php } else { ?>
    <div class="form-group">
        <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?php echo 'NO CONTIENE PRESUPUESTO'; ?>
            <input type="hidden" id="presupuesto" value=0 onchange="obtenerpresu();ver_bot()" />
        </div>
    </div>

<?php } ?>