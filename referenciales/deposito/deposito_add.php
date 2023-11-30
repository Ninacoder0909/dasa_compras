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
    <script>
        function soloLetras(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz",
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
        function letraNum(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
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
        function soloNum(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "  -0123456789",
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
                                    <h3 class="box-title"> Agregar Deposito</h3>
                                    <div class="box-tools">
                                        <a href="deposito_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <!-- PERSONA -->
                                <form action="deposito_control.php" method="POST" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input type="hidden" name="vidcodigo" value="0">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Nombre deposito</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input type="text" class="form-control"  onkeypress="return letraNum(event)" autofocus="" name="vdepdescri" required="" id="vmardescri">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                  <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Sucursal</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">

                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_sucursal order by id_sucursal"); ?>
                                                    <select class="form-control select3" name="vidsucursal" required="" style="size: 120px">  
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_sucursal']; ?>"><?php echo $m['suc_descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una sucursal</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                                <span class="input-goup-btn">
                                                    <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_sucursal">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success pull-right" type="submit"> Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--MODAL SUCURSAL-->
                <div class="modal fade" id="registrar_sucursal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Sucursal</strong></h4>
                            </div>
                            <form action="deposito_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="4">
                                <input type="hidden" name="vidsucursal" value="0" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Ciudad</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <div class="input-group">
                                                <?php $paiss = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                                <select class="form-control select3" name="vidcodigo" required="" style="width: 150px;">
                                                    <?php
                                                    if (!empty($paiss)) {
                                                        foreach ($paiss as $m) {
                                                            ?>
                                                            <option value="<?php echo $m['id_ciudad']; ?>"><?php echo $m['ciu_descri']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <option value="0">Debe selecionar al menos una marca</option>

                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Descripcion</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input type="text" class="form-control"  onkeypress="return letraNum(event)" name="vdepdescri" required="" id="vmardescri">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Telefono</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input type="text" class="form-control" onkeypress="return soloNum(event)"   name="vsuctelefono" required="" id="vmardescri">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Direccion</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input type="text" class="form-control" onkeypress="return letraNum(event)" name="vsucdireccion" required="" id="vmardescri">
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
                <!--MODAL SUCURSAL-->
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