<?php
session_start();

require '../../conexion.php';
$idorden = $_REQUEST['vidorden'];
$orden = consultas::get_datos("SELECT * FROM v_orden_detalle WHERE id_ordenc = " . $idorden);
?>
<?php
if ($idorden == 0) {
    echo '';
} else {
    if (!empty($orden)) { ?>

        <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered" style="border: #ABD3D1 solid">
            <thead>
                <tr style="background-color: #ABD3D1">
                    <th class="text-center">Producto</th>
                    <!--                    <th class="text-center">Deposito</th> -->
                    <th class="text-center">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orden as $ordenc) { ?>
                    <tr>

                        <td class="text-center" id="precio"> <?php echo $ordenc['pro_descri']; ?></td>
                        <!--                    <td class="text-center" id="depo">?php echo $ordenc['dep_descri']; ?></td>-->
                        <td class="text-center" id="j"><?php echo $ordenc['cantidad']; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

    <?php } else { ?>

        <div id="detalles_fact" class="box-body no-padding">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="alert alert-danger flat">
                    <span class="glyphicon glyphicon-info-sign"></span>ATENCION! NO SE ENCUENTRAN DETALLES
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>