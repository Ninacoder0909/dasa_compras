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
                                    <i class="ion ion-trash-b"></i>
                                    <h3 class="box-title">Borrar Pais</h3>
                                    <div class="box-tools">
                                        <a href="pais_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="pais_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado= consultas::get_datos("SELECT * FROM ref_pais WHERE id_pais =" . $_GET['vid_pais']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="3">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_pais']; ?>"/>
                                            <label class="col-lg-2 control-label">Pais</label>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" name="vnombre" required="" value="<?php echo $resultado[0]['pai_descri']; ?>" disabled="">
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

