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
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: rgb(241,231,254)">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Borrar Productos</h3>
                                    <div class="box-tools">
                                        <a href="productos_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="productos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod =" . $_GET['vid_productos']); ?>
                                        <?php $vistas = consultas::get_datos("SELECT * FROM v_ref_producto WHERE pro_cod =" . $_GET['vid_productos']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="3">
                                            <input type="hidden" name="vidproducto" value="<?php echo $resultado[0]['pro_cod']; ?>"/>
                                            <!--CODIGO DE BARRAS -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Codigo de barras</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" name="vcodigob" required="" disabled="" value="<?php echo $resultado[0]['codigo_barra']; ?>">
                                                </div>
                                            </div>
                                             <!--CODIGO DE BARRAS -->
                                              <!--MARCA -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Marcas</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <select class="form-control select3"  name="vidmarca" required="" disabled="" style="width: 150px;">
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
                                                        <select class="form-control select3"  name="vidtipro" disabled="" required="" style="width: 150px;">
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
                                                        <select class="form-control select3" disabled=""  name="vidum" required="" style="width: 150px;">
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
                                                        <select class="form-control select3" disabled="" name="vidimp" required="" style="width: 150px;">
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
                                                    <input class="form-control" type="text" name="vdescripcion" disabled="" required="" value="<?php echo $resultado[0]['pro_descri']; ?>" >
                                                </div>
                                            </div>
                                              <!--Descripcion -->
                                              <!--Codigo Precio compra-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio compra</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" name="vprecioc" disabled="" required="" min="0" value="<?php echo $resultado[0]['precio_costo']; ?>" >
                                                </div>
                                            </div>
                                            <!--Fin Codigo Precio compra-->
                                             <!--Codigo Precio venta-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio venta</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" name="vpreciov" disabled="" required="" min="0" value="<?php echo $resultado[0]['precio_venta']; ?>">
                                                </div>
                                            </div>
                                            <!--Fin Codigo Precio venta-->
                                             <!--Codigo imagen-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Imagen</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="file" name="vimagen" disabled="" required="" min="0" placeholder="Seleccionne una imagen" value="<?php echo $resultado[0]['pro_imagen']; ?>">
                                                </div>
                                            </div>
                                            <!--Fin Codigo imagen-->
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger pull-right" type="submit">Borrar</button>
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
</html>


