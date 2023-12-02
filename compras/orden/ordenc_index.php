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
        <div class="content-wrapper" style="background-color:  #DEEBFE ">
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
                        <div class="box box-primary" style="background-color: white ">
                            <div class="box-header" style="text-align: center">

                                <i class="ion ion-clipboard"></i>
                                <h2 class="box-title" style="margin: 7px;">Orden de compra</h2>
                                <div class="box-tools" style="margin: 1px">

                                    <a href="ordenc_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;padding: 8px">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="ordenc_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Codigo/proveedor..." autofocus="" style="height: 25px;" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-dropbox btn-sm" data-title="Buscar" data-placement="bottom" rel="tooltip">
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
                                        $ordenc = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE (id_ordenc||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%')) AND estado <> 'ANULADO' ORDER BY id_ordenc");
                                        if (!empty($ordenc)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered" style="border: black solid thin;">
                                                    <thead>
                                                        <tr style="background-color: #ABD3D1">
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">#</th>
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">N° presupuesto</th>
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">Fecha</th>
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">Usuario</th>
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">Proveedor</th>
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">Total</th>
                                                            <th style="border: #ABD3D1 solid;border: black solid thin" class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($ordenc as $pc) {
                                                            $total = consultas::get_datos("SELECT sum(cantidad*precio_unit) as total FROM v_orden_detalle where id_ordenc=$pc[id_ordenc]");
                                                            if ($total !== false && isset($total[0]['total'])) {
                                                                $resultado = $total[0]['total'];
                                                            } else {
                                                                $resultado = 0;
                                                            } ?>

                                                            <tr>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin"> <?php echo $pc['id_ordenc']; ?></td>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin"> <?php echo $pc['id_presupuesto']; ?> </td>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin"> <?php echo $pc['orden_fecha']; ?></td>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin"> <?php echo $pc['usu_nick']; ?></td>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin"> <?php echo $resultado; ?></td>
                                                                <td class="text-center" style="border: #ABD3D1 solid;border: black solid thin">
                                                                    <?php
                                                                    if ($pc['estado'] == 'ACTIVO') {
                                                                        $pcdetalle = consultas::get_datos("SELECT * FROM v_orden_detalle WHERE id_ordenc=" . $pc['id_ordenc']);
                                                                        if (!empty($pcdetalle)) {
                                                                    ?>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php if ($pc['estado'] == 'CONFIRMADO') { ?>
                                                                    <?php } ?>
                                                                    <a href="ordenc_detalle.php?vidorden=<?php echo $pc['id_ordenc']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
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