<?php session_start(); ?>
<!DOCTYPE>
<HTML>

<HEAD>
    <meta charset="utf-8">
    <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
</HEAD>
<script>
    function soloNUM(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " 0123456789",
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

<BODY class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #DEEBFE">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <!-- MENSAJE -->
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
                        <!-- MENSAJE -->
                        <h3 style="text-align: center">Ajustes - Detalle</h3>

                        <!--CABECERA-->
                        <div class="box box-primary" style="border-width: 30px">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Cabecera</h3>
                                <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                    <span style="color: #0DB01F" class="glyphicon glyphicon-ok-sign"></span>

                                </a>
                                <?php
                                //                                            $idpedido = $_REQUEST['vidpedido'];
                                $confirmar = consultas::get_datos("SELECT * FROM ajustes WHERE id_ajuste=1");
                                if (!empty($confirmar)) {
                                ?>
                                    <?php foreach ($confirmar as $con) { ?>
                                    <?php } ?>
                                    <?php if ($con['estado'] == 'ACTIVO') { ?>
                                        <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                            <span style="color: #0DB01F" class="glyphicon glyphicon-ok-sign"></span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="box-tools">
                                    <a href="pedidosc_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        //                                            $idpedido = $_REQUEST['vidpedido'];
                                        $pedidosc = consultas::get_datos("SELECT * FROM ajustes WHERE id_ajuste = 1 ");
                                        if (!empty($pedidosc)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Codigo</th>
                                                            <th class="text-center">Fecha y Hora</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidosc as $pc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pc['id_ajuste']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha']; ?></td>


                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--CABECERA-->
                        <!--DETALLE-->
                        <div class="box box-primary" style="border-width: 30px">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Detalles del Ajuste</h3>
                            </div>
                            <div class="box-body no-padding">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <?php
                                    //                                        $idpedido = $_REQUEST['vidpedido'];
                                    $pedidoscdetalle = consultas::get_datos("SELECT * FROM v_ajustes WHERE id_ajuste = 1 ");
                                    if (!empty($pedidoscdetalle)) {
                                    ?>
                                        <div class="table-responsive">
                                            <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Motivo</th>
                                                        <th class="text-center">Producto</th>
                                                        <th class="text-center">Deposito</th>
                                                        <th class="text-center">Cantidad</th>
                                                        <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                            <th class="text-center">Acciones</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pedidoscdetalle as $pcd) { ?>
                                                        <tr>
                                                            <td class="text-center"> Producto defectuoso</td>
                                                            <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['dep_descri']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                            <td class="text-center">
                                                                <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                    <a onclick="quitar(<?php echo "'" . $pcd['id_pedido'] . "_" . $pcd['pro_cod'] . "_" . $pcd['id_depo'] . "'"; ?>);" class="btn btn-danger btn-sm" role="button" data-title="Quitar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger flat">
                                            <span class="glyphicon glyphicon-info-sign"></span> El pedido no tiene detalles...
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--AGREGAR DETALLE-->

                        <div class="box box-primary" style="width: 550px; height: 340px;margin: 0 auto;border-width: 30px">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Agregar Items</h3>
                            </div>
                            <div class="box-body no-padding" style="">

                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <form action="pedidosc_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                        <div class="box-body">
                                            <input type="hidden" name="voperacion" value="1" />
                                            <input type="hidden" name="vidpedido" value="<?php echo $_REQUEST['vidpedido']; ?>" />
                                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Motivo</label>
                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="">
                                                        <select class="select2" name="vdeposito" required="" style="width: 300px;">

                                                            <option value="">Perdida</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="">
                                                        <?php $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_depo != 0 AND id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                        <select class="select2" name="vdeposito" required="" style="width: 300px;">
                                                            <?php
                                                            if (!empty($depositos)) {
                                                                foreach ($depositos as $deposito) {
                                                            ?>
                                                                    <option value="<?php echo $deposito['id_depo']; ?>"><?php echo $deposito['dep_descri']; ?></option>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe insertar registros...</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                        <?php $productos = consultas::get_datos("SELECT * FROM ref_producto where pro_cod != 0 ORDER BY pro_cod") ?>
                                                        <select class="select2" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()" name="vproducto" required="" style="width: 300px;">
                                                            <option value="">Debe elegir una opcion</option>
                                                            <?php
                                                            if (!empty($productos)) {
                                                                foreach ($productos as $producto) {
                                                            ?>
                                                                    <option value="<?php echo $producto['pro_cod']; ?>"><?php echo $producto['pro_descri']; ?></option>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe insertar registros...</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="precio" style="display: none">
                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                        <input type="number" name="vprecio" class="form-control" readonly="" min="0" value="0" onkeypress="return soloNUM(event)" style="width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                        <input type="number" name="vcantidad" onkeypress="return soloNUM(event)" id="idcantidad" class="form-control" required="" onchange="calsubtotal();" onkeydown="calsubtotal();" min="0" value="1" max="1000" style="width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="display: none">
                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Subtotal</label>
                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                        <input type="text" name="vsubtotal" class="form-control" min="0" value="0" id="idsubtotal" readonly="" style="width: 300px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn-success center-block">
                                                <span class="glyphicon glyphicon-plus"></span>Agregar
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <!--AGREGAR DETALLE-->
                    </div>
                </div>
            </div>
        </div>
        <!-- CONFIRMAR-->
        <div id="confirmar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="detalles_registrar">

                </div>
            </div>
        </div>
        <!-- CONFIRMAR-->
        <!-- MODAL DE QUITAR -->
        <div class="modal fade" id="quitar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
                        <h4 class="modal-title custom_align" id="Heading">Atencion!!!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="confirmacion"></div>
                    </div>
                    <div class="modal-footer">
                        <a id="si" role="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok-sign"></span>Si
                        </a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>No
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DE QUITAR -->
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<SCRIPT>
    $("#mensaje").delay(1500).slideUp(200, function() {
        $(this).alert('close');
    });

    function quitar(datos) {
        var dat = datos.split("_");
        $('#si').attr('href', 'pedidosc_detalle_control.php?vidpedido=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el producto del detalle <i><strong>' + dat[1] + '</strong></i>?');
    }

    function calsubtotal() {
        var precio = parseInt($('#idprecio').val());
        var cant = parseInt($('#idcantidad').val());
        $('#idsubtotal').val(precio * cant);
    }

    function obtenerprecio() {
        var dat = $('#idproducto').val().split("_");
        if (parseInt($('#idproducto').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/pedido/listar_precios.php?vidproducto=" + dat[0],
                cache: false,
                beforeSend: function() {
                    $('#precio').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
                },
                success: function(msg) {
                    $('#precio').html(msg);
                    calsubtotal();
                }
            });
        }
    }

    function registrar_confirmacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/pedido/pedidosc_confirmar.php?vidpedido=" + dat[0],
            beforeSend: function() {
                $('#detalles_registrar').html();
            },
            success: function(msg) {
                $('#detalles_registrar').html(msg);
            }
        });
    }
</SCRIPT>

</HTML>