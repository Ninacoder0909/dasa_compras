<?php
session_start();
require '../../../conexion.php';
require '../../../estilos/css_lte.ctp';
?>

<form accept-charset="UFT8" class="form-horizontal" onsubmit="return showValues();">

    <input name="option" value="1" id="opcion" type="hidden">
    <div class="col-md-8 col-md-offset-0" style=" margin-top: -14px; border: none;">
        <br>
        <div class="list-group">
            <a href="#" class="list-group-item active" style="background-color: #ABD3D1;color: black;text-align: center;font-size: 20px">Informes por Proveedor</a>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Proveedor</label>
            <div class="col-sm-6">
                <?php $proveedors = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                <select id="vproveedor" class="form-control select2" >
                    <?php
                    if (!empty($proveedors)) {
                        foreach ($proveedors as $p) {
                            ?>
                            <option value="<?php echo $p['prv_cod']; ?>"><?php echo $p['prv_razon_social']; ?></option>
                            <?php
                        }
                    } else {
                        ?>

                    <?php }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <div class="col-md-1 pull-left">
                    <a onclick="enviar();" rel="tooltip" data-tittle="Imprimir" class="btn btn-primary"
                       role="button"> 
                        <span style="padding: 4px" class="fa fa-print"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
      function enviar() {
        window.open("/dasa_compras/informes/compras/libros/libros_print.php?vprov=" + "" + $('#vproveedor').val() + "" + '&vopcion=' + $('#opcion').val(), '_blank');

    }
</script>
<script>
//     function hasta() {
//        var input = document.getElementById("idhasta");
//        input.setAttribute("min", this.value);
//        document.getElementById('idhasta').removeAttribute('disabled');
//    }
//    function desde() {
//        var input = document.getElementById("iddesde");
//        input.setAttribute("max", this.value);
//    }
    document.getElementById("iddesde").onchange = function () {
        var input = document.getElementById("idhasta");
        input.setAttribute("min", this.value);
        document.getElementById('idhasta').removeAttribute('disabled');
    }
    document.getElementById("idhasta").onchange = function () {
        var input = document.getElementById("iddesde");
        input.setAttribute("max", this.value);
    }
</script>