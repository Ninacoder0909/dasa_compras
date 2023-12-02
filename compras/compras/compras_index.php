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
        <div class="content-wrapper" style="background-color: #DEEBFE ">
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
                        <div class="box box-primary" style="background-color: white;">
                            <div class="box-header" style="text-align: center">

                                <i class="ion ion-clipboard"></i>
                                <h2 class="box-title" style="margin: 7px;">Compras</h2>
                                <div class="box-tools" style="margin: 1px">
                                    <a href="compras_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;padding: 8px">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="compras_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Buscar por codigo/proveedor..." autofocus="" style="height: 25px;" />
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
                                        $compras = consultas::get_datos("SELECT * FROM v_compras WHERE (id_compra||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%'))  and estado <> 'ANULADO' ORDER BY id_compra");

                                        if (!empty($compras)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered" style="border: black solid thin;">
                                                    <thead>
                                                        <tr style="background-color: #ABD3D1;">
                                                            <th style="border: black solid thin;" class="text-center">#</th>
                                                            <th style="border: black solid thin;" class="text-center">N° Orden</th>
                                                            <th style="border: black solid thin;" class="text-center">Fecha</th>
                                                            <th style="border: black solid thin;" class="text-center">Proveedor</th>
                                                            <th style="border: black solid thin;" class="text-center">Nro. factura</th>
                                                            <th style="border: black solid thin;" class="text-center">Timbrado</th>
                                                            <th style="border: black solid thin;" class="text-center">Condicion</th>
                                                            <th style="border: black solid thin;" class="text-center">Total compra</th>
                                                            <th style="border: black solid thin;" class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($compras as $c) {
                                                            $total = consultas::get_datos("SELECT sum(cantidad*precio) as total FROM v_compras_detalle where id_compra =$c[id_compra]");
                                                            if ($total !== false && isset($total[0]['total'])) {
                                                                $resultado = $total[0]['total'];
                                                            } else {
                                                                $resultado = 0;
                                                            } ?>

                                                            <tr>
                                                                </td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['id_compra']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['id_ordenc']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['compra_fecha']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['prv_razon_social']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['nro_factura']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['timbrado']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $c['condicion']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $resultado; ?></td>
                                                                <td style="border: black solid thin;" class="text-center">

                                                                    <a href="compras_detalle.php?vidcompra=<?php echo $c['id_compra']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
                                                                        <i class="fa fa-list"></i>
                                                                    </a>
                                                                    <?php if ($c['estado'] == 'CONFIRMADO') { ?>
                                                                        <a href="compras_imprimir_factura.php?vidcompra=<?php echo $c['id_compra']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Imprimir" rel="tooltip" target="_BLANK" data-placement="top">
                                                                            <i style="color: black" class="fa fa-print"></i>
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
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<SCRIPT>
    $("#mensaje").delay(2000).slideUp(200, function() {
        $(this).alert('close');
    });
</SCRIPT>

</HTML>