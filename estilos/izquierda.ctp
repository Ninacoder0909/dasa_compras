<aside class="main-sidebar" style="background-color: #1E1E2F;height: auto;">
    <section class="sidebar " style="">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dasa_compras/img/personas/<?php
                                                        if (!empty($_SESSION['usu_foto'])) {
                                                            echo $_SESSION['usu_foto'];
                                                        } else {
                                                            echo "/dasa_compras/img/sistema/nodisponible.jpg";
                                                        }
                                                        ?>" class="img-circle" alt="Imagen de Usuario">
            </div>
            <div class="pull-left info" style="font-size: 12px; padding-top: 20px;">
                <p><?php echo $_SESSION['nombres']; ?></p>
                <a href="#">
                    <i class="fa fa-circle text-success"></i>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">En linea</font>
                    </font>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu" style="background-color: #1E1E2F">
            <li> <a> </a></li>
            <li> <a style="border-top: 2px solid #1C8AF6; box-shadow: inset 0px 5px 5px rgba(28, 138, 246, 0.5)"> </a></li>
            <!-- <li class="header">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;font-size: 15px;color: white">Navegación Principal</font>
                </font>
            </li> -->
            <li><a href="/dasa_compras/menu.php" class="fa fa-home"><span class="logo-lg"><strong> INICIO</strong></span> </a></li>
            <?php $modulos = consultas::get_datos("select distinct(mod_cod),(mod_nombre) from v_permisos where gru_cod =" . $_SESSION['gru_cod'] . " order by mod_cod"); ?>
            <?php if (!empty($modulos)) { ?>
                <?php foreach ($modulos as $modulo) { ?>
                    <li class="treeview" style="background-color: #1E1E2F">
                        <a href="" style="background-color: #1E1E2F">
                            <i style=" text-shadow: 0 0 10px rgba(135, 206, 250, 0.2);" class="fa fa-circle-o text-aqua"></i>
                            <span><?php echo $modulo['mod_nombre'] ?></span>
                            <i class="fa fa-angle-double-right pull-right"></i>
                        </a>
                        <?php $paginas = consultas::get_datos("select pag_direc,pag_nombre,leer,insertar,editar,borrar from v_permisos  where mod_cod=" . $modulo['mod_cod'] . " and gru_cod =" . $_SESSION['gru_cod'] . " order by pag_cod"); ?>
                        <ul class="treeview-menu" style="background-color: #27293D">
                            <?php foreach ($paginas as $pagina) { ?>
                                <li style="background-color: #27293D">
                                    <a style="background-color: #27293D" class="fa fa-book" href="<?php echo $pagina['pag_direc']; ?>"><?php echo " " . $pagina['pag_nombre']; ?>
                                    </a>
                                </li>
                                <?php $_SESSION[$pagina['pag_nombre']] = $pagina; ?>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <b style="color: red; margin-left: 300px"> NO TIENE PERMISOS...</b>
            <?php } ?>
        </ul>
    </section>
</aside>