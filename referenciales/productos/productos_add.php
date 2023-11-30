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
        function barra(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " 0123456789",
                    especiales = [],
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
        function impuesto(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
                    especiales = [8, 46,37],
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
        function unidad(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789^",
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
                                    <h3 class="box-title"> Agregar Producto</h3>
                                    <div class="box-tools">
                                        <a href="productos_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <form action="productos_control.php" method="POST" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input type="hidden" name="vidproducto" value="0">
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cod. de barra</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return barra(event)" name="vcodigob" required="" autofocus="">
                                                </div>
                                            </div>
                                            <!--marca-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Marcas</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_marca ORDER BY mar_cod"); ?>
                                                        <select class="form-control select3" name="vidmarca" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($marcas)) {
                                                                foreach ($marcas as $m) {
                                                                    ?>
                                                                    <option value="<?php echo $m['mar_cod']; ?>"><?php echo $m['mar_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>

                                                                <option value="0">Debe selecionar al menos una marca</option>

                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-goup-btn">
                                                            <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_marca">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--marca-->
                                            <!--tipo de producto-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Tipo de producto</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipro"); ?>
                                                        <select class="form-control select3" name="vidtipro" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($tipoprod)) {
                                                                foreach ($tipoprod as $tp) {
                                                                    ?>
                                                                    <option value="<?php echo $tp['id_tipro']; ?>"><?php echo $tp['tipro_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>

                                                                <option value="0">Debe selecionar al menos un tipo de producto</option>

                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-goup-btn">
                                                            <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_tipoprod">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--fin tipo de producto-->
                                            <!--unidad de medida-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Unidad de medida</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $unidad = consultas::get_datos("SELECT * FROM ref_unidadmedida ORDER BY id_um"); ?>
                                                        <select class="form-control select3" name="vidum"  required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($unidad)) {
                                                                foreach ($unidad as $u) {
                                                                    ?>
                                                                    <option value="<?php echo $u['id_um']; ?>"><?php echo $u['descripcion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>

                                                                <option value="0">Debe selecionar al menos una unidad de medida</option>

                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-goup-btn">
                                                            <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_unidad">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--fin unidad de medida-->
                                            <!--impuesto-->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Impuesto</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $impuesto = consultas::get_datos("SELECT * FROM ref_tipo_impuesto ORDER BY id_timp"); ?>
                                                        <select class="form-control select3" name="vidimp" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($impuesto)) {
                                                                foreach ($impuesto as $i) {
                                                                    ?>
                                                                    <option value="<?php echo $i['id_timp']; ?>"><?php echo $i['descripcion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>

                                                                <option value="0">Debe selecionar al menos un tipo de impuesto</option>

                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-goup-btn">
                                                            <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_impuesto">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--fin impuesto-->
                                            <!--Codigo de descripcion-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Descripcion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return letraNum(event)" name="vdescripcion" required="">
                                                </div>
                                            </div>
                                            <!--Fin Codigo de descripcion-->
                                            <!--Codigo Precio compra-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio compra</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" onkeypress="return barra(event)" name="vprecioc" required="" min="0">
                                                </div>
                                            </div>
                                            <!--Fin Codigo Precio compra-->
                                            <!--Codigo Precio venta-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio venta</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" onkeypress="return barra(event)" name="vpreciov" required="" min="0">
                                                </div>
                                            </div>
                                            <!--Fin Codigo Precio venta-->
                                            <!--Codigo imagen-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Imagen</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="file" name="vimagen" required="" min="0" placeholder="Seleccionne una imagen">
                                                </div>
                                            </div>
                                            <!--Fin Codigo imagen-->
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
                <!--MODAL MARCAS-->
                <div class="modal fade" id="registrar_marca" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Marca</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="4">
                                <input type="hidden" name="vidmarca" value="0" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control"  onkeypress="return letraNum(event)" name="vdescripcion" required="" id="vmardescri">
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
                <!--MODAL TI PRO-->
                <div class="modal fade" id="registrar_tipoprod" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Tipo de producto</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="5">
                                <input type="hidden" name="vidtipro" value="0" id="vidtipro">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" onkeypress="return soloLetras(event)" name="vdescripcion" required="" id="vtiprodescri">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_tp">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL TI PRO-->
                <!--MODAL UNIDAD-->
                <div class="modal fade" id="registrar_unidad" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Unidad de medida</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="6">
                                <input type="hidden" name="vidum" value="0" id="vidum">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" onkeypress="return unidad(event)" name="vdescripcion" required="" id="vumdescri">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_unidad">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL UNIDAD-->
                <!--MODAL IMPUESTO-->
                <div class="modal fade" id="registrar_impuesto" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Tipo impuesto</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="7">
                                <input type="hidden" name="vidimp" value="0" id="vidimp">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" onkeypress="return impuesto(event)" name="vdescripcion" required="" id="vimpdescri">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">porcentaje</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" onkeypress="return barra(event)" name="vidproducto" required="" id="vimpdescri">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_impuesto">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL IMPUESTO-->
                <!--MODAL COSTO-->
                <div class="modal fade" id="registrar_costo" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Precio de costo</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="8">
                                <input type="hidden" name="vidcosto" value="0" id="vidcosto">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="number" class="form-control" onkeypress="return soloNum(event)" name="vcostodescri" required="" id="vcostodescri" min="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_costo">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL COSTO-->
                <!--MODAL VENTA-->
                <div class="modal fade" id="registrar_venta" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Precio de venta</strong></h4>
                            </div>
                            <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="9">
                                <input type="hidden" name="vidventa" value="0" id="vidventa">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" onkeypress="return soloNum(event)" name="vventasdescri" required="" id="vventasdescri">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_venta">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL VENTA-->
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