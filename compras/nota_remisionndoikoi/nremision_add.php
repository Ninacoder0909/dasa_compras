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

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../estilos/cabecera.ctp' ?>
            <?php require '../../estilos/izquierda.ctp' ?>

            <div class="content-wrapper" style="background-color: rgb(241,231,254);">
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
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title"> Registrar Nota de Remision</h3>
                                    <div class="box-tools">
                                        <a href="nremision_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <form action="nremision_control.php" method="POST" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Cod. Nota Remision</label>
                                                <?php $compras = consultas::get_datos("SELECT COALESCE(MAX(id_remision),0)+1 AS ultimo FROM nota_remision;") ?>
                                                <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                    <input class="form-control" type="text" name="vnremision" readonly="" value="<?php echo $compras[0]['ultimo']; ?>" required="">
                                                    <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                    <input type="hidden" name="vsucsalida" value="<?php echo $_SESSION['id_sucursal']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php date_default_timezone_set('America/Asuncion'); ?>
                                                    <input class="form-control" type="hidden" readonly="" name="fechainicio"  value="<?php echo date("Y-m-d h:i"); ?>">
                                                    <input class="form-control" type="date" readonly="" name="vfechitap"  value="<?php echo date("Y-m-d"); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Timbrado</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" maxlength="8"  minlength="8" placeholder="INSERTE 8 DIGITOS" onkeypress="return SoloNum(event)" type="text" required="" name="vtimbrado">
                                                </div>
                                            </div>
                                            <div class="form-group"  >
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Seleccionar Chofer</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM v_ref_empleado Where id_cargo = 5 ORDER BY id_empleado"); ?>
                                                    <select class="form-control"  name="vidchofer" required="" >
                                                        <option value="">Debe seleccionar un chofer</option>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option  value="<?php echo $m['id_empleado']; ?>"><?php echo $m['per_nro_doc']; ?><?php echo ' - '; ?><?php echo $m['nomb']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un chofer</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group" >
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Vehiculo</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_vehiculo "); ?>
                                                    <select class="form-control"  name="auto" required="" >
                                                        <option value="">Debe seleccionar un Vehiculo</option>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option  value="<?php echo $m['id_vehiculo']; ?>"><?php echo $m['nro_chasis']; ?><?php echo ' - '; ?><?php echo $m['descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un vehiculo</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group" >
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Sucursal de Destino</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_sucursal WHERE id_sucursal !=".$_SESSION['id_sucursal']); ?>
                                                    <select class="form-control"  name="vsucentrada" required="" >
                                                        <option value="">Debe seleccionar una Sucursal</option>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option  value="<?php echo $m['id_sucursal']; ?>"><?php echo $m['suc_descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos una sucursal</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Motivo de translado</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" required="" onkeypress="return SoloLetras(event)" type="text" name="vmotivo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                        <button class="btn btn-success" type="submit"> Registrar</button>
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
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        
        function SoloNum(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "0123456789",
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
        function SoloLetras(e) {
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

    </script>

</html>