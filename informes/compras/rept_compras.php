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
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Informes de Compras</h3>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-0">
                                            <div class="list-group">
                                                <br>
                                                <a href="#" class="list-group-item active" style="background-color: #ABD3D1;color: black">Reportes</a>
                                                <a href="#" class="list-group-item" onclick="obtener_pedido();" style="color: black">Pedido</a>
                                                <a href="#" class="list-group-item" onclick="obtener_presupuesto();" style="color: black">Presupuesto</a>
                                                <a href="#" class="list-group-item" onclick="obtener_orden();" style="color: black">Orden de Compra</a>
                                                <a href="#" class="list-group-item" onclick="obtener_compras();" style="color: black">Compras</a>
                                                <a href="#" class="list-group-item" onclick="obtener_cuentas();" style="color: black">Cuentas</a>
                                                <!-- <a href="#" class="list-group-item" onclick="obtener_libro();" style="color: black">Libros de Compra</a> -->
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
    function obtener_libro() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/libros/reporte_libros.php",
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
<script>
    function obtener_pedido() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/pedidos/reporte_pedidos.php",
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
<script>
    function obtener_presupuesto() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/presupuesto/reporte_presupuesto.php",
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
<script>
    function obtener_orden() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/orden/reporte_orden.php",
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
<script>
    function obtener_compras() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/compras/reporte_compras.php",
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
<script>
    function obtener_cuentas() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/cuentas/reporte_cuentas.php",
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
<script>
    function obtener_ndebito() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/ndebito/reporte_ndebito.php",
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
<script>
    function obtener_ncredito() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/ncredito/reporte_ncredito.php",
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
<script>
    function obtener_nremision() {
        $.ajax({
            type: 'POST',
            url: "/dasa_compras/informes/compras/nremision/reporte_nremision.php",
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