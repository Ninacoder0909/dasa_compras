<?php
session_start();

require '../../conexion.php';
$idproducto = $_REQUEST['vidped'];
$productos = consultas::get_datos("SELECT * FROM v_compras_pedidos_detalle WHERE id_pedido = " . $idproducto);
?>
<?php
if ($idproducto == 0) {
    echo '';
} else {
    if (!empty($productos)) {
        ?>
        <h3 style="text-align: center" >Detalles De Pedidos <i class="ion ion-clipboard"></i></h3>
        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered" style="border: #ABD3D1 solid">
            <thead>
                <tr style="background-color: #ABD3D1">
                    <th class="text-center">Producto</th> 
<!--                    <th class="text-center">Deposito</th> -->
                    <th class="text-center">Cantidad</th> 
                    <th class="text-center">Precio</th> 
                    <th class="text-center">Subtotal</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos AS $producto) { ?>
                    <tr>

                        <td class="text-center" id="precio"> <?php echo $producto['pro_descri']; ?></td>
<!--                        <td class="text-center" id="depo">?php echo $producto['dep_descri']; ?></td>-->
                        <td class="text-center" id="j"><?php echo $producto['cantidad']; ?></td>
                        <td class="text-center" id="j"><?php echo $producto['precio']; ?></td>
                        <td class="text-center" id="j"><?php echo $producto['subtotal']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <?php echo 'ATENCION! NO SE ENCUENTRAN DETALLES'; ?>
    <?php } ?>
<?php } ?>



