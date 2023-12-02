<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximun-scale=1">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
</head>
<script>
    function LetraNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789-",
            especiales = [8],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function SoloNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "0123456789-",
            especiales = [8],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
</script>

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">

    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp' ?>
        <?php require '../../estilos/izquierda.ctp' ?>

        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?php if (!empty($_SESSION['mensaje'])) { ?>
                            <?php
                            $mensaje = explode("_/_", $_SESSION['mensaje']);
                            if (($mensaje[0] == 'NOTICIA')) {
                                $class = "success";
                            } else {
                                $class = "danger";
                            }
                            ?>
                            <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                <i class="ion ion-information-circled"></i>
                                <?php
                                echo $mensaje[1];
                                $_SESSION['mensaje'] = '';
                                ?>
                            </div>
                        <?php } ?>
                        <div class="box box_primary" style="background-color: white">
                            <div class="box-header">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Agregar Compra</h3>
                                <div class="box-tools">
                                    <a href="compras_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>

                                </div>

                            </div>
                            <form action="compra_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de compra</label>
                                            <?php $compra = consultas::get_datos("SELECT COALESCE(MAX(id_compra),0)+1 AS ultimo FROM compra;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vidcompra" readonly="" value="<?php echo $compra[0]['ultimo']; ?>" required="">
                                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. de factura</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" placeholder=" FORMATO: 000-000-0000000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" onkeypress="return SoloNum(event)" name="vnrofactura" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" maxlength="8" minlength="8" placeholder="INSERTE 8 DIGITOS" onkeypress="return SoloNum(event)" name="vnrotimp" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" onkeypress="return SoloNum(event)" name="vetimp" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Condicion</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <select class="form-control" name="vcondicion" id="vcondi" onchange="condicion();">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cant. cuota</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" class="form-control" name="vcantidadcuota" value="1">
                                                <input class="form-control" type="number" value="1" min="1" max="36" name="vcantidadcuota" id="vcancuota">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Intervalo</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" class="form-control" name="vintervalo" value="15">
                                                <select class="form-control" name="vintervalo" id="vintervalo">
                                                    <option value="30">30</option>
                                                    <option value="15">15</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--PROVEEDOR-->
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">

                                                <?php $proveedors = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                <select class="form-control" id="idprovi" name="vidproveedor" required="" onclick="obtenerpedido();ver_boton();obtenernremision()" onchange="obtenerpedido();ver_boton();obtenernremision()">
                                                    <option value="">Debe seleccionar un proveedor</option>
                                                    <?php
                                                    if (!empty($proveedors)) {
                                                        foreach ($proveedors as $p) {
                                                    ?>
                                                            <option value="<?php echo $p['prv_cod']; ?>"><?php echo $p['prv_razon_social']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                    <?php }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <!--PROVEEDOR-->
                                        <div class="form-group" id="botoncito" style="display: none">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <label id="one">
                                                    <input type="checkbox" onclick="tiposelect()" onchange="tiposelect();obtenerord()" name="Pedido" value="pedido" id="pedi" /> Orden de compra
                                                </label>

                                            </div>
                                            <br><br>
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <label id="two">
                                                    <input type="checkbox" onclick="tiposelect();obtenerrem()" onchange="tiposelect();obtenerrem()" name="Nota de remision " value="nota" id="nota" /> Nota de remision
                                                </label>

                                            </div>


                                            <div class="box-body" id="pedi_detalle" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="pedidos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body" id="boxnota" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="not">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body" id="pedi_detalle2" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="pedid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body" id="remidiv" style="display: none">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                    </div>
                                                    <div id="remo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                        <button class="btn btn-success" style="display: none;" id="registro" type="submit"> Registrar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</body>
<?php require '../../estilos/js_lte.ctp'; ?>
<script>
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    function condicion() {
        if (document.getElementById('vcondi').value === "CONTADO") {
            document.getElementById('vcancuota').setAttribute('disabled', 'true');
            document.getElementById('vcancuota').value = '1';
            document.getElementById('vintervalo').setAttribute('disabled', 'true');
        } else {
            document.getElementById('vcancuota').removeAttribute('disabled');
            document.getElementById('vcancuota').value = '1';
            document.getElementById('vintervalo').removeAttribute('disabled');

        }
    }
    window.onload = condicion();

    function tiposelect() {
        if (document.getElementById('pedi').checked) {

            proveedor = document.getElementById('idprovi');
            proveedor.setAttribute('disabled', 'true');

            detalle1 = document.getElementById('pedi_detalle2');
            detalle1.style.display = '';

            detalle1 = document.getElementById('pedi_detalle');
            detalle1.style.display = '';

            registro = document.getElementById('registro');
            registro.style.display = 'none';

            notas = document.getElementById('two');
            notas.style.display = 'none';

            ORDEN = document.getElementById('pedido');
            ORDEN.setAttribute('required', 'true');


            $("#valor").val('0');
        } else {
            if (document.getElementById('nota').checked) {
                r = document.getElementById('remidiv');
                r.style.display = '';

                orden = document.getElementById('one');
                orden.style.display = 'none';

                d = document.getElementById('boxnota');
                d.style.display = '';

                proveedor = document.getElementById('idprovi');
                proveedor.setAttribute('disabled', 'true');

                registro = document.getElementById('registro');
                registro.style.display = 'none';

                ORDEN = document.getElementById('remision');
                ORDEN.setAttribute('required', 'true');


                $("#valorremi").val('0');

            } else {
                d = document.getElementById('boxnota');
                d.style.display = 'none';
                s = document.getElementById('remidiv');
                s.style.display = 'none';

                notas = document.getElementById('two');
                notas.style.display = '';

                orden = document.getElementById('one');
                orden.style.display = ''

                registro = document.getElementById('registro');
                registro.style.display = 'none';

                $("#pedido").val('0');
                $("#remision").val('0');


                detalle1 = document.getElementById('pedi_detalle');
                detalle1.style.display = 'none';

                detalle1 = document.getElementById('pedi_detalle2');
                detalle1.style.display = 'none';

                proveedor = document.getElementById('idprovi');
                proveedor.removeAttribute('disabled');


                prove = document.getElementById('idprovi');
                prove.setAttribute('required', 'true');

            }


        }
    }
    window.onload = tiposelect();



    function obtenerpedido() {
        var dat = $('#idprovi').val().split("_");
        if (parseInt($('#idprovi').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/compras/listar_orden_box.php?vidpedido=" + dat[0],
                cache: false,
                beforeSend: function() {},
                success: function(msg) {
                    $('#pedidos').html(msg);


                }
            });
        }
    }

    function obtenernremision() {
        var dat = $('#idprovi').val().split("_");
        if (parseInt($('#idprovi').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/compras/listar_remi_box.php?vidpedido=" + dat[0],
                cache: false,
                beforeSend: function() {},
                success: function(msg) {
                    $('#not').html(msg);


                }
            });
        }
    }

    function ver_boton() {
        if (document.getElementById('idprovi').value > 0) {
            div = document.getElementById('botoncito');
            div.style.display = '';
            div = document.getElementById('registro');
            div.style.display = 'none';
        } else {
            div = document.getElementById('botoncito');
            div.style.display = 'none';
        }
    }

    function ver_boton_registrar() {
        if (document.getElementById('pedido').value > 0) {
            registro = document.getElementById('registro');
            registro.style.display = '';
        } else {
            if (document.getElementById('remision').value > 0) {
                registro = document.getElementById('registro');
                registro.style.display = '';
            } else {
                registro = document.getElementById('registro');
                registro.style.display = 'none';

            }
        }
    }
</script>

<script>
    function obtenerord() {
        var dat = $('#pedido').val().split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/compras/listar_orden.php?vidorden=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#pedid').html(msg);


            }
        });
    }

    function obtenerrem() {
        var dat = $('#remision').val().split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/compras/listar_remision.php?vidorden=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#remo').html(msg);


            }
        });
    }
</script>

</html>