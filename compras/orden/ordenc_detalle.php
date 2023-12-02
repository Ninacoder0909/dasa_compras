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

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">

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
                        <h3 style="text-align: center">Orden de Compras - Detalle</h3>
                        <!--DETALLE ORDEN PRESUPUESTO-->
                        <?php
                        $pedido = $_REQUEST['vidorden'];
                        $presupuestos = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE id_ordenc = $pedido ");
                        if (!empty($presupuestos)) {
                        ?>
                            <?php foreach ($presupuestos as $pre) { ?>
                            <?php } ?>
                            <?php if ($pre['estado'] <> 'ANULADO') { ?>
                                <!-- CABECERA SI ES CON PEDIDO -->
                                <div class="box box-primary" style="border-width: 30px">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Cabecera</h3>
                                        <?php
                                        $idpedido = $_REQUEST['vidorden'];
                                        $confirmar = consultas::get_datos("SELECT * FROM v_orden_detalle WHERE id_ordenc = $idpedido");
                                        if (!empty($confirmar)) {
                                        ?>
                                            <?php foreach ($confirmar as $con) { ?>
                                            <?php } ?>
                                            <?php if ($con['estado'] == 'ACTIVO') { ?>
                                                <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" onclick="registrar_confirmacion(<?php echo "'" . $_REQUEST['vidorden'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                                    <span style="color: #0DB01F" class="glyphicon glyphicon-ok-sign"></span>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                        <div class="box-tools">
                                            <a style="margin: 1px" href="ordenc_index.php" class="btn btn-toolbar pull-right btn-lg" data-title="Volver atras" rel="tooltip" data-placement="top">
                                                <i class="fa fa-arrow-left"></i>
                                            </a>
                                            <?php
                                            $idpedido = $_REQUEST['vidorden'];
                                            $anular1 = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE id_ordenc = $idpedido");
                                            if (!empty($anular1)) {
                                            ?>
                                                <?php foreach ($anular1 as $an1) { ?>
                                                <?php } ?>
                                                <?php if ($an1['estado'] == 'CONFIRMADO') { ?>
                                                    <a data-toggle="modal" data-target="#anular" onclick="anulacion(<?php echo "'" . $_REQUEST['vidorden'] . "'" ?>);" class="btn btn-toolbar btn-lg pull-right" role="button" rel="tooltip" data-title="Anular" rel="tooltip" data-placement="top">
                                                        <span style="color: red;margin: 3px " class="glyphicon glyphicon-ban-circle"></span>
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <?php
                                                $idpedido = $_REQUEST['vidorden']; //CONSULTA PRINCIPALLLLLLL
                                                $ordenc = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE id_ordenc = $idpedido  ");
                                                if (!empty($ordenc)) {
                                                ?>
                                                    <div class="table-responsive">
                                                        <table class="table col-lg-12 col-md-12 col-xs-12">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th class="text-center">Fecha</th>
                                                                    <th class="text-center">N° Presupuesto</th>
                                                                    <th class="text-center">Proveedor</th>
                                                                    <th class="text-center">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($ordenc as $pp) {
                                                                    $total = consultas::get_datos("SELECT sum(cantidad*precio_unit) as total FROM v_orden_detalle where id_ordenc=$pp[id_ordenc]");
                                                                    if ($total !== false && isset($total[0]['total'])) {
                                                                        $resultado = $total[0]['total'];
                                                                    } else {
                                                                        $resultado = 0;
                                                                    } ?>
                                                                    <tr>
                                                                        <td class="text-center"> <?php echo $pp['id_ordenc']; ?></td>
                                                                        <td class="text-center"> <?php echo $pp['orden_fecha']; ?></td>
                                                                        <td class="text-center"> <?php echo $pre['id_presupuesto']; ?></td>
                                                                        <td class="text-center"> <?php echo $pp['prv_razon_social']; ?></td>
                                                                        <td class="text-center"> <?php echo $resultado; ?></td>
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
                                <!-- CABECERA SI ES CON PRESUPUESTO -->
                                <!--DETALLE DE ORDEN DE COMRPAS-->
                                <div class="box box-primary" style="border-width: 30px">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Detalles Orden de Compras</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $idpedido = $_REQUEST['vidorden'];
                                            $pedidoscdetalle = consultas::get_datos("SELECT * from v_orden_detalle WHERE id_ordenc= $idpedido");
                                            if (!empty($pedidoscdetalle)) {
                                            ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Producto</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <th class="text-center">Precio</th>
                                                                <?php if ($pp['estado'] == 'ACTIVO') { ?>
                                                                    <th class="text-center">Acciones</th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pedidoscdetalle as $pcd) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['precio_unit']; ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($pp['estado'] == 'ACTIVO') { ?>
                                                                            <a onclick="quitar(<?php echo "'" . $pcd['id_ordenc'] . "_" . $pcd['pro_cod'] . "'"; ?>);" class="btn btn-danger btn-sm" role="button" data-title="Quitar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
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
                                                    <span class="glyphicon glyphicon-info-sign"></span> La Orden de compra no tiene detalles...
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!--FIN DETALLE DE ORDEN DE COMRPAS-->
                            <?php } ?>
                        <?php } ?>

                        <!--AGREGAR NUEVOS ITEMS-->
                        <?php
                        $idpedido = $_REQUEST['vidorden'];
                        $agregarped = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE id_ordenc = $idpedido");
                        if (!empty($agregarped)) {
                        ?>
                            <?php foreach ($agregarped as $ap) { ?>
                            <?php } ?>
                            <?php if ($ap['estado'] == 'ACTIVO') { ?>
                                <div class="box box-primary" style="width: 550px; height: AUTO;margin: 0 auto;border-width: 30px">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Items</h3>
                                    </div>
                                    <div class="box-body no-padding" style="">
                                        <?php if ($ap['estado'] == 'ACTIVO') { ?>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="ordenc_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                    <div class="box-body" style="left: 1000px;">
                                                        <input type="hidden" name="voperacion" value="1" />
                                                        <input type="hidden" name="vidorden" value="<?php echo $_REQUEST['vidorden']; ?>" />
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM ref_producto where pro_cod != 0 AND pro_cod in(select pro_cod from det_presup where id_presupuesto = $ap[id_presupuesto] ) ORDER BY pro_cod") ?>
                                                                    <select class="select2" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()" name="vproducto" required="" style="width: 300px;">
                                                                        <option value=""></option>
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

                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vcantidad" onkeypress="return soloNUM(event)" id="idcantidad" class="form-control" required="" onchange="calsubtotal();" onkeydown="calsubtotal();" min="0" max="500" value="1" style="width: 300px;">
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
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!--AGREGAR NUEVOS ITEMS-->
                    </div>
                </div>
            </div>
        </div>
        <!-- EDITAR  PRECIO-->
        <?php
        $idpedido = $_REQUEST['vidorden'];
        $modificar = consultas::get_datos("SELECT * FROM v_orden_detalle WHERE id_ordenc = $idpedido");
        if (!empty($modificar)) {
        ?>
            <?php foreach ($modificar as $mod) { ?>
            <?php } ?>
            <div class="modal fade" id="editar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Modificar Precio</strong></h4>
                            <form action="ordenc_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="1" type="hidden">
                                <input name="vproducto" id="producto" type="hidden">
                                <input name="vdeposito" id="deposito" type="hidden">
                                <input type="hidden" name="vcantidad" id="cantid">
                                <input type="hidden" name="vidorden" id="codigo">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="number" onkeypress="return soloNUM(event)" name="vprecio" id="pre" min="1000" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- EDITAR  PRECIO-->
        <!-- CONFIRMAR-->
        <div id="confirmar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="detalles_registrar">

                </div>
            </div>
        </div>
        <!-- CONFIRMAR-->
        <!-- ANULAR-->
        <div id="anular" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="detalles_anular">

                </div>
            </div>
        </div>
        <!-- ANULAR-->
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

    function editar(datos) {
        var dat = datos.split("_"); //ayuda a quitar el guion
        $('#codigo').val(dat[0]);
        $('#producto').val(dat[1]);
        $('#deposito').val(dat[2]);
        $('#cantid').val(dat[3]);
        $('#pre').val(dat[4]);
    }

    function anulacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/orden/ordenc_anular.php?vidorden=" + dat[0],
            beforeSend: function() {
                $('#detalles_anular').html();
            },
            success: function(msg) {
                $('#detalles_anular').html(msg);
            }
        });
    }

    function quitar(datos) {
        var dat = datos.split("_");
        $('#si').attr('href', 'ordenc_detalle_control.php?vidorden=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=4');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar del detalle el producto N° <i><strong>' + dat[1] + '</strong></i>?');
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
            url: "/dasa_compras/compras/orden/ordenc_confirmar.php?vidorden=" + dat[0],
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