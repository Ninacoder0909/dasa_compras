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
    function soloLetras(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
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
                            <div class="box-header" style="background-color: #ABD3D1 ">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Agregar Orden de Compra</h3>
                                <div class="box-tools">
                                    <a href="ordenc_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>

                                </div>
                            </div>
                            <form action="ordenc_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vestado" value="ACTIVO">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de Orden</label>
                                            <?php $cp = consultas::get_datos("SELECT COALESCE(MAX(id_ordenc),0)+1 AS ultimo FROM orden_compra;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vidorden" readonly="" value="<?php echo $cp[0]['ultimo']; ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                            <input type="hidden" name="vsucursal" value="<?php echo $_SESSION['id_sucursal']; ?>">
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                <select class="form-control" name="vproveedor" required="" onselect="ontenerpresu();ver_bot()" onclick="obtenerpresu();obtenerpedido();ver_bot()" onchange="obtenerpedido();obtenerpresu();ver_boton_registrar()" id="idprovi">
                                                    <option value="">Debe seleccionar un proveedor</option>
                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['prv_cod']; ?>"><?php echo $m['prv_razon_social']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe seleccionar al menos un proveedor</option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="mostrar_boxpresu">
                                            <div id="pedidos">
                                            </div>
                                        </div>

                                        <div class="box-body">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="box-header" style="text-align: center;">
                                                </div>
                                                <div id="presup">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                    <button class="btn btn-success pull-right" id="btn" type="submit"> Registrar</button>
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
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    function ver_bot() {
        if (document.getElementById('presupuesto').value > 0) {
            registro = document.getElementById('btn');
            registro.style.display = '';
        } else {
            registro = document.getElementById('btn');
            registro.style.display = 'none';
        }
    }



    function bloquear() {
        if (document.getElementById('presupuesto').value > 0) {
            detalle32 = document.getElementById('idprovi');
            detalle32.setAttribute('disabled', 'true');

            registro = document.getElementById('clc');
            registro.style.display = '';

        }
    }

    function obtenerpresu() {
        var dat = $('#presupuesto').val().split("_");
        var dato = $('#idprovi').val().split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/orden/listar_presupuesto_det.php?vidproducto=" + dat[0] + "&vproveedor=" + dato[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#presup').html(msg);
            }
        });

    }

    function obtenerpedido() {
        var dat = $('#idprovi').val().split("_");
        if (parseInt($('#idprovi').val()) > 0) {
            detallepedido = document.getElementById('pedidos');
            detallepedido.style.display = '';
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/orden/listar_presupuesto.php?vidpedido=" + dat[0],
                cache: false,
                beforeSend: function() {
                    $('#pedidos').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
                },
                success: function(msg) {
                    $('#pedidos').html(msg);



                }
            });
        }
    }

    function ocultardetalle() {
        if (parseInt($('#idprovi').val()) < 1) {
            detallepedido = document.getElementById('presup');
            detallepedido.style.display = 'none';
        }
    }

    function limpiarSelects() {

        var selectProveedor = document.getElementById('idprovi');
        var selectPresupuesto = document.getElementById('presupuesto');

        selectProveedor.value = '';
        selectPresupuesto.value = '';

        detalle32 = document.getElementById('idprovi');
        detalle32.removeAttribute('disabled');

        detallepedido = document.getElementById('pedidos');
        detallepedido.style.display = 'none';

        det = document.getElementById('idprovi');
        det.removeAttribute('disabled');
    }
</script>


</html>