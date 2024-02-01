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

    function soloNUM(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "0123456789",
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

    function factu(e) {
        var key = e.keyCode || e.which;
        var tecla = String.fromCharCode(key).toLowerCase();
        var permitidos = "0123456789-";
        var especiales = [8];
        var tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (permitidos.indexOf(tecla) == -1 && !tecla_especial) {
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
                                <h3 class="box-title"> Agregar Nota de Credito</h3>
                                <div class="box-tools">
                                    <a href="ncredito_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>

                                </div>

                            </div>
                            <form action="ncredito_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cod. Nota Credito</label>
                                            <?php $compras = consultas::get_datos("SELECT COALESCE(MAX(id_credito),0)+1 AS ultimo FROM n_credit;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vncredito" readonly="" value="<?php echo $compras[0]['ultimo']; ?>" required="">
                                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php date_default_timezone_set('America/Asuncion'); ?>
                                                <input class="form-control" type="hidden" readonly="" name="vfechasis" value="<?php echo date("Y-m-d h:i"); ?>">
                                                <input class="form-control" type="date" readonly="" name="vfechitap" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha Nota Credito</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" name="vfechareci" min="<?php echo date("2022-01-01"); ?>" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="pedis">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Seleccionar Factura de Compra</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM v_compras    where estado = 'CONFIRMADO' ORDER BY nro_factura"); ?>
                                                <select class="form-control" name="vidcompra" id="pedido" required="" onchange="obtenerord();tiposelect()" onclick="obtenerord()">
                                                    <option value="">Debe seleccionar al menos una Factura</option>
                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['id_compra']; ?>"><?php echo $m['nro_factura']; ?><?php echo '  | Proveedor:  '; ?><?php echo $m['prv_razon_social']; ?><?php echo '  | Fecha:   '; ?><?php echo $m['fechac']; ?></option>
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
                                        <div class="form-group" id="pedis">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Motivo</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM motivo_nota where tipo_nota = 'NOTA CREDITO'"); ?>
                                                <select class="form-control" name="vmotivo" required="">
                                                    <option value="">Debe seleccionar al menos un motivo</option>
                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['id_motinota']; ?>"><?php echo $m['descripcion']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="vsucursal" value="<?php echo $_SESSION['id_sucursal']; ?>">

                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. de factura</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" placeholder="FORMATO:000-000-0000000" onkeypress="return factu(event)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" onkeypress="return SoloNum(event)" name="vnrofactura" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" maxlength="8" minlength="8" placeholder="INSERTE 8 DIGITOS" onkeypress="return soloNUM(event)" name="vnrotimp" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" name="vetimp" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="box-body" id="pedi_detalle" style="display: none">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="box-header" style="text-align: center;">
                                                    <h3>Detalles De Compras <i class="ion ion-clipboard"></i></h3>
                                                </div>
                                                <div id="pedid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                    <button class="btn btn-success" type="submit"> Registrar</button>
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



    function tiposelect() {
        if (document.getElementById('pedido').value > 0) {

            detalle1 = document.getElementById('pedi_detalle');
            detalle1.style.display = '';

        } else {

            if (document.getElementById('pedido').value == 0) {

                //DETALLES
                detalle1 = document.getElementById('pedi_detalle');
                detalle1.style.display = 'none';
            }


        }
    }
    window.onload = tiposelect();

    function obtenerord() {
        var dat = $('#pedido').val().split("_");
        if (parseInt($('#pedido').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/nota_debito/listar_compra.php?vidcompra=" + dat[0],
                cache: false,
                beforeSend: function() {
                    $('#pedid').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif">\n\<strong><i>En proceso...</i></strong></img>');
                },
                success: function(msg) {
                    $('#pedid').html(msg);


                }
            });
        }
    }
</script>

</html>