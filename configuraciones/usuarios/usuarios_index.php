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
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Listado de Usuarios</h3>
                                    <div class="box-tools">
                                        <button class="btn btn-primary pull-right btn-sm" style="padding: 8px; margin: 1px" title="Registrar" type="button" data-toggle="modal" data-target="#registrar_usuario">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <!--BUSCADOR-->
                                        <form action="usuarios_index.php" method="POST" accept-charset="UTF-8" class="form-inline" >
                                            <div  style="float: right; width: 52%;display: block;">
                                                <div class="form-group-sm" >
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form ">
                                                                <input type="text" class="form-control" name="buscar" placeholder="Cod/user..." style="margin: 0.2px">
                                                                <span class="glyphicon glyphicon-search form-control-feedback" ></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--  BUSCADOR--> 
                                    </div>
                                </div>
                                <div class="box-body no-padding" >
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $valor = '';
                                            if (isset($_REQUEST['buscar'])) {
                                                $valor = $_REQUEST['buscar'];
                                            }
                                            $usuarios = consultas::get_datos("SELECT * FROM v_ref_usuario WHERE (usu_cod||TRIM(UPPER(usu_nick))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY usu_cod");
                                            if (!empty($usuarios)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class=" table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Empleado</th>
                                                                <th class="text-center">Usuario</th>
                                                                <th class="text-center">Cargo</th>
                                                                <th class="text-center">Imagen</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($usuarios AS $p) { ?>
                                                                <tr>
                                                                    <td data-title="sucur" class="text-center"> <?php echo $p['usu_cod'] ?></td>
                                                                    <td data-title="telefono" class="text-center"> <?php echo $p['persona'] ?></td>
                                                                    <td data-title="direc" class="text-center"> <?php echo $p['usu_nick'] ?></td>
                                                                    <td data-title="direc" class="text-center"> <?php echo $p['car_descri'] ?></td>
                                                                    <td data-title="direc" class="text-center"><img height="45px" src="/dasa_compras/img/personas/<?php echo $p['usu_foto']; ?>"/></td>
                                                                    <td data-title="direc" class="text-center"> <?php echo $p['usu_estado'] ?></td>
                                                                    <td data-title="Acciones"class="text-center">

                                                                        <a href="/dasa_compras/configuraciones/permisos/permisos_index.php?vgrup=<?php echo $p['gru_cod'] . '&vgrunombre=' . $p['gru_nombre']; ?>" 
                                                                           class="btn btn-toolbar btn-lg" rel="tooltip" title="Permisos">
                                                                            <span class="glyphicon glyphicon-plus"></span>
                                                                        </a>
                                                                        <a onclick="borrar(<?php echo "'" . $p['usu_cod'] . "'"; ?>)"
                                                                           class="btn btn-toolbar btn-lg" role="button" data-title="Anular Usuario" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                            <span class="glyphicon glyphicon-ban-circle"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            <?php } else { ?>
                                                <div class="alert alert-danger flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han encontrado registros...
                                                </div>

                                            <?php } ?>

                                        </div>

                                    </div>

                                </div> 
                            </div> 
                        </div>
                    </div>

                </div>
                <!--MODAL Registrar-->
                <div class="modal fade" id="registrar_usuario" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title"><strong>Registrar Usuario</strong></h4>
                            </div>
                            <form action="usuarios_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="1">
                                <input type="hidden" name="vcodigo" value="0" id="vidimp">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Empleado</label>
                                        <div class="col-lg-5 col-sm-4 col-xs-4">
                                            <!--                                                    <div class="input-group">-->
                                            <?php $marcas = consultas::get_datos("SELECT * FROM v_ref_empleado where id_empleado NOT IN (select id_empleado from ref_usuario) ORDER BY id_empleado"); ?>
                                            <select class="form-control" name="vidempleado" required="" >
                                                <option value=""></option>
                                                <?php
                                                if (!empty($marcas)) {
                                                    foreach ($marcas as $m) {
                                                        ?>
                                                        <option value="<?php echo $m['id_empleado']; ?>"><?php echo $m['nomb']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Grupos</label>
                                        <div class="col-lg-5 col-sm-4 col-xs-4">
                                            <!--                                                    <div class="input-group">-->
                                            <?php $grupo = consultas::get_datos("SELECT * FROM ref_grupos ORDER BY gru_cod"); ?>
                                            <select class="form-control" name="vgrucod" required="" >
                                                <?php
                                                if (!empty($grupo)) {
                                                    foreach ($grupo as $m) {
                                                        ?>
                                                        <option value="<?php echo $m['gru_cod']; ?>"><?php echo $m['gru_nombre']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Sucursal</label>
                                        <div class="col-lg-5 col-sm-4 col-xs-4">
                                            <!--                                                    <div class="input-group">-->
                                            <?php $sucur = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal"); ?>
                                            <select class="form-control" name="vidsucursal" required="" >
                                                <?php
                                                if (!empty($sucur)) {
                                                    foreach ($sucur as $m) {
                                                        ?>
                                                        <option value="<?php echo $m['id_sucursal']; ?>"><?php echo $m['suc_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                        <div class="col-lg-5 col-sm-4 col-xs-4">
                                            <input class="form-control" type="text" name="vusunick"  onkeypress="return soloLetras(event)" required="" autofocus="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Contraseña</label>
                                        <div class="col-lg-5 col-sm-4 col-xs-4">
                                            <input type="password" name="vusuclaves" class="form-control" onkeypress="return contraseña(event)"  required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Imagen</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control" type="file" name="vusufoto" required="" min="0" placeholder="Seleccionne una imagen">
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_impuesto">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--MODAL IMPUESTO-->
                 <!-- MODAL DE BORRAR -->
            <div class="modal fade" id="borrar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
                            <h4 class="modal-title custom_align" id="Heading">Atencion!!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" id="confirmacion"></div>
                        </div>
                        <div class="modal-footer">
                            <a id="si" role="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok-sign"></span>Si
                            </a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span>No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DE MODAL BORRAR -->
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        //PARA QUE EL FOCO SE VAYA EN EL INPUT
        $(".modal").on('shown.bs.modal', function () {
            $(this).find('input:text:visible:first').focus();
        });
        
        function borrar(datos) {
            var dat = datos.split("_"); //ayuda a quitar el guion
            $('#si').attr('href', 'usuarios_control.php?vcodigo=' + dat[0] + ' &voperacion=2');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>Desea Borrar el registro <i><strong>' + dat[0] + '</strong></i>?');
        }
    </script>
     <script>
        function contraseña(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
                    especiales = [],
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
     <script>
        function soloLetras(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789_",
                    especiales = [],
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


