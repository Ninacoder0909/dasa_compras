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
    function soloNUM(e) {
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
</script>

<BODY class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title">Agregar nuevo ajuste</h3>
                                <div class="box-tools">
                                    <a href="ajustes_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="ajustes_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                        <input type="hidden" name="voperacion" value="1">
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>" style="width: 300px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                            <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-success pull-right" type="submit">Agregar</button>
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