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
                                <h3 class="box-title">Modificar Cargo</h3>
                                <div class="box-tools">
                                    <a href="cargos_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="cargos_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM ref_cargos WHERE id_cargo =" . $_GET['vid_cargos']); ?>
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="2">
                                        <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_cargo']; ?>" />
                                        <label class="col-lg-2 control-label">Cargo</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" onkeypress="return soloLetras(event)" type="text" name="vnombre" autofocus="" required="" value="<?php echo $resultado[0]['car_descri']; ?>">
                                        </div>
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
<?php require '../../estilos/js_lte.ctp'; ?>

</html>