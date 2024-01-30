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

    function letraNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "abcdefghijklmnopqrstuvwxyz0123456789",
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
                        <h3 style="text-align: center">Ajustes - Detalle</h3>
                        <!--CABECERA-->
                        <div class="box box-primary" style="border-width: 30px">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Cabecera</h3>
                                <?php
                                $idpedido = $_REQUEST['vidpedido'];
                                $confirmar = consultas::get_datos("SELECT * FROM v_ajustes WHERE id_ajuste = $idpedido");
                                if (!empty($confirmar)) {
                                ?>
                                    <?php foreach ($confirmar as $con) { ?>
                                    <?php } ?>
                                    <?php if ($con['estado'] == 'ACTIVO') { ?>
                                        <a style="padding: 10px; margin: 1px" data-toggle="modal" data-target="#confirmar" onclick="registrar_confirmacion(<?php echo "'" . $_REQUEST['vidpedido'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Confirmar" rel="tooltip" data-placement="top">
                                            <span style="color: #0DB01F" class="glyphicon glyphicon-ok-sign"></span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="box-tools">
                                    <a href="ajustes_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidpedido'];
                                        $pedidosc = consultas::get_datos("SELECT * FROM v_ajustes WHERE id_ajuste = $idpedido ");
                                        if (!empty($pedidosc)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">Fecha</th>
                                                            <th class="text-center">Usuario</th>
                                                            <th class="text-center">Sucursal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidosc as $pc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pc['id_ajuste']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['fecha_pedido']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['usu_nick']; ?></td>
                                                                <td class="text-center"> <?php echo $pc['suc_descri']; ?></td>
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
                                    $idpedido = $_REQUEST['vidpedido'];
                                    $pedidoscdetalle = consultas::get_datos("SELECT * FROM v_ajuste_det WHERE id_ajuste = $idpedido");
                                    if (!empty($pedidoscdetalle)) {
                                    ?>
                                        <div class="table-responsive">
                                            <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Producto</th>
                                                        <th class="text-center">Deposito</th>
                                                        <th class="text-center">Cantidad</th>
                                                        <th class="text-center">Motivo</th>
                                                        <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                            <th class="text-center">Acciones</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pedidoscdetalle as $pcd) { ?>
                                                        <tr>
                                                            <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['dep_descri']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                            <td class="text-center"> <?php echo $pcd['descripcion']; ?></td>
                                                            <td class="text-center">
                                                                <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                    <a onclick="quitar(<?php echo "'" . $pcd['id_ajuste'] . "_" . $pcd['pro_cod'] . "'"; ?>);" class="btn btn-danger btn-sm" role="button" data-title="Quitar" rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
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
                                            <span class="glyphicon glyphicon-info-sign"></span> El ajuste no tiene detalles...
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--AGREGAR DETALLE-->
                        <?php if ($pc['estado'] == 'ACTIVO') { ?>
                            <div class="box box-primary" style="width: 550px; height: auto;margin: 0 auto;border-width: 30px">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Agregar Items</h3>
                                </div>
                                <div class="box-body no-padding" style="">
                                    <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="ajuste_det_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <input type="hidden" name="voperacion" value="1" />
                                                    <input type="hidden" name="vidajuste" value="<?php echo $_REQUEST['vidpedido']; ?>" />
                                                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">

                                                        <div class="form-group">
                                                            <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                <?php $productos = consultas::get_datos("SELECT * FROM ref_producto where pro_cod != 0 ORDER BY pro_cod") ?>
                                                                <div class="input-group">
                                                                    <select class="form-control" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()" name="vproducto" required="" style="width: 265px;height: 33px;">
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
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                <input type="number" name="vcantidad" onkeypress="return soloNUM(event)" id="idcantidad" class="form-control" required="" min="1" value="1" max="1000" style="width: 265px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Motivo</label>
                                                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                <?php $productos = consultas::get_datos("SELECT * FROM motivo_ajuste") ?>
                                                                <div class="input-group">
                                                                    <select class="form-control" name="vidmotivo" required="" style="width: 265px;height: 33px;">
                                                                        <option value="">Debe elegir una opcion</option>
                                                                        <?php
                                                                        if (!empty($productos)) {
                                                                            foreach ($productos as $producto) {
                                                                        ?>
                                                                                <option value="<?php echo $producto['id_motivo']; ?>"><?php echo $producto['descripcion']; ?></option>
                                                                            <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <option value="">Debe insertar registros...</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-6 col-sm-6 col-xs-6">Deposito</label>
                                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                                <div class="input-group">
                                                                    <?php $impuesto = consultas::get_datos("SELECT * FROM ref_deposito ORDER BY id_depo"); ?>
                                                                    <select class="form-control select3" name="vdeposito" required="" style="width: 265px;height: 33px;">
                                                                        <option value="">Debe elegir una opcion</option>
                                                                        <?php
                                                                        if (!empty($impuesto)) {
                                                                            foreach ($impuesto as $i) {
                                                                        ?>
                                                                                <option value="<?php echo $i['id_depo']; ?>"><?php echo $i['dep_descri']; ?></option>
                                                                            <?php
                                                                            }
                                                                        } else {
                                                                            ?>

                                                                            <option value="0">Debe selecionar al menos un deposito</option>

                                                                        <?php }
                                                                        ?>
                                                                    </select>
                                                                </div>
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
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!--AGREGAR DETALLE-->
                    </div>
                </div>
            </div>
            <!--MODAL producto-->
            <div class="modal fade" id="registrar_producto" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Registrar Producto</strong></h4>
                        </div>
                        <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <div class="box-body">
                                <!--codigo de barra-->
                                <input type="hidden" name="voperacion" value="1">
                                <input type="hidden" name="vidproducto" value="0">
                                <input type="hidden" name="vidpedido" value="<?php echo $_REQUEST['vidpedido']; ?>" id="vidcompra">
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cod. de barra</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="number" onkeypress="return soloNUM(event)" id="codigo_barra" name="vcodigob" required="" autofocus="">
                                    </div>
                                </div>
                                <!--codigo de barra-->
                                <!--marca-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3 col-sm-2 col-xs-2">Marcas</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <div class="input-group">
                                            <?php $marcas = consultas::get_datos("SELECT * FROM ref_marca ORDER BY mar_cod"); ?>
                                            <select class="form-control select3" name="vidmarca" required="" style="width: 140px;height: 30px;">
                                                <?php
                                                if (!empty($marcas)) {
                                                    foreach ($marcas as $m) {
                                                ?>
                                                        <option value="<?php echo $m['mar_cod']; ?>"><?php echo $m['mar_descri']; ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe seleccionar al menos una marca</option>
                                                <?php }
                                                ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-flat" style="height: 30px;" type="button" data-toggle="modal" data-target="#registrar_marca">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!--marca-->
                                <!--tipo de producto-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3 col-sm-2 col-xs-2">Tipo de producto</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <div class="input-group">
                                            <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipro"); ?>
                                            <select class="form-control select3" name="vidtipro" required="" style="width: 175px;">
                                                <?php
                                                if (!empty($tipoprod)) {
                                                    foreach ($tipoprod as $tp) {
                                                ?>
                                                        <option value="<?php echo $tp['id_tipro']; ?>"><?php echo $tp['tipro_descri']; ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <option value="0">Debe selecionar al menos un tipo de producto</option>

                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--fin tipo de producto-->
                                <!--u. medida-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3 col-sm-2 col-xs-2">U. de medida</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <div class="input-group">
                                            <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_umedida ORDER BY id_um"); ?>
                                            <select class="form-control select3" name="vidum" required="" style="width: 175px;">
                                                <?php
                                                if (!empty($tipoprod)) {
                                                    foreach ($tipoprod as $tp) {
                                                ?>
                                                        <option value="<?php echo $tp['id_um']; ?>"><?php echo $tp['descripcion']; ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <option value="0">Debe selecionar al menos una unidad de medida</option>

                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--impuesto-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3 col-sm-2 col-xs-2">Impuesto</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <div class="input-group">
                                            <?php $impuesto = consultas::get_datos("SELECT * FROM ref_tipo_impuesto ORDER BY id_timp"); ?>
                                            <select class="form-control select3" name="vidimp" required="" style="width: 175px;">
                                                <?php
                                                if (!empty($impuesto)) {
                                                    foreach ($impuesto as $i) {
                                                ?>
                                                        <option value="<?php echo $i['id_timp']; ?>"><?php echo $i['descripcion']; ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <option value="0">Debe selecionar al menos un tipo de impuesto</option>

                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--fin impuesto-->
                                <!--color-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3 col-sm-2 col-xs-2">Color</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <div class="input-group">
                                            <?php $impuesto = consultas::get_datos("SELECT * FROM color ORDER BY id_color"); ?>
                                            <select class="form-control select3" name="vcolor" required="" style="width: 175px;">
                                                <?php
                                                if (!empty($impuesto)) {
                                                    foreach ($impuesto as $i) {
                                                ?>
                                                        <option value="<?php echo $i['id_color']; ?>"><?php echo $i['descripcion']; ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <option value="0">Debe selecionar al menos un color</option>

                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--fin color-->
                                <!--Codigo de descripcion-->
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Descripcion</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="text" onkeypress="return letraNum(event)" id="descripcion" name="vdescripcion" required="">
                                    </div>
                                </div>
                                <!--Fin Codigo de descripcion-->
                                <!--Codigo Precio compra-->
                                <div class="form-group" style="display:none">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio compra</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="number" onkeypress="return soloNUM(event)" name="vprecioc" id="precioc" readonly="" min="0">
                                    </div>
                                </div>
                                <!--Fin Codigo Precio compra-->
                                <!--Codigo Precio venta-->
                                <div class="form-group" style="display:none">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio venta</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="number" onkeypress="return soloNUM(event)" name="vpreciov" id="preciov" readonly="" min="0">
                                    </div>
                                </div>
                                <!--Fin Codigo Precio venta-->
                                <!--Codigo imagen-->
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Imagen</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="file" name="vimagen" min="0" placeholder="Seleccionne una imagen">
                                    </div>
                                </div>
                                <!--Fin Codigo imagen-->

                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_producto">Cerrar</button>
                                <button type="submit" class="btn btn-success pull-right">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--MODAL producto-->
            <!--MODAL MARCAS-->
            <div class="modal fade" id="registrar_marca" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title"><strong>Registrar Marca</strong></h4>
                        </div>
                        <form action="marca_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input type="hidden" name="voperacion" value="1">
                            <input type="hidden" name="vidmarca" value="0" id="vidmarca">
                            <input type="hidden" name="vidpedido" value="<?php echo $_REQUEST['vidpedido']; ?>" id="vidpedido">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2">Descripcion</label>
                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                        <input type="text" class="form-control" onkeypress="return letraNum(event)" name="vdescripcion" required="" id="vmardescri">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrarm">Cerrar</button>
                                <button type="submit" class="btn btn-success pull-right">Registrar</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
            <!--MODAL MARCAS-->

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
        $('#si').attr('href', 'ajuste_det_control.php?vidajuste=' + dat[0] + '&vproducto=' + dat[1] + '&voperacion=2');
        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el producto del detalle <i><strong>' + dat[1] + '</strong></i>?');
    }

    //focus en el primer de marca
    $(document).ready(function() {
        $('#registrar_marca').on('shown.bs.modal', function() {
            $('#vmardescri').focus();
        });
    });
    //focus en codigo de barra
    $(document).ready(function() {
        $('#registrar_producto').on('shown.bs.modal', function() {
            $('#codigo_barra').focus();
        });
    });
</SCRIPT>
<script>
    //LIMPIAR AUTOMÁTICO MARCA
    $("#cerrarm").click(function() {
        $('#vmardescri').val("");
    });
</script>
<script>
    //LIMPIAR AUTOMÁTICO PRODUCTO
    $("#cerrar_producto").click(function() {
        $('#codigo_barra').val("");
        $('#descripcion').val("");
        $('#precioc').val("");
        $('#preciov').val("");
    });

    function registrar_confirmacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/configuraciones/ajustes/ajuste_confirmar.php?vidpedido=" + dat[0],
            beforeSend: function() {
                $('#detalles_registrar').html();
            },
            success: function(msg) {
                $('#detalles_registrar').html(msg);
            }
        });
    }
</script>

</HTML>