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
                                    <h3 class="box-title">Modificar Sucursal</h3>
                                    <div class="box-tools">
                                        <a href="sucursal_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="sucursal_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM ref_sucursal WHERE id_sucursal =" . $_GET['vid_sucursal']); ?>
                                        <?php $vistas = consultas::get_datos("SELECT * FROM v_ref_sucusal WHERE id_sucursal =" . $_GET['vid_sucursal']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="2">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_sucursal']; ?>"/>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >sucursal</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" name="vsucdescri" onkeypress="return letraNum(event)" required="" autofocus="" value="<?php echo $resultado[0]['suc_descri']; ?>">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Ciudad</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <select class="form-control select3"  name="vidciudad" required="" style="width: 150px;">
                                                            <!--<option value="?php echo $resultado[0]['mar_cod']; ?>">?php echo $vistas[0]['mar_descri']; ?></option>-->
                                                            <?php
                                                            if (!empty($vistas)) {
                                                                foreach ($vistas as $vista) {
                                                                    ?>
                                                                    <option value="<?php echo $resultado[0]['id_ciudad']; ?>"><?php echo $vista['ciu_descri']; ?></option>
                                                                    <?php 
                                                                    $paisss = consultas::get_datos("SELECT * FROM ref_ciudad where id_ciudad !=" . $resultado[0]['id_ciudad']); ?>
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
                                              <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Telefono</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text"  onkeypress="return soloNum(event)" name="vsuctel" required="" autofocus="" value="<?php echo $resultado[0]['suc_telefono']; ?>">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Direccion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return letraNum(event)" name="vsucdirec" required="" autofocus="" value="<?php echo $resultado[0]['suc_direccion']; ?>">
                                                </div>
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
    <!<!-- NINA -->
</html>


