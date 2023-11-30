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
        function soloNum(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "-0123456789",
                    especiales = [" "],
                    tecla_especial = false;

            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = false;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
        function cedula(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789",
                    especiales = [" "],
                    tecla_especial = false;

            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = false;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
        function fnac(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " /0123456789-",
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
        function cor(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789_@",
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
                            <div class="box box_primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title"> Agregar Persona</h3>
                                    <div class="box-tools">
                                        <a href="persona_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>

                                    </div>

                                </div>
                                <form action="persona_control.php" method="POST" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion" value="1">
                                            <input type="hidden" name="vidcodigo" value="0">

                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Nombre</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  onkeypress="return soloLetras(event)" autofocus="" name="vpernombre" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Apellido</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  onkeypress="return soloLetras(event)"  type="text" name="vperapellido">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Cedula</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control"  onkeypress="return cedula(event)"  type="text" name="vpernrodoc">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2">RUC</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return soloNum(event);" placeholder=" FORMATO: 0000000-0" pattern="[0-9]{7}-[0-9]{1}"  name="vperruc">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Ciudad</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                                        <select class="form-control select3" name="vidciudad" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($marcas)) {
                                                                foreach ($marcas as $m) {
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
                                                        <span class="input-goup-btn">
                                                            <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_ciudad">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Tipo de persona</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <div class="input-group">
                                                        <?php $impuesto = consultas::get_datos("SELECT * FROM ref_tipo_persona ORDER BY id_tipper"); ?>
                                                        <select class="form-control select3" name="vtipopercod" required="" style="width: 150px;">
                                                            <?php
                                                            if (!empty($impuesto)) {
                                                                foreach ($impuesto as $i) {
                                                                    ?>
                                                                    <option value="<?php echo $i['id_tipper']; ?>"><?php echo $i['tp_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>

                                                                <option value="0">Debe selecionar al menos un tipo de persona</option>

                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <span class="input-goup-btn">
                                                            <button class="btn btn-primary btn-flat"  type="button" data-toggle="modal" data-target="#registrar_tpersona">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Direccion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return letraNum(event)" name="vperdireccion" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Telefono</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return soloNum(event)"  name="vpertelefono" required="" min="0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Email</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" id="email" onkeypress="return cor(event)" placeholder="Ingrese su correo" name="vperemail" required="" min="0">
                                                    <small id="emailOK" class="form-text text-muted"  style="font-weight: bold">
                                                        Nunca compartiremos su correo con nadie
                                                    </small>
                                                </div>
                                            </div>
                                            <div class = "form-group">
                                                <label class = "control-label  col-lg-3 col-sm-2 col-xs-2">Sexo</label>
                                                <div class = "col-lg-4 col-sm-4 col-xs-4">
                                                    <select class="form-control select3" name="vpersexo" onkeypress="return soloLetras(event)"  required="" style="width: 150px;">
                                                        <option value="FEMENINO">FEMENINO</option>
                                                        <option value="MASCULINO">MASCULINO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fec. Nac.</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="date" onkeypress="return fnac(event)"  name="vperfechanacimiento" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Razon social</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" onkeypress="return soloLetras(event)" name="vrazonsocial" required="" min="0">
                                                </div>
                                            </div>
                                            <!--Codigo imagen-->
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Imagen</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="file" name="vperimagen" required="" min="0" placeholder="Seleccionne una imagen">
                                                </div>
                                            </div>
                                            <!--Fin Codigo imagen-->

                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success pull-right" type="submit"> Registrar</button>

                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>
                </div>
                <!--MODAL Ciudad-->
                <div class="modal fade" id="registrar_ciudad" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Ciudad</strong></h4>
                            </div>
                            <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="4">
                                <input type="hidden" name="vidciudad" value="0" id="vidmarca">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Descripcion</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input type="text" class="form-control" name="vpernombre" onkeypress="return soloLetras(event)" autofocus="" required="" id="vmardescri">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-sm-2 col-xs-2" >Pais</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <div class="input-group">
                                                <?php $marcas = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais"); ?>
                                                <select class="form-control select3" name="vidcodigo" required="" style="width: 150px;">
                                                    <?php
                                                    if (!empty($marcas)) {
                                                        foreach ($marcas as $m) {
                                                            ?>
                                                            <option value="<?php echo $m['id_pais']; ?>"><?php echo $m['pai_descri']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <option value="0">Debe selecionar al menos una marca</option>

                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_marca">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>

                <div class="modal fade" id="registrar_tpersona" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Registrar Tipo de persona</strong></h4>
                            </div>
                            <form action="persona_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input type="hidden" name="voperacion" value="5">
                                <input type="hidden" name="vtipopercod" value="0" id="vidpais">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2">Descripcion</label>
                                        <div class="col-xs-10 col-md-10 col-lg-10">
                                            <input type="text" class="form-control" onkeypress="return soloLetras(event)" name="vpernombre" autofocus="" required="" id="persona">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-danger" id="cerrar_persona">Cerrar</button>
                                    <button type="submit" class="btn btn-success pull-right">Registrar</button>
                                </div>

                            </form>
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
        $(document).ready(function () {
            $('#registrar_ciudad').on('shown.bs.modal', function () {
                $('#vmardescri').focus();
            });
        })

        $('#cerrar_marca').click(function () {
            $('#vidmarca , #vmardescri').val("");
        });

        $(document).ready(function () {
            $('#registrar_tpersona').on('shown.bs.modal', function () {
                $('#persona').focus();
            });
        })

        $('#cerrar_persona').click(function () {
            $(' #persona').val("");
        });

        //Validar CORREO
        document.getElementById('email').addEventListener('input', function () {
            campo = event.target;
            valido = document.getElementById('emailOK');

            emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            //Se muestra un texto a modo de ejemplo, luego va a ser un icono
            if (emailRegex.test(campo.value)) {
                valido.innerText = "Email válido";
            } else {
                valido.innerText = "Email incorrecto";
            }
        });
    </script>
</html>