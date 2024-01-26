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
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
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

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">

    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp' ?>
        <?php require '../../estilos/izquierda.ctp' ?>

        <div class="content-wrapper">
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
                        <div class="box box-primary" style="border-width: 20px; color: white">
                            <div class="box-header">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Agregar nuevo pedido</h3>
                                <div class="box-tools">
                                    <a href="pedidosc_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>

                                </div>

                            </div>
                            <form action="pedidosc_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vestado" value="ACTIVO">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de pedido</label>
                                            <?php $cp = consultas::get_datos("SELECT COALESCE(MAX(id_pedido),0)+1 AS ultimo FROM pedidos_de_compra;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vidpedido" readonly="" value="<?php echo $cp[0]['ultimo']; ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                <input type="hidden" name="vsucursal" value="<?php echo $_SESSION['id_sucursal']; ?>">
                                                <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: center;">
                                    <button class="btn btn-success pull-right" type="submit"> Registrar</button>
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