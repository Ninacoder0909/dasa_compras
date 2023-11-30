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
                            <h3 style="text-align: center">Compras - Detalle</h3>
                            <!--CABECERA-->
                            <div class="box box-primary"  style="border-width: 30px">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cabecera</h3>
                                    <div class="box-tools">
                                        <a href="compras_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>                                     
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $idpedido = $_REQUEST['vidcompra'];
                                            $compras = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra = $idpedido ");
                                            if (!empty($compras)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Iva</th>
                                                                <th class="text-center">Total</th>    
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($compras AS $c) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $c['id_compra']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['fecha_pedido1']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['prv_razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['ivatotal']; ?></td>
                                                                    <td class="text-center"> <?php echo $c['totalc']; ?></td>
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
                                    <h3 class="box-title">Detalles Items</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidcompra'];
                                        $comprasdetalle = consultas::get_datos("SELECT * FROM v_compras_detalle WHERE id_compra = $idpedido");
                                        if (!empty($comprasdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Prec Unit.</th>    
                                                            <th class="text-center">Subtotal</th>    
                                                            <th class="text-center">Iva 5</th>    
                                                            <th class="text-center">Iva 10</th>    
                                                            <th class="text-center">Exentas</th>
                                                            <?php if ($c['estado'] == 'ACTIVO') { ?>
                                                                <th class="text-center">Acciones</th> 
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($comprasdetalle AS $cd) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $cd['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['precio']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['subtotal']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['iva5']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['iva10']; ?></td>
                                                                <td class="text-center"> <?php echo $cd['exentas']; ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($c['estado'] == 'ACTIVO') { ?>
                                                                        <a onclick="quitar(<?php echo "'" . $cd['id_compra'] . "_" . $cd['pro_cod'] . "_" . $cd['id_depo'] . "'"; ?>);"
                                                                           class="btn btn-danger btn-sm" role="button" data-title="Quitar"
                                                                           rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
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
                            <?php if ($c['estado'] == 'ACTIVO') { ?>
                                <div class="box box-primary" style="width: 550px; height: 365px;margin: 0 auto;border-width: 30px">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Items</h3>
                                    </div>
                                    <div class="box-body no-padding" style="">
                                        <?php if ($c['estado'] == 'ACTIVO') { ?>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="compras_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                    <div class="box-body" style="left: 1000px;">
                                                        <input type="hidden" name="voperacion" value="1"/>
                                                        <input type="hidden" name="vidcompra" value="<?php echo $_REQUEST['vidcompra']; ?>"/>
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6" style="">
                                                                    <?php $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                                    <select class="select2" name="vdeposito" required="" style="width: 300px;">
                                                                        <?php
                                                                        if (!empty($depositos)) {
                                                                            foreach ($depositos AS $deposito) {
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
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod IN (SELECT pro_cod FROM ref_stock)") ?>
                                                                    <select class="select2" name="vproducto" required="" style="width: 300px;"
                                                                            id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()">
                                                                        <option value=""></option>
                                                                                <?php
                                                                                if (!empty($productos)) {
                                                                                    foreach ($productos AS $producto) {
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
                                                            <div class="form-group" id="precio">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="text" name="vprecio" class="form-control"
                                                                           min="0" value="0" readonly="" onkeypress="return soloNUM(event)" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vcantidad"  onkeypress="return soloNUM(event)" class="form-control" id="idcantidad" required=""
                                                                           onchange="calsubtotal();" onkeydown="calsubtotal();"   min="0" value="1" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Subtotal</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="text" name="vsubtotal" class="form-control"
                                                                           min="0" value="0" id="idsubtotal" readonly="" style="width: 300px;">
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
                            <!--AGREGAR DETALLE-->
                        </div>
                    </div>
                </div>
            </div>
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
        $("#mensaje").delay(1500).slideUp(200, function () {
            $(this).alert('close');
        });

        function calsubtotal() {
            var precio = parseInt($('#idprecio').val());
            var cant = parseInt($('#idcantidad').val());
            $('#idsubtotal').val(precio * cant);
        }

        function quitar(datos) { 
            var dat = datos.split("_");
            $('#si').attr('href', 'compras_detalle_control.php?vidcompra=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el producto del detalle <i><strong>' + dat[1] + '</strong></i>?');
        }

        function obtenerprecio() {
            var dat = $('#idproducto').val().split("_");
            if (parseInt($('#idproducto').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/dasa/compras/compras/listar_precios.php?vidproducto=" + dat[0], cache: false,
                    beforeSend: function () {
                        $('#precio').html('<img src="/dasa/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong></img>');
                    },
                    success: function (msg) {
                        $('#precio').html(msg);
                        calsubtotal();
                    }
                });
            }
        }
    </SCRIPT>
</HTML>
