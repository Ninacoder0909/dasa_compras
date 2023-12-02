<?php session_start() ?> <!-- Para que muestre la sesion guardada -->
<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    include './conexion.php';
    require './estilos/css_lte.ctp';
    ?>
</head>

<body class="hold-transition skin-blue sidebar-mini" style="background-color: #1E1E2F;">
    <div class="wrapper">
        <?php require './estilos/cabecera.ctp'; ?>
        <?php require './estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-repeat: no-repeat; background-position:center;background-image: url('/dasa_compras/img/sistema/fondo1.jpg');background-size: 100% 100%;background-size: cover">
            <section class="content">
                <h3 style="font-weight: bold; font-size: 20px;text-align: center;color: whitesmoke">
                    Bienvenido al Sistema: <?php echo ' ' . $_SESSION['nombres']; ?>
                </h3>
                <h5 style="font-size: 14px;text-align: center;color: whitesmoke">
                    <?php date_default_timezone_set('America/Asuncion'); ?>
                    <?php
                    $day = date("l");
                    switch ($day) {
                        case "Sunday":
                            echo $day = "Domingo, ";
                            break;
                        case "Monday":
                            echo "Lunes, ";
                            break;
                        case "Tuesday":
                            echo "Martes, ";
                            break;
                        case "Wednesday":
                            echo "Miércoles, ";
                            break;
                        case "Thursday":
                            echo "Jueves, ";
                            break;
                        case "Friday":
                            echo "Viernes, ";
                            break;
                        case "Saturday":
                            echo "Sábado, ";
                            break;
                    }
                    ?>
                    <?php echo date("d-m-Y "); ?><?php echo date("h:i A"); ?>
                </h5>

            </section>
        </div>
    </div>
    <?php require './estilos/pie.ctp'; ?>
</body>
<?php require './estilos/js_lte.ctp' ?>;

</html>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/chart.js/Chart.js"></script>
<script src="dist/js/pages/dashboard2.js"></script>
<script src="dist/js/demo.js"></script>