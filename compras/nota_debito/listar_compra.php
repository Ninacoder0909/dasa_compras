<?php
session_start();

require '../../conexion.php';
$idcom = $_REQUEST['vidcompra'];
$compras = consultas::get_datos("SELECT * FROM v_compras_detalle WHERE id_compra = " . $idcom);
?>
<?php

if (!empty($compras)) { ?>

    <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered" style="border: #ABD3D1 solid">
        <thead>
            <tr style="background-color: #ABD3D1">
                <th class="text-center">Producto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($compras as $compra) { ?>
                <tr>

                    <td class="text-center" id="precio"> <?php echo $compra['pro_descri']; ?></td>

                    <td class="text-center" id="j"><?php echo $compra['cantidad']; ?></td>
                    <td class="text-center" id="j"><?php echo $compra['precio']; ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } else { ?>
    <?php echo 'ATENCION! NO SE ENCUENTRAN DETALLES'; ?>
<?php } ?>