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
                                    <h3 class="box-title">Cliente</h3>
                                    <div class="box-tools">
                                        <a href="cliente_add.php" class="btn btn-success pull-right btn-sm" style="padding: 8px; margin: 1px">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="cliente_print.php" class="btn btn-bitbucket pull-right btn-sm" style="padding: 8px; margin: 1px">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <!--BUSCADOR-->
                                        <form action="cliente_index.php" method="POST" accept-charset="UTF-8" class="form-inline" >
                                            <div  style="float: right; width: 52%;display: block;">
                                                <div class="form-group-sm" >
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form ">
                                                                <input type="text" class="form-control" name="buscar" placeholder="CI..." style="margin: 0.2px">
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
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                             <?php
                                            $valor = '';
                                            if (isset($_REQUEST['buscar'])) {
                                                $valor = $_REQUEST['buscar'];
                                            }
                                            $cliente = consultas::get_datos("SELECT * FROM v_ref_cliente WHERE (id_cliente||TRIM(cli_ci)) LIKE TRIM('%" . $valor . "%') ORDER BY id_cliente");
                                            
                                            if (!empty($cliente)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class=" table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Codigo</th>
                                                                <th class="text-center">Cedula</th>
                                                                <th class="text-center">Nombres</th>
                                                                <th class="text-center">Ruc</th>
                                                                <th class="text-center">Telefono</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($cliente AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_cliente'] ?></td>
                                                                    <td class="text-center"> <?php echo $p['cli_ci'] ?></td>
                                                                    <td class="text-center"> <?php echo $p['nombres'] ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_ruc'] ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_telefono'] ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($p['estado'] == 'ACTIVO') { ?>
                                                                        <a href="cliente_edit.php?vid_cliente=<?php echo $p['id_cliente'] ?>" 
                                                                           class="btn btn-toolbar btn-lg" role="button"
                                                                           data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>

                                                                        <a href="cliente_delete.php?vid_cliente=<?php echo $p['id_cliente'] ?>" 
                                                                           class="btn btn-toolbar btn-lg" role="button"
                                                                           data-title="Inhabilitar" rel="tooltip" data-placement="top">
                                                                            <i class="fa fa-user-times"></i>
                                                                            
                                                                        </a>
                                                                        <?php } ?>
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
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
</html>


