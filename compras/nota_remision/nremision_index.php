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
                                <h3 class="box-title">Nota de Remision - Compras</h3>
                                <div class="box-tools">
                                    <a href="nremision_add.php" class="btn btn-success pull-right btn-sm" style="padding: 8px; margin: 1px">
                                        <i class="fa fa-plus"></i>
                                    </a>

                                    <!--BUSCADOR-->
                                    <form action="nremision_index.php" method="POST" accept-charset="UTF-8" class="form-inline">
                                        <div style="float: right; width: 80%;display: block;">
                                            <div class="form-group-sm">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form ">
                                                            <input type="text" class="form-control" name="buscar" placeholder="Cod/Proveedor..." style="margin: 1px">
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
                                        $nremision = consultas::get_datos("SELECT * FROM v_nremision WHERE (id_remision||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%')) AND estado <> 'ANULADO'  ORDER BY id_remision");
                                        if (!empty($nremision)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class=" table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr style="background-color: #ABD3D1">
                                                            <th style="border: black solid thin;" class="text-center">#</th>
                                                            <th style="border: black solid thin;" class="text-center">Conductor</th>
                                                            <th style="border: black solid thin;" class="text-center">ID orden</th>
                                                            <th style="border: black solid thin;" class="text-center">Chapa</th>
                                                            <th style="border: black solid thin;" class="text-center">Proveedor</th>
                                                            <th style="border: black solid thin;" class="text-center">Fecha</th>

                                                            <th style="border: black solid thin;" class="text-center">Acciones</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($nremision as $p) { ?>
                                                            <tr>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Producto "> <?php echo $p['id_remision'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['conductor'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['id_ordenc'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['chapa'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['prv_razon_social'] ?></td>
                                                                <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['fecha'] ?></td>

                                                                <td style="border: black solid thin;" data-title="Acciones" class="text-center">


                                                                    <a href="nremision_detalle.php?vidremision=<?php echo $p['id_remision']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalles" rel="tooltip" data-placement="top">
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
            <!-- CONFIRMAR-->
            <div id="confirmar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="detalles_registrar">

                    </div>
                </div>
            </div>
            <!-- CONFIRMAR-->
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

    function registrar_confirmacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/nota_remision/nremision_terminar.php?vidremision=" + dat[0],
            beforeSend: function() {
                $('#detalles_registrar').html();
            },
            success: function(msg) {
                $('#detalles_registrar').html(msg);
            }
        });
    }
</script>

</html>