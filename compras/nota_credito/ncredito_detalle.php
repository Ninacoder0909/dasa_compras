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
                        <h3 style="text-align: center">Nota de Credito - Detalle</h3>
                        <!--DETALLE ORDEN CON PEDIDO-->
                        <?php
                        $pedido = $_REQUEST['vidcredito'];
                        $pedidos = consultas::get_datos("SELECT * FROM v_ncredito WHERE id_credito = $pedido ");
                        if (!empty($pedidos)) {
                        ?>
                            <?php foreach ($pedidos as $p) { ?>
                            <?php } ?>
                            <!-- CABECERA SI ES CON PEDIDO -->
                            <div class="box box-primary" style="border-width: 30px">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cabecera</h3>
                                    <?php
                                    $idpedido = $_REQUEST['vidcredito'];
                                    $confirmar = consultas::get_datos("SELECT * FROM v_ncredito WHERE id_credito = $idpedido");
                                    if (!empty($confirmar)) {
                                    ?>
                                        <?php foreach ($confirmar as $con) { ?>
                                        <?php } ?>
                                        <?php if ($con['estado'] == 'ACTIVO') { ?>
                                            <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" onclick="registrar_confirmacion(<?php echo "'" . $_REQUEST['vidcredito'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                                <span style="color: #0DB01F" class="glyphicon glyphicon-ok-sign"></span>

                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="box-tools">
                                        <a style="margin: 1px" href="ncredito_index.php" class="btn btn-toolbar pull-right btn-lg" data-title="Volver atras" rel="tooltip" data-placement="top">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                        <?php
                                        $idpedido = $_REQUEST['vidcredito'];
                                        $anular = consultas::get_datos("SELECT * FROM v_ncredito WHERE id_credito = $idpedido");
                                        $fechactual = consultas::get_datos("SELECT current_date as fechap;");
                                        if (!empty($anular)) {
                                        ?>
                                            <?php foreach ($anular as $an) { ?>
                                            <?php } ?>
                                            <?php foreach ($fechactual as $fe) { ?>
                                            <?php } ?>
                                            <?php if ($an['estado'] == 'CONFIRMADO' && $an['fecha_anu'] = $fe['fechap']) { ?>
                                                <a data-toggle="modal" data-target="#anular" onclick="anulacion(<?php echo "'" . $_REQUEST['vidcredito'] . "'" ?>);" class="btn btn-toolbar btn-lg pull-right" role="button" rel="tooltip" data-title="Anular" rel="tooltip" data-placement="top">
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
                                            $idpedido = $_REQUEST['vidcredito']; //CONSULTA PRINCIPALLLLLLL
                                            $compras = consultas::get_datos("SELECT * FROM v_ncredito WHERE id_credito = $idpedido  ");
                                            if (!empty($compras)) {
                                            ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">N° Compra</th>
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Factura</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Iva Total</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($compras as $pc) {
                                                                $total = consultas::get_datos("SELECT sum(cantidad*precio) as total FROM det_credito where id_credito=$pc[id_credito]");
                                                                if ($total !== false && isset($total[0]['total'])) {
                                                                    $resultado = $total[0]['total'];
                                                                } else {
                                                                    $resultado = 0;
                                                                }
                                                                $totaliva = consultas::get_datos("SELECT sum(iva5 + iva10 + exentas) as total FROM det_credito where id_credito=$pc[id_credito]");
                                                                if ($totaliva !== false && isset($totaliva[0]['total'])) {
                                                                    $resultadoiva = $totaliva[0]['total'];
                                                                } else {
                                                                    $resultadoiva = 0;
                                                                }

                                                            ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pc['id_credito']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['fecha_pedido1']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['id_compra']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['descripcion']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['nro_factura']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $resultadoiva; ?></td>
                                                                    <td class="text-center"> <?php echo $resultado ?></td>
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
                            <!-- CABECERA SI ES CON PEDIDO -->
                            <!--DETALLE COMPRAS CON ORDEN-->
                            <div class="box box-primary" style="border-width: 30px">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Detalles de Nota Credito</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidcredito'];
                                        $pedidoscdetalle = consultas::get_datos("SELECT * from det_credito WHERE id_credito = $idpedido");
                                        if (!empty($pedidoscdetalle)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">IVA 5%</th>
                                                            <th class="text-center">IVA 10%</th>
                                                            <th class="text-center">Exentas</th>
                                                            <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                <th class="text-center">Acciones</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidoscdetalle as $pcd) { ?>
                                                            <tr>
                                                                <?php if ($pcd['pro_cod'] > 0) { ?>
                                                                    <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>

                                                                    <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['precio']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['iva5']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['iva10']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['exentas']; ?></td>
                                                                <?php } else { ?>
                                                                    <td class="text-center"> <?php echo '-'; ?></td>
                                                                    <td class="text-center"> <?php echo '-'; ?></td>
                                                                    <td class="text-center"> <?php echo '-'; ?></td>
                                                                    <td class="text-center"> <?php echo '-'; ?></td>
                                                                <?php } ?>
                                                                <td class="text-center">
                                                                    <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                        <a onclick="quitar(<?php echo "'" . $pcd['id_credito'] . "_" . $pcd['pro_cod'] . "'"; ?>);" class="btn btn-danger btn-sm" role="button" data-title="Quitar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
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
                                                <span class="glyphicon glyphicon-info-sign"></span> La nota de credito no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--FIN DETALLE DE COMRPAS CON ORDEN-->
                        <?php } ?>
                        <!--FIN DETALLE ORDEN PRESUPUESTO-->
                        <!--AGREGAR NUEVOS ITEMS-->
                        <?php
                        $idpedido = $_REQUEST['vidcredito'];
                        $agregarped = consultas::get_datos("SELECT * FROM v_ncredito WHERE id_credito = $idpedido");
                        if (!empty($agregarped)) {
                        ?>
                            <?php foreach ($agregarped as $ap) { ?>
                            <?php } ?>
                            <?php if ($ap['estado'] == 'ACTIVO') { ?>
                                <div class="box box-primary" style="width: 550px; height: auto;margin: 0 auto;border-width: 30px">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Items</h3>
                                    </div>
                                    <div class="box-body no-padding" style="">
                                        <?php if ($ap['estado'] == 'ACTIVO') { ?>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="ncredito_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                    <div class="box-body" style="left: 1000px;">
                                                        <input type="hidden" name="voperacion" value="1" />
                                                        <input type="hidden" name="vidcredito" value="<?php echo $_REQUEST['vidcredito']; ?>" />
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM v_compras_detalle where id_compra = (SELECT id_compra from n_credit where id_credito = " . $_REQUEST['vidcredito'] . " )") ?>
                                                                    <select class="select2" id="idproducto" onchange="obtenerprecio();obtenerdeposito()" onkeyup="obtenerprecio();obtenerdeposito()" onclick="obtenerprecio();obtenerdeposito()" name="vproducto" required="" style="width: 300px;height: auto;">
                                                                        <option value="">Seleccionar al menos un producto</option>
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
                                                            <div class="form-group" id="deposito">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="text" name="vdeposito" class="form-control" readonly="" onkeypress="return soloNUM(event)" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="precio">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vprecio" class="form-control" readonly="" min="0" max="10000000" onkeypress="return soloNUM(event)" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" required="" name="vprecio" class="form-control" onkeypress="return soloNUM(event)" min="0" max="10000000" style="width: 300px;">
                                                                </div>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vcantidad" onkeypress="return soloNUM(event)" id="idcantidad" class="form-control" required="" max="1000" min="1" value="1" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="display: none;">
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

        <!-- EDITAR  Cantidad-->
        <div class="modal fade" id="cantidad_orden" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Modificar Cantidad</strong></h4>
                        <form action="compras_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input name="voperacion" value="5" type="hidden">
                            <input name="vproducto" id="product" type="hidden">
                            <input name="vdeposito" id="deposit" type="hidden">
                            <input type="hidden" name="vprecio" id="preci">
                            <input type="hidden" name="vidcredito" id="idcom">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cantidad</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="number" name="vcantidad" min="1" required="" id="cant">
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

        <!-- EDITAR  Cantidad-->
        <!-- EDITAR  PRECIO-->
        <div class="modal fade" id="editar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Modificar Precio</strong></h4>
                        <form action="compras_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input name="voperacion" value="1" type="hidden">
                            <input name="vproducto" id="producto" type="hidden">
                            <input name="vdeposito" id="deposito" type="hidden">
                            <input type="hidden" name="vcantidad" id="cantidad">
                            <input type="hidden" name="vidcredito" id="codigo">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="text" name="vprecio" min="1000" required="" id="pre">
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
        $('#cantidad').val(dat[3]);
        $('#pre').val(dat[4]);
    }

    function cantidad(datos) {
        var dat = datos.split("_"); //ayuda a quitar el guion
        $('#idcom').val(dat[0]);
        $('#product').val(dat[1]);
        $('#deposit').val(dat[2]);
        $('#cant').val(dat[3]);
        $('#preci').val(dat[4]);
    }

    function anulacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/nota_credito/ncredito_anular.php?vidcredito=" + dat[0],
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
        $('#si').attr('href', 'ncredito_detalle_control.php?vidcredito=' + dat[0] + '&vproducto=' + dat[1] + '&voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el registro de la Nota de Credito N° <i><strong>' + dat[0] + '</strong></i>?');
    }

    function calsubtotal() {
        if (parseInt($('#idprecio').val()) > 0) {
            var precio = parseInt($('#idprecio').val());
            var cant = parseInt($('#idcantidad').val());
            $('#idsubtotal').val((precio) * cant);
        }
    }

    function obtenerprecio() {
        var dat = $('#idproducto').val().split("_");
        if (parseInt($('#idproducto').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/nota_credito/listar_precios.php?vidproducto=" + dat[0],
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

    function obtenerdeposito() {
        var dat = $('#idproducto').val().split("_");
        if (parseInt($('#idproducto').val()) > 0) {
            $.ajax({
                type: "GET",
                url: "/dasa_compras/compras/nota_credito/listar_deposito.php?vidproducto=" + dat[0],
                cache: false,
                beforeSend: function() {
                    $('#deposito').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
                },
                success: function(msg) {
                    $('#deposito').html(msg);
                }
            });
        }
    }

    function registrar_confirmacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/nota_credito/ncredito_confirmar.php?vidcredito=" + dat[0],
            beforeSend: function() {
                $('#detalles_registrar').html();
            },
            success: function(msg) {
                $('#detalles_registrar').html(msg);
            }
        });
    }
</SCRIPT>
<SCRIPT>
    function tiposelect() {
        if (document.getElementById('pedi').checked) {


            div = document.getElementById('precio');
            div1 = document.getElementById('producto');
            div2 = document.getElementById('deposito');
            div3 = document.getElementById('cantidad');
            div4 = document.getElementById('tama');
            agregar = document.getElementById('agg');

            div4.style.height = 500;
            div4.style.width = 550;

            div.style.display = '';
            div1.style.display = '';
            div2.style.display = '';
            div3.style.display = '';



        } else {

            div = document.getElementById('precio');
            div1 = document.getElementById('producto');
            div2 = document.getElementById('deposito');
            div3 = document.getElementById('cantidad');
            div4 = document.getElementById('tama');

            div4.style.height = 320;
            div4.style.width = 550;

            div.style.display = 'none';
            div1.style.display = 'none';
            div2.style.display = 'none';
            div3.style.display = 'none';

            $("#producto").val('0');
            $("#deposito").val('0');

        }
    }
    window.onload = tiposelect();
</SCRIPT>

</HTML>