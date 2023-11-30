<?php
require '../../conexion.php';
session_start();
?>
<div class="modal-header" style="background-color: #ABD3D1">
    <!--    <button type = "button" class = "close" data-dismiss="modal" arial-label="Close">x</button>-->
    <h4 class="modal-title"><strong>Registrar Presupuesto</strong></h4>
</div>
<div class="panel-body">
    <form action="presupuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
        <div class="panel-body se">
            <?php $cp = consultas::get_datos("SELECT COALESCE(MAX(id_presupuesto),0)+1 AS ultimo FROM presupuesto;") ?>
            <input name="voperacion" value="1" type="hidden">
            <input name="vidpresupuesto" value="<?php echo $cp[0]['ultimo']; ?>" type="hidden">
            <input name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" type="hidden">
            <input type="hidden" name="fecsistema" value="<?php echo date("d-m-Y"); ?>">
            <div class="box-body">

                <div class="form-group">
                    <label class="control-label col-lg-2 col-sm-2 col-xs-2">Pedido</label>
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <?php $marcas = consultas::get_datos("SELECT * FROM pedidos_de_compra where estado = 'CONFIRMADO'"); ?>
                        <select class="form-control" name="vidpedido" required="" id="pedido" onchange="tiposelect();obtener_detalle();" onclick="obtener_detalle();">
                            <option value="">Debe seleccionar un Pedido</option>
                            <?php
                            if (!empty($marcas)) {
                                foreach ($marcas as $m) {
                            ?>
                                    <option value="<?php echo $m['id_pedido']; ?>"><?php echo $m['id_pedido']; ?><?php echo ' | '; ?><?php echo $m['fechav']; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-sm-2 col-xs-2">Proveedor</label>
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                        <select class="form-control" name="vidproveedor" required="">
                            <?php
                            if (!empty($marcas)) {
                                foreach ($marcas as $m) {
                            ?>
                                    <option value="<?php echo $m['prv_cod']; ?>"><?php echo $m['prv_razon_social']; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="">Debe seleccionar al menos una marca</option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-sm-2 col-xs-2">Fecha</label>
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <input class="form-control" type="date" id="iddesde" name="vfecha" min="2022-01-01" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-sm-2 col-xs-2">Validez</label>
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <input class="form-control" type="date" id="idhasta" name="valido" value="<?= date('Y-m-d'); ?>" min="" required="">
                    </div>
                </div>
                <div class="box-body" id="pedidos_detalle">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box-header" style="text-align: center;">
                        </div>

                        <div id="ver_detalle">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
                <button type="submit" id="enviar" class="btn btn-success">
                    <i class="fa fa-floppy-o"></i> Registrar
                </button>
                <button type="reset" data-dismiss="modal" class="btn btn-danger">
                    <i class="fa fa-close"></i> Cerrar
                </button>
            </div>
        </div>
    </form>

    <script>
        document.getElementById("iddesde").onchange = function() {
            var input = document.getElementById("idhasta");
            input.setAttribute("min", this.value);
            document.getElementById('idhasta').removeAttribute('disabled');
        }
        document.getElementById("idhasta").onchange = function() {
            var input = document.getElementById("iddesde");
            input.setAttribute("max", this.value);
        }

        function obtener_detalle() {
            var dat = $('#pedido').val().split("_");

            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/presupuesto/presupuesto_pedi.php?vidpresupuesto=" + dat[0],
                cache: false,
                beforeSend: function() {},
                success: function(msg) {
                    $('#ver_detalle').html(msg);
                }
            });

        }
    </script>

    <script>
        function tiposelect() {
            if (document.getElementById('pedido').value > 0) {
                detalle1 = document.getElementById('pedidos_detalle');
                detalle1.style.display = '';
            } else {
                if (document.getElementById('pedido').value == 0) {
                    detalle1 = document.getElementById('pedidos_detalle');
                    detalle1.style.display = 'none'
                    ';
                }
            }
        }
        window.onload = tiposelect();
    </script>