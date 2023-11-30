<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximun-scale=1">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp' ?>
        <?php require '../../estilos/izquierda.ctp' ?>

        <div class="content-wrapper" style="background-color: rgb(241,231,254);">
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
                        <div class="box box_primary" style="background-color: #ABD3D1">
                            <div class="box-header">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Confirmar Pedido</h3>
                                <div class="box-tools">
                                    <a href="pedidosc_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>

                                </div>

                            </div>
                            <form action="pedidosc_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body" style="background-color: white">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_compras_pedidos WHERE id_pedido =" . $_GET['vidpedido']); ?>
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="3">
                                        <input type="hidden" name="vestado" value="<?php echo $resultado[0]['estado']; ?>">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de pedido</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" readonly="" name="vidpedido" value="<?php echo $resultado[0]['id_pedido']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" readonly="" name="vfecha" value="<?php echo $resultado[0]['fechap']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php $usuario = consultas::get_datos("SELECT * FROM ref_usuario WHERE usu_cod=" . $resultado[0]['usu_cod']) ?>
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" name="vusuario" value="<?php echo $usuario[0]['usu_cod']; ?>">
                                                <input class="form-control" type="text" readonly="" name="vusuarionick" value="<?php echo $usuario[0]['usu_nick']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Observacion</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" readonly="" name="vobservacion" value="<?php echo $resultado[0]['observacion']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                    <button class="btn btn-success pull-right" type="submit"> Confirmar</button>
                                </div>
                            </form>
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
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });
    $(document).ready(function() {
        $('#barra').on('shown.bs.modal', function() {
            $('#barra').focus();
        });
    })
    $(document).ready(function() {
        $('#registrar_marca').on('shown.bs.modal', function() {
            $('#vmardescri').focus();
        });
    })

    $('#cerrar_marca').click(function() {
        $('#vidmarca , #vmardescri').val("");
    });
    $(document).ready(function() {
        $('#registrar_tipoprod').on('shown.bs.modal', function() {
            $('#vtiprodescri').focus();
        });
    })

    $('#cerrar_tp').click(function() {
        $(' #vidtipro ,#vtiprodescri').val("");
    });
    $(document).ready(function() {
        $('#registrar_unidad').on('shown.bs.modal', function() {
            $('#vumdescri').focus();
        });
    })

    $('#cerrar_unidad').click(function() {
        $(' #vidum ,#vumdescri').val("");
    });

    $(document).ready(function() {
        $('#registrar_impuesto').on('shown.bs.modal', function() {
            $('#vimpdescri').focus();
        });
    })

    $('#cerrar_impuesto').click(function() {
        $('#vidimp , #vimpdescri').val("");
    });
    //        
    //        $('#cerrar_unidad').click(function () {
    //            $(' #vidum ,#vumdescri').val("");
    //        });
</script>

</html>