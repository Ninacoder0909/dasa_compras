<?php session_start() ?> <!-- Para que muestre la sesion guardada -->
<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
</head>

<body class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">
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
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Nota de Debito</h3>
                                <div class="box-tools">
                                    <a href="ndebito_add.php" class="btn btn-success pull-right btn-sm" style="padding: 8px; margin: 1px">
                                        <i class="fa fa-plus"></i>
                                    </a>

                                    <!--BUSCADOR-->
                                    <form action="ndebito_index.php" method="POST" accept-charset="UTF-8" class="form-inline">
                                        <div style="float: right; width: 80%;display: block;">
                                            <div class="form-group-sm">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form ">
                                                            <input type="text" class="form-control" name="buscar" placeholder="Cod/N° factura..." style="margin: 1px">
                                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--  BUSCADOR-->
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $valor = '';
                                        if (isset($_REQUEST['buscar'])) {
                                            $valor = $_REQUEST['buscar'];
                                        }
                                        $ndebito = consultas::get_datos("SELECT * FROM v_ndebito WHERE (id_debito||TRIM(UPPER(factura::text))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_debito");
                                        //$ndebito= consultas::get_datos("SELECT * FROM ref_ndebitoORDER BY id_debito");
                                        if (!empty($ndebito)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class=" table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr style="background-color: #ABD3D1">
                                                            <th style="border: black solid thin;" class="text-center">#</th>
                                                            <th style="border: black solid thin;" class="text-center">Compra N°</th>
                                                            <th style="border: black solid thin;" class="text-center">Proveedor</th>
                                                            <th style="border: black solid thin;" class="text-center">Personal</th>
                                                            <th style="border: black solid thin;" class="text-center">N° factura</th>
                                                            <th style="border: black solid thin;" class="text-center">Fecha</th>
                                                            <th style="border: black solid thin;" class="text-center">Total</th>
                                                            <th style="border: black solid thin;" class="text-center">Iva total</th>
                                                            <th style="border: black solid thin;" class="text-center">Acciones</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($ndebito as $p) {
                                                            $total = consultas::get_datos("SELECT sum(canti*precio) as total FROM v_ndebito_detalle where id_debito=$p[id_debito]");
                                                            if ($total !== false && isset($total[0]['total'])) {
                                                                $resultado = $total[0]['total'];
                                                            } else {
                                                                $resultado = 0;
                                                            }
                                                            $totaliva = consultas::get_datos("SELECT sum(iva5 + iva10 + exentas) as total FROM v_ndebito_detalle where id_debito=$p[id_debito]");
                                                            if ($totaliva !== false && isset($totaliva[0]['total'])) {
                                                                $resultadoiva = $totaliva[0]['total'];
                                                            } else {
                                                                $resultadoiva = 0;
                                                            }

                                                        ?>
                                                            <tr>
                                                                <?php if ($p['estado'] == 'ACTIVO') { ?>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Producto "><span style="color: #0287D0;margin: 3px " class="glyphicon glyphicon-asterisk" /></span> <?php echo $p['id_debito'] ?></td>
                                                                <?php } else { ?>
                                                                    <?php if ($p['estado'] == 'CONFIRMADO') { ?>
                                                                        <td style="border: black solid thin;" class="text-center" data-title="Producto "><span style="color: #0DB01F;margin: 3px " class="glyphicon glyphicon-ok" /></span> <?php echo $p['id_debito'] ?></td>
                                                                    <?php } else { ?>
                                                                        <td style="border: black solid thin;" class="text-center" data-title="Producto "><span style="color: red;margin: 3px " class="glyphicon glyphicon-ban-circle"></span><?php echo $p['id_debito'] ?></td>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Producto "> <?php echo $p['id_compra'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['prv_razon_social'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['nombres'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['factura'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['fecha_pedido1'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $resultadoiva; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $resultado; ?></td>
                                                                <td style="border: black solid thin;" style="border: black solid thin;" data-title="Acciones" class="text-center">


                                                                    <a href="ndebito_detalle.php?viddebito=<?php echo $p['id_debito']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalles" rel="tooltip" data-placement="top">
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
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</body>
<?php require '../../estilos/js_lte.ctp'; ?>
<script>
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
    //PARA QUE EL FOCO SE VAYA EN EL INPUT
    $(".modal").on('shown.bs.modal', function() {
        $(this).find('input:text:visible:first').focus();
    });
</script>

</html>