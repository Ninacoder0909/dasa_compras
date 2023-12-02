<?php
session_start();
if ($_SESSION) {
    session_destroy();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Acceso al sistema</title>
    <meta content="width=devicewidth,initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php require 'estilos/css_lte.ctp'; ?>
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: black;
        }

        #sha {
            max-width: 380px;
            -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
            -moz-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
            box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
            border-radius: 6%;
            border-color: #00ACD6;
            background-color: #1E1E2F;
        }

        #avatar {
            width: 200px;
            height: 200px;
            margin: 0px auto 0px;
            display: block;
            border-radius: 200px;
        }

        .login {
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container well" id="sha">
        <div class="row">
            <div>
                <img class="img-responsive" src="/dasa_compras/img/sistema/ts.gif" id="avatar">
            </div>
        </div>
        <form class="login" action="acceso.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" name="usuario" class="form-control" onkeypress="return soloLetras(event)" placeholder="Ingrese el nombre de usuario" required="" autofocus="" />
                <span class="glyphicon glyphicon-user form-control-feedback"></span> <!-- este le pone un icono a mi input en dashboard puedo ver los tipos de iconos o etc -->

            </div>
            <div class="form-group has-feedback">
                <input type="password" name="pass" onkeypress="return contraseña(event)" class="form-control" placeholder="" required="">
                <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" style="">Iniciar Sesion</button en btn-primary si cambio primary de acuerdo al dashboard me cambia el estilo del boton <div class="checkbox" style="padding: 0px 20px">
            <p class="help-block"><a href="#" style="color: whitesmoke; font-weight: bold">¿No puede ingresar a su cuenta?</a></p>
    </div>
    <?php
    if (!empty($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-info-sign"></span>
            <?php echo $_SESSION['error']; ?>
        </div>
    <?php } ?>
    </form>
    </div>
</body>
<?php require 'estilos/js_lte.ctp'; ?>
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

</html>