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

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">
    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
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
                        <div class="box box-primary">
                            <div class="box-header" style="text-align: center">
                                <i class="ion ion-clipboard"></i>

                                <h2 class="box-title">Pedidos de Compra</h2>
                                <div class="box-tools">
                                    <a href="pedidosc_add.php" class="btn btn-success pull-right btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="pedidosc_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Buscar por codigo/fecha..." autofocus="" style="height: 25px;" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-dropbox btn-sm" style="height: 25PX;" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                                    <span class="fa fa-search"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--BUSCADOR-->
                                        <?php
                                        $valor = '';
                                        if (isset($_REQUEST['buscar'])) {
                                            $valor = $_REQUEST['buscar'];
                                        }
                                        $pedidosc =  consultas::get_datos("SELECT  * FROM v_compras_pedidos WHERE (id_pedido||TRIM(fecha_pedido)) LIKE TRIM(UPPER('%" . $valor . "%')) AND estado <> 'ANULADO' ORDER BY id_pedido");
                                        if (!empty($pedidosc)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-condensed" style="border: black solid thin;">
                                                    <thead>
                                                        <tr style="background-color: #ABD3D1">
                                                            <th style="border: black solid thin;" class="text-center">#</th>
                                                            <th style="border: black solid thin;" class="text-center">Fecha</th>
                                                            <th style="border: black solid thin;" class="text-center">Usuario</th>

                                                            <th style="border: black solid thin;" class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidosc as $pc) { ?>
                                                            <tr>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['id_pedido']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['fecha_pedido1']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['usu_nick']; ?></td>

                                                                <td style="border: black solid thin;" class="text-center">
                                                                    <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if ($pc['estado'] == 'ACTIVO') {
                                                                        $pcdetalle = consultas::get_datos("SELECT * FROM compras_pedido_detalle WHERE id_pedido=" . $pc['id_pedido']);
                                                                        if (!empty($pcdetalle)) {
                                                                    ?>

                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php if ($pc['estado'] == 'CONFIRMADO') { ?>

                                                                        <a href="pedidosc_anular.php?vidpedido=<?php echo $pc['id_pedido']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Anular" rel="tooltip" data-placement="top">
                                                                            <span style="color: tomato" class="glyphicon glyphicon-ban-circle"></span>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <a href="pedidosc_detalle.php?vidpedido=<?php echo $pc['id_pedido']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
                                                                        <i class="fa fa-list"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-danger flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han encontrado registros...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Agregar presupuesto</strong></h4>
                        <form action="presupuesto_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input name="voperacion" value="1" type="hidden">
                            <input name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>" type="hidden">
                            <input name="vfecha" value="<?php echo date("d-m-Y"); ?>" type="hidden">
                            <input type="hidden" name="vtotal" value="0">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">N° Pedido</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" name="vidpedido" type="text" readonly="" id="codigo" onkeypress="return soloNum(event)" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                    <div class="col-lg-5 col-sm-4 col-xs-4">
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
                                    <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez</label>
                                    <div class="col-lg-4 col-sm-4 col-xs-4">
                                        <input class="form-control" type="number" onkeypress="return soloNum(event)" name="vvalidez" value="" min="1" max="365" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                                <button type="submit" class="btn btn-success pull-right">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<SCRIPT>
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    function editar(datos) {
        var dat = datos.split("_"); //ayuda a quitar el guion
        $('#codigo').val(dat[0]);
    }
</SCRIPT>

</HTML>