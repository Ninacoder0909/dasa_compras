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
                                    <h3 class="box-title">NOTA DE DEBITO</h3>
                                    <div class="box-tools">
                                        
                                       <a href="pedidosc_add.php"  title="Agregar pedidos" rel="tooltip" class="btn btn-success pull-left btn-sm" style="margin: 1px; padding: 8px">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <!--BUSCADOR-->
                                        <form action="cargos_index.php" method="POST" accept-charset="UTF-8" class="form-inline" >
                                            <div  style="float: right; width: 52%;display: block;">
                                                <div class="form-group-sm" >
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form ">
                                                                <input type="text" class="form-control" name="buscar" placeholder="Cargo..." style="margin: 0.2px">
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
                                <br><br>

                                <div class="box-body no-padding" >
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $valor = '';
                                            if (isset($_REQUEST['buscar'])) {
                                                $valor = $_REQUEST['buscar'];
                                            }
                                            $grupos = consultas::get_datos("SELECT * FROM v_ndebito WHERE (id_debito||TRIM(UPPER(factu))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY id_debito");
                                            //$grupos = consultas::get_datos("SELECT * FROM ref_grupos ORDER BY gru_cod");
                                            if (!empty($grupos)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class=" table col-lg-12 col-md-12 col-xs-12 table-bordered" style="border: black solid thin;">
                                                        <thead>
                                                            <tr style="background-color: #ABD3D1">
                                                                <th style="border: black solid thin;" class="text-center">#</th>
                                                                <th style="border: black solid thin;" class="text-center">Compra N°</th>
                                                                <th style="border: black solid thin;" class="text-center">Proveedor</th>
                                                                <th style="border: black solid thin;" class="text-center">N° Factura</th>
                                                                <th style="border: black solid thin;" class="text-center">Fecha</th>
                                                                <th style="border: black solid thin;" class="text-center">Total</th>
                                                                <th style="border: black solid thin;" class="text-center">Iva total</th>

                                                            </tr> 
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($grupos AS $p) { ?>
                                                                <tr>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Producto "> <?php echo $p['id_debito'] ?></td>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Producto "> <?php echo $p['id_compra'] ?></td>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['prv_razon_social'] ?></td>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Deposito "> <?php echo $p['factu'] ?></td>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['fecha_pedido1'] ?></td>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['total_debito'] ?></td>
                                                                    <td style="border: black solid thin;" class="text-center" data-title="Cantidad "> <?php echo $p['total_iva'] ?></td>
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
        //PARA QUE EL FOCO SE VAYA EN EL INPUT
        $(".modal").on('shown.bs.modal', function () {
            $(this).find('input:text:visible:first').focus();
        });
    </script>
</html>


