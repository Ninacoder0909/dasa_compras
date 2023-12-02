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
        <div class="content-wrapper" style="background-color: rgb(241,231,254)">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-edit"></i>
                                <h3 class="box-title">Borrar Proveedor</h3>
                                <div class="box-tools">
                                    <a href="proveedor_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="proveedor_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM ref_proveedor WHERE prv_cod =" . $_GET['vid_proveedor']); ?>
                                    <?php $vistas = consultas::get_datos("SELECT * FROM v_ref_proveedor WHERE prv_cod =" . $_GET['vid_proveedor']); ?>
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="3">
                                        <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['prv_cod']; ?>" />
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">proveedor</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" disabled="" name="vrsocial" required="" autofocus="" value="<?php echo $resultado[0]['prv_razon_social']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Ciudad</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <div class="input-group">
                                                    <select class="form-control select3" disabled="" name="vidciudad" required="" style="width: 150px;">
                                                        <!--<option value="?php echo $resultado[0]['mar_cod']; ?>">?php echo $vistas[0]['mar_descri']; ?></option>-->
                                                        <?php
                                                        if (!empty($vistas)) {
                                                            foreach ($vistas as $vista) {
                                                        ?>
                                                                <option value="<?php echo $resultado[0]['id_ciudad']; ?>"><?php echo $vista['ciu_descri']; ?></option>
                                                                <?php $paisss = consultas::get_datos("SELECT * FROM ref_ciudad where id_ciudad !=" . $resultado[0]['id_ciudad']); ?>
                                                                <?php
                                                                if (!empty($paisss)) {
                                                                    foreach ($paisss as $m) {
                                                                ?>
                                                                        <option value="<?php echo $m['id_ciudad']; ?>"><?php echo $m['ciu_descri']; ?></option>
                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <option value="0">Debe selecionar al menos una ciudad</option>
                                                                <?php }
                                                                ?>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <option value="0">Debe selecionar al menos una ciudad</option>

                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--ciudad -->
                                        <!--ruc -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">RUC</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vruc" required="" disabled="" autofocus="" value="<?php echo $resultado[0]['prv_ruc']; ?>">
                                            </div>
                                        </div>
                                        <!--Direccion -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Direccion</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vdirec" required="" disabled="" autofocus="" value="<?php echo $resultado[0]['prv_direccion']; ?>">
                                            </div>
                                        </div>
                                        <!--tel -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-sm-2 col-xs-2">Telefono</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vtel" required="" disabled="" autofocus="" value="<?php echo $resultado[0]['prv_tel']; ?>">
                                            </div>
                                        </div>
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
<!<!-- NINA -->

</html>