<?php session_start() ?> <!-- Para que muestre la sesion guardada -->
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../../conexion.php';
        require '../../../estilos/css_lte.ctp';
        ?>
    </head>
    <form accept-charset="UTF8" class="form-horizontal">
        <br>
        <div class="col-md-6 col-md-offset-0">
            <div class="list-group">
                <a href="#" class="list-group-item active" style="background-color: #ABD3D1;color: black;padding: 13px;text-align: center;font-size: 20px">Referencial de Proveedor</a>
            </div>
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-0">
                                    <div class="list-group">
                                         <a href="#" class="list-group-item active" style="background-color: #ABD3D1;color: black">Filtros</a>
                                         <a href="#" class="list-group-item active" onclick="obtener_ciudad()" style="background-color: white;color: black"><i class="ion-checkmark"></i> Ciudad</a>
<!--                                         <a href="#" class="list-group-item active" onclick="obtener_estado()" style="background-color: white;color: black"><i class="ion-checkmark"></i> Estado</a>-->
                                    </div>
                                </div>
                                <div id="cargando">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </form>
    <?php require '../../../estilos/js_lte.ctp'; ?>
    <script>
        function obtener_ciudad() {
            $.ajax({
                type: 'POST',
                url: "/dasa_compras/informes/referenciales/proveedor/ref_ciudad.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif"><strong><i>En proceso...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            })
        }
        function obtener_estado() {
            $.ajax({
                type: 'POST',
                url: "/dasa_compras/informes/referenciales/proveedor/inf_estado.php",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/dasa_compras/img/sistema/ajax-loader.gif"><strong><i>En proceso...</i></strong>');
                },
                success: function (msg) {
                    $('#est').html(msg);
                }
            })
        }
    </script>
</html>




