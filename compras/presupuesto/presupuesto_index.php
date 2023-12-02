<?php session_start(); ?>
<!DOCTYPE>
<HTML>

<HEAD>
    <meta charset="utf-8">
    <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    include '../../conexion.php';
    require '../../estilos/css_lte.ctp';
    ?>
</HEAD>

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">
    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color:  #DEEBFE ">
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
                        <div class="box box-primary" style="background-color: white ">
                            <div class="box-header" style="text-align: center;">
                                <i style="text-align: center" class="ion ion-clipboard"></i>
                                <h3 class="box-title" style="margin: 7px;">Presupuesto</h3>
                                <!-- <a href="/dasa_compras/compras/pedido/pedidosc_index.php" class="btn btn-bitbucket pull-left btn-sm" rel="tooltip" title="Ir a pedidos" style="padding: 8px;">
                                    <i class="fa fa-arrow-circle-left"></i>
                                </a> -->
                                <div class="box-tools">
                                    <a style="padding: 8px; margin: 1px"" class=" btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#registrar" onclick="registrar_permisos(<?php echo "1" ?>);" class="btn btn-success pull-right btn-sm" rel="tooltip" title="Añadir presupuesto">
                                        <i class="fa fa-plus"></i>
                                    </a>


                                </div>

                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <!--BUSCADOR-->
                                        <form action="presupuesto_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Codigo/proveedor..." autofocus="" style="height: 25px;" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-dropbox btn-sm" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                                    <span class="fa fa-search"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--BUSCADOR-->
                                        <?php
                                        $valor = '';
                                        if (isset($_REQUEST['buscar'])) {
                                            $valor = $_REQUEST['buscar'];
                                        }
                                        $presupuesto = consultas::get_datos("SELECT * FROM v_presupuesto WHERE   (id_presupuesto||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%')) AND estado <> 'ANULADO' ORDER BY id_presupuesto");
                                        if (!empty($presupuesto)) {
                                        ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-condensed" style="border: black solid thin;">
                                                    <thead>
                                                        <tr style="background-color: #ABD3D1">
                                                            <th style="border: black solid thin;" class="text-center">#</th>
                                                            <th style="border: black solid thin;" class="text-center">Pedido</th>
                                                            <th style="border: black solid thin;" class="text-center">Fecha</th>
                                                            <th style="border: black solid thin;" class="text-center">Proveedor</th>
                                                            <th style="border: black solid thin;" class="text-center">Validez</th>
                                                            <th style="border: black solid thin;" class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($presupuesto as $pc) { ?>
                                                            <tr>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['id_presupuesto']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['id_pedido']; ?><?php echo ' | '; ?><?php echo $pc['fechav']; ?><?php echo ' | '; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['presu_fecha']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center"> <?php echo $pc['vali']; ?></td>
                                                                <td style="border: black solid thin;" class="text-center">

                                                                    <?php
                                                                    if ($pc['estado'] == 'ACTIVO') {
                                                                        $pcdetalle = consultas::get_datos("SELECT * FROM det_presup WHERE id_presupuesto=" . $pc['id_presupuesto']);
                                                                        if (!empty($pcdetalle)) {
                                                                    ?>

                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <!-- <php if ($pc['estado'] == 'CONFIRMADO') { ?>
                                                                        <a style="padding: 10px; margin: 1px""  data-toggle=" modal" data-target="#anular" onclick="anulacion(<php echo "'" . $pc['id_presupuesto'] . "'" ?>);" class="btn btn-toolbar btn-lg" role="button" rel="tooltip" data-title="Anular" rel="tooltip" data-placement="top">
                                                                            <span style="color: tomato " class="glyphicon glyphicon-ban-circle"></span>
                                                                        </a>
                                                                    <php } ?> -->

                                                                    <a href="presupuesto_detalle.php?vidpresupuesto=<?php echo $pc['id_presupuesto']; ?>" class="btn btn-toolbar btn-lg" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
                                                                        <i class="fa fa-list"></i>
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
            <!-- registrar-->
            <div id="registrar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="detalles_registrar">

                    </div>
                </div>
            </div>
            <!-- registrar-->
            <div id="anular" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="detalles_anular">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>
<SCRIPT>
    $("#mensaje").delay(1000).slideUp(200, function() {
        $(this).alert('close');
    });

    function registrar_permisos(datos) {
        var dat = datos;
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/presupuesto/presupuesto_addd.php?vpre=" + dat[0],
            beforeSend: function() {
                $('#detalles_registrar').html();
            },
            success: function(msg) {
                $('#detalles_registrar').html(msg);
            }
        });
    }

    function anulacion(datos) {
        var dat = datos.split("_");
        $.ajax({
            type: "GET",
            url: "/dasa_compras/compras/presupuesto/presupuesto_anular.php?vidpresupuesto=" + dat[0],
            beforeSend: function() {
                $('#detalles_anular').html();
            },
            success: function(msg) {
                $('#detalles_anular').html(msg);
            }
        });
    }
</SCRIPT>

</HTML>