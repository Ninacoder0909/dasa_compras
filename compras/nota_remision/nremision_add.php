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
            letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
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

    function Letras(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "áéíóúabcdefghijklmnñopqrstuvwxyz",
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


    function LetraNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789-",
            especiales = [8],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }


    }

    function SoloNum(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "0123456789-",
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
                        <div class="box box_primary" style="background-color: white">
                            <div class="box-header" style="background-color: #ABD3D1 ">
                                <i class="ion ion-plus"></i>
                                <h3 class="box-title"> Agregar Nota de remision</h3>
                                <div class="box-tools">
                                    <a href="nremision_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>

                                </div>
                            </div>
                            <form action="nremision_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vestado" value="ACTIVO">
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Codigo de Remision</label>
                                            <?php $cp = consultas::get_datos("SELECT COALESCE(MAX(id_remision),0)+1 AS ultimo FROM remision;") ?>
                                            <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                <input class="form-control" type="text" name="vnremision" readonly="" value="<?php echo $cp[0]['ultimo']; ?>" required="">
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
                                                <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Orden de compra</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <?php $productos = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE estado = 'CONFIRMADO' OR estado = 'EN PROCESO'"); ?>
                                                <select class="form-control" required="" name="vidorden" id="pedido" onclick="obtenerord()" onchange="obtenerord()">
                                                    <option id="valor" value="">Debe seleccionar una Orden</option>
                                                    <?php
                                                    if (!empty($productos)) {
                                                        foreach ($productos as $m) {
                                                    ?>
                                                            <option value="<?php echo $m['id_ordenc']; ?>"><?php echo $m['id_ordenc']; ?><?php echo ' | '; ?><?php echo $m['fecha']; ?><?php echo ' | '; ?><?php echo $m['prv_razon_social']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Nro. de factura</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" placeholder=" FORMATO: 000-000-0000000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{7}" title="Debe coincidir con el formato xxx-xxx-xxxxxxx" onkeypress="return SoloNum(event)" name="vnrofactura" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" maxlength="8" minlength="8" placeholder="INSERTE 8 DIGITOS" onkeypress="return SoloNum(event)" name="vnrotimp" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez timbrado</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="date" onkeypress="return SoloNum(event)" name="vetimp" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Conductor</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" name="vconductor">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cedula</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" onkeypress="return SoloNum(event)" type="text" name="vcedula">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Chapa</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" onkeypress="return soloLetras(event)" name="vchapa">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Modelo</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" type="text" onkeypress="return soloLetras(event) " name="vmodelo">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Color</label>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <input class="form-control" onkeypress="return Letras(event)" type="text" name="vcolor">
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <div class="box-header" style="text-align: center;">
                                                </div>
                                                <div id="pedid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                    <button class="btn btn-success pull-right" id="btn" type="submit"> Registrar</button>
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
<script>
    /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    function obtenerord() {
        var dat = $('#pedido').val().split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/nota_remision/listar_orden.php?vidorden=" + dat[0],
            cache: false,
            beforeSend: function() {},
            success: function(msg) {
                $('#pedid').html(msg);


            }
        });
    }
</script>


</html>