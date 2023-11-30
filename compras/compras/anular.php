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
                                    <h3 class="box-title">Anular Compra</h3>
                                    <div class="box-tools">
                                        <a href="compras_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="compras_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra =" . $_GET['vidcompra']); ?>
                                        <div class="row">
                                            <input type="hidden" name="voperacion"  value="3">
                                            <input type="hidden" name="vestado" value="<?php echo $resultado[0]['estado']; ?>"/> 
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Codigo de Pedido</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" name="vidcompra" readonly="" value="<?php echo $resultado[0]['id_compra']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Fecha</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" name="vfecha" readonly="" 
                                                           value="<?php echo $resultado[0]['fechac']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php $usuario = consultas::get_datos("SELECT * FROM ref_usuario WHERE usu_cod =" . $resultado[0]['usu_cod']) ?>
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Usuario</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input type="hidden" name="vusuario" value="<?php echo $usuario[0]['usu_cod']; ?>"/> 
                                                    <input class="form-control" type="text" name="vusuarionick" readonly="" 
                                                           value="<?php echo $usuario[0]['usu_nick']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Proveedor</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                     <input type="hidden" name="vidproveedor" value="<?php echo $resultado[0]['prv_cod']; ?>"/> 
                                                    <input class="form-control" type="text" name="vproveedor" readonly="" value="<?php echo $resultado[0]['prv_razon_social']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Nro. de factura</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" name="vnrofactura" readonly="" value="<?php echo $resultado[0]['nro_factura']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Condicion</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" name="vcondicion" readonly="" value="<?php echo $resultado[0]['condicion']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Cant. cuota</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" name="vcantidadcuota" readonly="" value="<?php echo $resultado[0]['cant_cuo']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-md-2 col-xs-2 control-label">Intervalo</label>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <input class="form-control" type="text" name="vintervalo" readonly="" value="<?php echo $resultado[0]['intervalo']; ?>">
                                                </div>
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