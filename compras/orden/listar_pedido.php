<?php
session_start();

require '../../conexion.php';
$productos = consultas::get_datos("SELECT * FROM v_compras_pedidos  WHERE estado = 'CONFIRMADO' ");
?>

<?php if (!empty($productos)) { ?>
    <div class="form-group">
        <div class="col-lg-4 col-sm-4 col-xs-4" >
            <?php $marcas = consultas::get_datos("SELECT * FROM v_compras_pedidos where estado = 'CONFIRMADO'"); ?>
            <select class="form-control"  name="vidpedido" id="pedido" required="" onchange="obtenerpedid()" onclick="obtenerpedid()"  >
                <option id="valor" value="0">Debe seleccionar un Pedido</option>
                <?php
                if (!empty($marcas)) {
                    foreach ($marcas as $m) {
                        ?>
                        <option  value="<?php echo $m['id_pedido']; ?>"><?php echo $m['fechap']; ?><?php echo ' | '; ?><?php echo $m['observacion']; ?></option>
                        <?php }
                    ?>           
                <?php }
                ?>
            </select>
        </div>
    </div>

<?php } else { ?>
    <?php echo 'NO CONTIENE PEDIDOS'; ?>
<?php } ?>

