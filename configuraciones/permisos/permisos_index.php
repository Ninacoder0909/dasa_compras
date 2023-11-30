<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        require '../../conexion.php';
        session_start();
       
        require '../../estilos/css_lte.ctp';
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../estilos/cabecera.ctp'; ?><!--BARRA DE HERRAMIENTAS-->
            <?php require '../../estilos/izquierda.ctp'; ?><!--BARRA DE HERRAMIENTAS-->
            <div class="content-wrapper"  style="background-color: rgb(241,231,254)">
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12">
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

                            <h3 class="page-header">Permisos de Usuarios
                                <a style="margin: 2px" data-toggle="modal" data-target="#registrar" 
                                   onclick="registrar(<?php echo "'" . $_REQUEST['vgrup'] . "_" . $_REQUEST['vgrunombre']. "'" ?>)" 
                                   class="btn btn-success btn-circle pull-right" 
                                   rel='tooltip' title="Añadir">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a>    
                                <a href="/dasa_compras/configuraciones/usuarios/usuarios_index.php" style="margin: 2px" 
                                   class="btn btn-primary btn-circle pull-right"  rel='tooltip' title="Atras">
                                    <i class="glyphicon glyphicon-arrow-left"></i>
                                </a> 
                            </h3>
                        </div>     
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Grupo:  <i><strong><?php echo $_REQUEST['vgrunombre']; ?></strong></i></div>
                                <?php $paginas = consultas::get_datos("select * from v_permisos where gru_cod=" . $_REQUEST['vgrup']); ?>
                                <?php if (!empty($paginas)) { ?>                     
                                    <div class="panel-body">
                                        <?php foreach ($paginas as $pagina) { ?>                        
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="list-group-item-heading" 
                                                         style="width: 87%;">
                                                        <div class="col-lg-2"> <i><strong><?php echo $pagina['pag_nombre']; ?></strong></i></div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Consultar:</strong> 
                                                                    <?php
                                                                    if ($pagina['leer'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Insertar:</strong> 
                                                                    <?php
                                                                    if ($pagina['insertar'] == 't') {
                                                                         echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Actualizar:</strong> <?php
                                                                    if ($pagina['editar'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Borrar:</strong> <?php
                                                                    if ($pagina['borrar'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>                                      
                                                    </div>

                                                    <div class="media-right media-middle" 
                                                         style="padding-left: 58px;">
                                                        <div class="pull-right action-buttons">
<!--                                                            <a onclick="editpag(?php echo "'" . $pagina['gru_cod'] . "_" . $pagina['pag_cod'] . "_" .$pagina['gru_nombre'] . "_" . $pagina['pag_nombre'] . "'";?>)"
                                                               class="btn btn-xs btn-warning" role="button" data-title="Editar"
                                                               data-placement="top" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>-->
                                                            <a onclick="borrar(<?php echo "'" . $pagina['gru_cod'] . "_" . $pagina['pag_cod'] . "_" .
                                                            $pagina['gru_nombre'] . "_" . $pagina['pag_nombre'] . "'";?>)"
                                                               class="btn btn-xs btn-danger" role="button" data-title="Borrar"
                                                               data-placement="top" rel="tooltip" data-toggle="modal" data-target="#delete">
                                                                <span class="glyphicon  glyphicon-trash"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div>
                                        <?php } ?> 
                                    <?php } else { ?>
                                        <div class="alert alert-danger">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            No se han autorizado interfaces...
                                        </div>
                                    <?php } ?>                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--registrar-->
                    <div id="registrar" class="modal fade" role="dialog">
                        <div class="modal-dialog" >
                            <div class="modal-content" id="detalles_registrar">
                               
                            </div>
                        </div>
                    </div>  
                    <!--registrar-->
                    <!--editar permisos--->
                    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" id="detalles_edit">
                                    
                            </div>
                        </div>
                    </div>
                    <!--editar permisos--->
                    <!--borrar-->
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning" id="confirmacion"></div>
                                </div>
                                <div class="modal-footer">
                                    <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!--borrar-->
                </div>
            </div> 
        </div>
        <?php require '../../estilos/js_lte.ctp'; ?>
       <script>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });

        function registrar(datos) {
            var dat = datos.split("_");
            $.ajax({
                type: "GET",
                url: "/dasa_compras/configuraciones/permisos/permiso_add.php?vgrup=" + dat[0] + "&vgrunombre=" + dat[1],
                beforeSend: function () {
                    $('#detalles_registrar').html();
                },
                success: function (msg) {
                    $('#detalles_registrar').html(msg);
                }
            });
        }
        function editpag(datos) {
            var dat = datos.split("_");
            $.ajax({
                type: "GET",
                url: '/dasa_compras/configuraciones/permisos/permiso_editar.php?vgrup=' + dat[0] + '&vgrunombre=' + dat[2] + '&vpagina=' + dat[1],
                beforeSend: function () {
                    $('#detalles_edit').html();
                },
                success: function (msg) {
                    $('#detalles_edit').html(msg);
                }
            });
        }

        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'permisos_control.php?vgru=' + dat[0] + ' &vpag= ' + dat[1] + ' &vgrumbre=' + dat[2]
                    + '&consul=null&agre=null&editar=null&borrar=null' + '&accion=3&pagina=permisos_index.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\ Desea Borrar el Permiso de la pagina <i><strong>' + dat[1] + '</strong></i>?');
        }
       

    </script>
    </body>
</html>