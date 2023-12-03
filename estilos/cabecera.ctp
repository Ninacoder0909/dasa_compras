<header class="main-header" style="background-color: #1E1E2F;">
    <a href="#" class="sidebar-toggle" style="margin-left: 5px;color: #87CEFA;" data-toggle="offcanvas" role="button">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="sr-only" style="color: #00C0EF; text-shadow: 0 0 10px rgba(135, 206, 250, 0.8);">Toggle navigation</span>
        <span class="logo-mini" style="background-color: #1E1E2F; margin-left: 15px; font-size: larger; color: whitesmoke;">
            <b>T.S </b>
        </span>

    </a>

    <nav class="navbar navbar-static-top" style="background-color: #1E1E2F;" role="navigation">
        <!-- <nav class="navbar navbar-static-top" style="background-color: #1E1E2F;border-top: 2px solid #1C8AF6;" role="navigation"> -->

        <!-- Menu emergente derecho -->
        <div class="navbar-custom-menu" style="background-color: #1E1E2F;">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" style="background-color: #27293D;" data-toggle="dropdown">
                        <img src="/dasa_compras/img/personas/<?php
                                                                if (!empty($_SESSION['usu_foto'])) {
                                                                    echo $_SESSION['usu_foto'];
                                                                } else {
                                                                    echo "/dasa_compras/img/sistema/nodisponible.jpg";
                                                                }
                                                                ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['usu_nick']; ?></span>
                    </a>
                    <ul class="dropdown-menu" style="background-color: #27293D;">
                        <li class="user-header" style="background-color: #27293D;">
                            <img src="/dasa_compras/img/personas/<?php
                                                                    if (!empty($_SESSION['usu_foto'])) {
                                                                        echo $_SESSION['usu_foto'];
                                                                    } else {
                                                                        echo "/dasa_compras/img/sistema/nodisponible.jpg";
                                                                    }
                                                                    ?>" class="img-circle" alt="User Image">
                            <p style="color: whitesmoke;">
                                <small> <b style="color: whitesmoke;"> CARGO: </b>
                                    <?php
                                    if (!empty($_SESSION['gru_cod'])) {
                                        echo $_SESSION['gru_nombre'];
                                    } else {
                                        echo "ERROR 69, CONTACTE AL 911";
                                    }
                                    ?>
                                </small>
                        <li class="user-footer">
                            <!-- <div class="pull-left">
                                <a href="/dasa_compras/ayuda.pdf" target="_blank" class="btn btn-default" style="color:blue;"> Ayuda </a>
                            </div> -->
                            <div class="pull-right">
                                <a href="/dasa_compras" class="btn btn-default" style="color: red;"> Salir </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>