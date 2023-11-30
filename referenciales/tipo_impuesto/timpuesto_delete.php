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
                                    <h3 class="box-title">Borrar Tipo de Impuesto</h3>
                                    <div class="box-tools">
                                        <a href="timpuesto_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="timpuesto_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado= consultas::get_datos("SELECT * FROM ref_tipo_impuesto WHERE id_timp =" . $_GET['vid_impuesto']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="3">
                                            <input type="hidden" name="vdescri" value="VACIO">
                                            <input type="hidden" name="vporcen" value="0">
                                            <input type="hidden" name="vidtimpuesto" value="<?php echo $resultado[0]['id_timp']; ?>"/>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Descripcion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" name="vdescri" disabled=""  value="<?php echo $resultado[0]['descripcion']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Porcentaje</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="number" name="vporcen" disabled=""   value="<?php echo $resultado[0]['porcentaje']; ?>" >
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
</html>


