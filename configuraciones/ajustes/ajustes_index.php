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
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Ajustes</h3>
                                <div class="box-tools">
                                    <a href="ajustes_add.php" class="btn btn-success pull-right btn-sm" style="padding: 8px; margin: 1px">
                                        <i class="fa fa-plus"></i>
                                    </a>

                                    <!--BUSCADOR-->
                                    <form action="ajustes_index.php" method="POST" accept-charset="UTF-8" class="form-inline">
                                        <div style="float: right; width: 80%;display: block;">
                                            <div class="form-group-sm">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form ">
                                                            <input type="text" class="form-control" name="buscar" placeholder="Codigo/fecha..." style="margin: 0.2px">
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
                            <br><br>

                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $valor = '';
                                        if (isset($_REQUEST['buscar'])) {
                                            $valor = $_REQUEST['buscar'];
                                        }
                                        $grupos = consultas::get_datos("SELECT  * FROM v_ajustes WHERE (id_ajuste||TRIM(fecha_pedido)) LIKE TRIM(UPPER('%" . $valor . "%')) AND estado <> 'ANULADO' ORDER BY id_ajuste");
                                        //$grupos = consultas::get_datos("SELECT * FROM ref_grupos ORDER BY gru_cod");
                                        if (!empty($grupos)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class=" table col-lg-12 col-md-12 col-xs-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <!--                                                                <th class="text-center">Producto</th>
                                                                <th class="text-center">Deposito</th>
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Cantidad</th>-->
                                                            <th class="text-center">Fecha de Ajuste</th>
                                                            <th class="text-center">Usuario</th>
                                                            <th class="text-center">Acciones</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($grupos as $p) { ?>
                                                            <tr>
                                                                <td class="text-center" data-title="Producto "> <?php echo $p['id_ajuste'] ?></td>
                                                                <!--                                                                    <td class="text-center" data-title="Producto "> ?php echo $p['pro_descri'] ?></td>
                                                                    <td class="text-center" data-title="Deposito "> ?php echo $p['dep_descri'] ?></td>
                                                                    <td class="text-center" data-title="Deposito "> ?php echo $p['descripcion'] ?></td>
                                                                    <td class="text-center" data-title="Cantidad "> ?php echo $p['cantidad'] ?></td>-->
                                                                <td class="text-center" data-title="Cantidad "> <?php echo $p['fecha'] ?></td>
                                                                <td class="text-center" data-title="Cantidad "> <?php echo $p['usu_nick'] ?></td>
                                                                <td style="" class="text-center">

                                                                    <a href="ajuste_det.php?vidpedido=<?php echo $p['id_ajuste']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
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
    $("#mensaje").delay(3000).slideUp(200, function() {
        $(this).alert('close');
    });
    //PARA QUE EL FOCO SE VAYA EN EL INPUT
    $(".modal").on('shown.bs.modal', function() {
        $(this).find('input:text:visible:first').focus();
    });
</script>

</html>