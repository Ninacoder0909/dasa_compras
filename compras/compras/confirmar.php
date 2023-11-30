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
                                    <h3 class="box-title"> Confirmar compras</h3>
                                    <div class="box-tools">
                                        <a href="compras_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <form action="compras_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra =" . $_GET['vidcompra']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="2"> 
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de compra</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" readonly="" name="vidcompra" value="<?php echo $resultado[0]['id_compra']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="date" readonly="" name="vfecha" value="<?php echo $resultado[0]['fechac']; ?>" >
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                 <?php $usuario = consultas::get_datos("SELECT * FROM ref_proveedor WHERE prv_cod=".$resultado[0]['prv_cod'])?>
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input type="hidden" name="vidproveedor" value="<?php echo $usuario[0]['prv_cod']; ?>"> 
                                                    <input class="form-control" type="text" readonly="" name="vproveedor" value="<?php echo $usuario[0]['prv_razon_social']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. Factura</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" readonly="" name="vnrofactura" value="<?php echo $resultado[0]['nro_factura']; ?>" >
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
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        $(document).ready(function () {
            $('#barra').on('shown.bs.modal', function () {
                $('#barra').focus();
            });
        })
        $(document).ready(function () {
            $('#registrar_marca').on('shown.bs.modal', function () {
                $('#vmardescri').focus();
            });
        })

        $('#cerrar_marca').click(function () {
            $('#vidmarca , #vmardescri').val("");
        });
        $(document).ready(function () {
            $('#registrar_tipoprod').on('shown.bs.modal', function () {
                $('#vtiprodescri').focus();
            });
        })

        $('#cerrar_tp').click(function () {
            $(' #vidtipro ,#vtiprodescri').val("");
        });
        $(document).ready(function () {
            $('#registrar_unidad').on('shown.bs.modal', function () {
                $('#vumdescri').focus();
            });
        })

        $('#cerrar_unidad').click(function () {
            $(' #vidum ,#vumdescri').val("");
        });

        $(document).ready(function () {
            $('#registrar_impuesto').on('shown.bs.modal', function () {
                $('#vimpdescri').focus();
            });
        })

        $('#cerrar_impuesto').click(function () {
            $('#vidimp , #vimpdescri').val("");
        });
//        
//        $('#cerrar_unidad').click(function () {
//            $(' #vidum ,#vumdescri').val("");
//        });
    </script>
</html>