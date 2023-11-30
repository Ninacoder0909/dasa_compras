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
        function barra(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " 0123456789",
                    especiales = [8],
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
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Modificar Productos</h3>
                                    <div class="box-tools">
                                        <a href="productos_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod =" . $_GET['vid_productos']); ?>
                                       <?php $vistas = consultas::get_datos("SELECT * FROM v_ref_producto WHERE pro_cod =" . $_GET['vid_productos']); ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="2">
                                            <input type="hidden" name="vidproducto" value="<?php echo $resultado[0]['pro_cod']; ?>"/>
                                            <!--CODIGO DE BARRAS -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Codigo de Barras</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return barra(event)" name="vcodigob" required="" autofocus="" value="<?php echo $resultado[0]['codigo_barra']; ?>">
                                                </div>
                                            </div>
                                             <!--CODIGO DE BARRAS -->
                                              <!--MARCA -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Marcas</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <select class="form-control select3"  name="vidmarca" required="" style="width: 150px;">
                                                            <!--<option value="?php echo $resultado[0]['mar_cod']; ?>">?php echo $vistas[0]['mar_descri']; ?></option>-->
                                                            <?php
                                                            if (!empty($vistas)) {
                                                                foreach ($vistas as $vista) {
                                                                    ?>
                                                                    <option value="<?php echo $resultado[0]['mar_cod']; ?>"><?php echo $vista['mar_descri']; ?></option>
                                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_marca where mar_cod !=" . $resultado[0]['mar_cod']); ?>
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
                                              <!--MARCA -->
                                              <!--TIPO DE PRODUCTO -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Tipo de producto</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <select class="form-control select3"  name="vidtipro" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($vistas)) {
                                                                foreach ($vistas as $vista) {
                                                                    ?>
                                                                    <option value="<?php echo $resultado[0]['id_tipro']; ?>"><?php echo $vista['tipro_descri']; ?></option>
                                                                    <?php $tipoprod = consultas::get_datos("SELECT * FROM ref_tipo_producto where id_tipro !=" . $resultado[0]['id_tipro']); ?>
                                                                    <?php
                                                                    if (!empty($tipoprod)) {
                                                                        foreach ($tipoprod as $t) {
                                                                            ?>
                                                                            <option value="<?php echo $t['id_tipro']; ?>"><?php echo $t['tipro_descri']; ?></option>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <option value="0">Debe selecionar al menos una marca</option>
                                                                    <?php }
                                                                    ?>                                                                    
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
                                              <!--TIPO DE PRODUCTO -->
                                              <!--UNIDAD DE MEDIDA -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Unidad de medida</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <select class="form-control select3"  name="vidum" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($vistas)) {
                                                                foreach ($vistas as $vista) {
                                                                    ?>
                                                                    <option value="<?php echo $resultado[0]['id_um']; ?>"><?php echo $vista['unidadmedida']; ?></option>
                                                                    <?php $unidad = consultas::get_datos("SELECT * FROM ref_unidadmedida where id_um !=" . $resultado[0]['id_um']); ?>
                                                                    <?php
                                                                    if (!empty($unidad)) {
                                                                        foreach ($unidad as $u) {
                                                                            ?>
                                                                            <option value="<?php echo $u['id_um']; ?>"><?php echo $u['descripcion']; ?></option>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <option value="0">Debe selecionar al menos una marca</option>
                                                                    <?php }
                                                                    ?>                                                                    
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
                                              <!--UNIDAD DE MEDIDA -->
                                              <!--IMPUESTO -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Impuesto </label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <select class="form-control select3"  name="vidimp" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($vistas)) {
                                                                foreach ($vistas as $vista) {
                                                                    ?>
                                                                    <option value="<?php echo $resultado[0]['id_timp']; ?>"><?php echo $vista['impuesto']; ?></option>
                                                                    <?php $impuesto = consultas::get_datos("SELECT * FROM ref_tipo_impuesto where id_timp !=" . $resultado[0]['id_timp']); ?>
                                                                    <?php
                                                                    if (!empty($impuesto)) {
                                                                        foreach ($impuesto as $u) {
                                                                            ?>
                                                                            <option value="<?php echo $u['id_timp']; ?>"><?php echo $u['descripcion']; ?></option>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <option value="0">Debe selecionar al menos una marca</option>
                                                                    <?php }
                                                                    ?>                                                                    
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
                                              <!--IMPUESTO -->
                                              <!--DESCRIPCION -->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Descripcion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return letraNum(event)" name="vdescripcion" required="" value="<?php echo $resultado[0]['pro_descri']; ?>" >
                                                </div>
                                            </div>
                                              <!--Descripcion -->
                                              <!--Codigo Precio compra-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio compra</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" onkeypress="return barra(event)" name="vprecioc" required="" min="0" value="<?php echo $resultado[0]['precio_costo']; ?>" >
                                                </div>
                                            </div>
                                            <!--Fin Codigo Precio compra-->
                                             <!--Codigo Precio venta-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio venta</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" onkeypress="return barra(event)" name="vpreciov" required="" min="0" value="<?php echo $resultado[0]['precio_venta']; ?>">
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
                                        <button class="btn btn-success pull-right" type="submit">Modificar</button>
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
    <?php require '../../estilos/js_lte.ctp'; ?>
</html>


