<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                            <div class="box box_primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title"> Modificar Cliente</h3>
                                    <div class="box-tools">
                                        <a href="cliente_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <form action="cliente_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_cliente WHERE id_cliente =" . $_GET['vid_cliente']); ?>

                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="2">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_cliente']; ?>">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Persona</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $person = consultas::get_datos("SELECT * FROM ref_persona where per_estado = 'ACTIVO' and id_persona !=" . $resultado[0]['id_persona']); ?>
                                                        <select class="form-control select3" name="vidpersona" required="" style="width: 320px;">  
                                                            <option value="<?php echo $resultado[0]['id_persona']; ?>"><?php echo $resultado[0]['per_nro_doc'] . ' - ' . $resultado[0]['per_nombre'] . ' ' . $resultado[0]['per_apellido']; ?></option>
                                                            <?php
                                                            if (!empty($person)) {
                                                                foreach ($person as $m) {
                                                                    ?>
                                                                    <option value="<?php echo $m['id_persona']; ?>"><?php echo $m['per_nro_doc'] . ' - ' . $m['per_nombre'] . ' ' . $m['per_apellido']; ?></option>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "box-footer">
                                        <button class = "btn btn-success pull-right" type = "submit"> Registrar</button>
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