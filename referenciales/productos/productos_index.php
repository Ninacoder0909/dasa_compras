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

<body class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F">
    <div class=" wrapper">
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
                                <h3 class="box-title">Productos</h3>
                                <div class="box-tools">
                                    <!-- <a href="productos_add.php" class="btn btn-success pull-right btn-sm" style="padding: 8px; margin: 1px">
                                            <i class="fa fa-plus"></i>
                                        </a> -->
                                    <!-- <a href="productos_print.php" class="btn btn-bitbucket pull-right btn-sm" style="padding: 8px; margin: 1px">
                                            <i class="fa fa-print"></i>
                                        </a> -->
                                    <!--BUSCADOR-->
                                    <form action="productos_index.php" method="POST" accept-charset="UTF-8" class="form-inline">
                                        <div style="float: right; width: 52%;display: block;">
                                            <div class="form-group-sm">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form ">
                                                            <input type="text" class="form-control" name="buscar" placeholder="Producto" style="margin: 0.2px">
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
                                        $productos = consultas::get_datos("SELECT * FROM v_ref_producto WHERE pro_cod !=0 AND (pro_cod||TRIM(UPPER(pro_descri))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY pro_cod");

                                        if (!empty($productos)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class=" table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Marca</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <!-- <th class="text-center">Tipo</th>
                                                            <th class="text-center">Unidad</th>
                                                            <th class="text-center">Impuesto</th>
                                                            <th class="text-center">P. Costo</th>
                                                            <th class="text-center">P. venta</th> -->
                                                            <th class="text-center">Codigo B</th>
                                                            <!-- <th class="text-center">Imagen</th> -->
                                                            <!-- <th class="text-center">Acciones</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($productos as $p) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $p['pro_cod'] ?></td>
                                                                <td class="text-center"> <?php echo $p['pro_descri'] ?></td>
                                                                <td class="text-center"> <?php echo $p['mar_descri'] ?></td>
                                                                <td class="text-center"> <?php echo $p['cant'] ?></td>
                                                                <!-- <td class="text-center"> <?php echo $p['tipro_descri'] ?></td>
                                                                <td class="text-center"> <?php echo $p['unidadmedida'] ?></td>
                                                                <td class="text-center"> <?php echo $p['impuesto'] ?></td>
                                                                <td class="text-center"> <?php echo $p['precio_costo'] ?></td>
                                                                <td class="text-center"> <?php echo $p['precio_venta'] ?></td> -->
                                                                <td class="text-center"> <?php echo $p['codigo_barra'] ?></td>
                                                                <!-- <td class="text-center"><img height="45px" src="/dasa_compras/img/productos/<?php echo $p['pro_imagen']; ?>" /></td> -->
                                                                <!-- <td class="text-center">
                                                                    <a href="productos_edit.php?vid_productos=<?php echo $p['pro_cod'] ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Editar" rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                    </a>

                                                                    <a href="productos_delete.php?vid_productos=<?php echo $p['pro_cod'] ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Borrar" rel="tooltip" data-placement="top">
                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                    </a>
                                                                </td> -->
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
</script>

</html>