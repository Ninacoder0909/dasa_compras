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

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">

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
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title">Agregar proveedor</h3>
                                <div class="box-tools">
                                    <a href="proveedor_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="proveedor_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="1">
                                <input type="hidden" name="vcodigo" value="0" />
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">proveedor</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" onkeypress="return soloLetras(event)" name="vrsocial" required="" autofocus="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Ciudad</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <div class="input-group">
                                                <?php $paiss = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                                <select class="form-control select3" name="vidciudad" required="" style="width: 150px;">
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
                                                <!-- <span class="input-goup-btn">
                                                    <button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#registrar_ciudad">
                                                        <i class="fa fa-plus"></i>
                                                    </button>

                                                </span> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--fin ciudad-->
                                    <!--ruc-->
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">RUC</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" placeholder=" FORMATO: 0000000-0" pattern="[0-9]{7}-[0-9]{1}" onkeypress="return soloNum(event)" name="vruc" required="" autofocus="">
                                        </div>
                                    </div>
                                    <!--ruc-->
                                    <!--direccion-->
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Direccion</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" onkeypress="return letraNum(event)" name="vdirec" required="" autofocus="">
                                        </div>
                                    </div>
                                    <!--direccion-->
                                    <!--telefono-->
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2">Telefono</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" onkeypress="return soloNum(event)" name="vtel" required="" autofocus="">
                                        </div>
                                    </div>
                                    <!--telefono-->
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-success pull-right" type="submit">Registrar</button>
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