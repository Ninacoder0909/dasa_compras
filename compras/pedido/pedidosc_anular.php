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

<BODY class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php require '../../estilos/cabecera.ctp'; ?>
        <?php require '../../estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: #DEEBFE">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="box box-primary" style="background-color: #ABD3D1">
                            <div class="box-header">
                                <i class="ion ion-edit"></i>
                                <h3 class="box-title">Anular Pedido</h3>
                                <div class="box-tools">
                                    <a href="pedidosc_index.php" class="btn btn-primary pull-right btn-sm">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="pedidosc_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <div class="box-body" style="background-color: white">
                                    <?php $resultado = consultas::get_datos("SELECT * FROM v_compras_pedidos WHERE id_pedido =" . $_GET['vidpedido']); ?>
                                    <div class="row">
                                        <input type="hidden" name="voperacion" value="4">
                                        <input type="hidden" name="vestado" value="<?php echo $resultado[0]['estado']; ?>" />
                                        <div class="form-group">
                                            <label class="col-lg-2 col-md-2 col-xs-2 control-label">Codigo de Pedido</label>
                                            <div class="col-lg-8 col-md-8 col-xs-8">
                                                <input class="form-control" type="text" name="vidpedido" readonly="" value="<?php echo $resultado[0]['id_pedido']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-md-2 col-xs-2 control-label">Fecha</label>
                                            <div class="col-lg-8 col-md-8 col-xs-8">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo $resultado[0]['fechav']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php $usuario = consultas::get_datos("SELECT * FROM ref_usuario WHERE usu_cod =" . $resultado[0]['usu_cod']) ?>
                                            <label class="col-lg-2 col-md-2 col-xs-2 control-label">Usuario</label>
                                            <div class="col-lg-8 col-md-8 col-xs-8">
                                                <input type="hidden" name="vusuario" value="<?php echo $usuario[0]['usu_cod']; ?>" />
                                                <input class="form-control" type="text" name="vusuarionick" readonly="" value="<?php echo $usuario[0]['usu_nick']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-header">

                                        <h3 style="text-align: center">Detalles Items <i class="ion ion-clipboard"></i></h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php

                                            $pedidoscdetalle = consultas::get_datos("SELECT * FROM v_compras_pedidos_detalle WHERE id_pedido =" .  $_GET['vidpedido']);
                                            if (!empty($pedidoscdetalle)) {
                                            ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Producto</th>
                                                                <th class="text-center">Cantidad</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pedidoscdetalle as $pcd) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-danger flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span> El pedido no tiene detalles...
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer" style="text-align: center;background-color: #ABD3D1">
                                    <button class="btn btn-danger" type="submit">Anular</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require '../../estilos/pie.ctp'; ?>
</BODY>
<?php require '../../estilos/js_lte.ctp'; ?>

</HTML>