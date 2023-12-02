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

<BODY class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">

    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: rgb(241,231,254)">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Informes referenciales</h3>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-0">
                                            <div class="list-group">
                                                <br>
                                                <a href="#" class="list-group-item active" style="background-color: #ABD3D1;color: black">Reportes</a>

                                                <a href="/dasa_compras/referenciales/empleado/empleado_print.php" target="_BLANK" class="list-group-item " style="color: black">Empleados</a>

                                                <a href="#" class="list-group-item" onclick="obtener_proveedor();" style="color: black">Proveedor</a>
                                                <a href="#" class="list-group-item" onclick="obtener_producto();" style="color: black">Productos</a>

                                            </div>
                                        </div>
                                        <div id="cargando"></div>
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
    function obtener_proveedor() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/referenciales/proveedor/reporte_proveedor.php",
            cache: false,
            beforeSend: function() {
                $('#cargando').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif"><strong><i>En proceso...</i></strong>');
            },
            success: function(msg) {
                $('#cargando').html(msg);


            }
        })
    }

    function obtener_producto() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/referenciales/productos/reporte_productos.php",
            cache: false,
            beforeSend: function() {
                $('#cargando').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif"><strong><i>En proceso...</i></strong>');
            },
            success: function(msg) {
                $('#cargando').html(msg);


            }
        })
    }
</script>

</html>