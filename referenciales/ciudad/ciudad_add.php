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
<script>
    function soloLetras(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
            especiales = [8, 46],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
</script>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: rgb(241,231,254)">
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
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title">Agregar Ciudad</h3>
                                <div class="box-tools">
                                    <a href="ciudad_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="ciudad_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="1">
                                <input type="hidden" name="vcodigo" value="0" />
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Ciudad</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" onkeypress="return soloLetras(event)" name="vciudescri" autofocus="" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-success pull-right" type="submit">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!--MODAL Pais-->
            <div class="modal fade" id="registrar_pais" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Registrar Pais</strong></h4>
                        </div>
                        <form action="ciudad_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            <input type="hidden" name="voperacion" value="4">
                            <input type="hidden" name="vidpais" value="0">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2">Descripcion</label>
                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                        <input type="text" class="form-control" autofocus="" onkeypress="return soloLetras(event)" name="vciudescri" required="" id="ciudescri" />
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_marca">Cerrar</button>
                                <button type="submit" class="btn btn-success pull-right">Registrar</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
            <!--MODAL MARCAS-->
        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</body>
<?php require '../../estilos/js_lte.ctp'; ?>

<script>
    $(document).ready(function() {
        $('#registrar_pais').on('shown.bs.modal', function() {
            $('#ciudescri').focus();
        });
    })

    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('#cerrar_marca').click(function() {
        $('#ciudescri , #vidpais').val("");
    });
</script>

</html>