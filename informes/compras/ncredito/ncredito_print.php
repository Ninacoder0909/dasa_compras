<?php

include '../../../librerias/tcpdf/tcpdf.php';
require '../../../conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gianina Paredes');
$pdf->SetTitle('REPORTE DE NOTA CREDITO');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 18);
// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
//$pdf->Cell(0, 0, "REPORTE DE COMPRAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);
if ($_REQUEST['vopcion'] == '1') {
    $fechainicial = $_REQUEST['vdesde'];
    $fechafinal = $_REQUEST['vhasta'];
    $compras = consultas::get_datos("select * from v_ncredito where fecha_sistema BETWEEN $fechainicial AND $fechafinal");
    if (!empty($compras)) {
        foreach ($compras as $pedido) {
            //columnas
            $pdf->Cell(0, 0, "REPORTE DE NOTAS DE CREDITO", 0, 1, 'C');
            $pdf->SetFont('', 'B', 12);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(40, 5, '                ', 0, 0, 'C', 1);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(190, 5, '         ', 0, 0, 'C');
            $pdf->Cell(30, 5, 'N° FACTURA', 1, 0, 'C', 1);

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', 'B', 12);
            $pdf->Cell(50, 5, $pedido['factu'], 1, 0, 'C', 1);

            $pdf->Ln(); //salto 
            $pdf->Ln(); //salto 
        

            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(1, 5, '', 0, 0, 'C', 1);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(160, 5, '         ', 0, 0, 'C');
            $pdf->Cell(70, 5, 'MOTIVO', 1, 0, 'C', 1);

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', 'B', 12);
            $pdf->Cell(80, 5, $pedido['descripcion'], 1, 0, 'C', 1);
            $pdf->Ln(); //salto 
            $pdf->Ln(); //salto 
            $pdf->Ln(); //salto 


            $pdf->SetFont('', 'B', 12);
            //columnas
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(20, 5, '                ', 0, 0, 'C', 1);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(40, 5, 'CODIGO', 1, 0, 'C', 1);
            $pdf->Cell(100, 5, 'FECHA', 1, 0, 'C', 1);
            $pdf->Cell(70, 5, 'USUARIO', 1, 0, 'C', 1);
            $pdf->Cell(80, 5, 'PROVEEDOR', 1, 0, 'C', 1);

            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 12);
            $pdf->Cell(20, 5, '         ', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $pedido['id_credito'], 1, 0, 'C', 1);
            $pdf->Cell(100, 5, $pedido['fecha_pedido'], 1, 0, 'C', 1);
            $pdf->Cell(70, 5, $pedido['usu_nick'], 1, 0, 'C', 1);
            $pdf->Cell(80, 5, $pedido['prv_razon_social'], 1, 0, 'C', 1);

            $pdf->Ln(); //salto 
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();

            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(290, 3, 'DETALLE DE NOTA DE CREDITO NRO.:  ' . $pedido['id_credito'], 0, 0, 'C', 0);
            $pdf->Ln();
            $pdf->Ln();

            $detalles = consultas::get_datos("select * from v_ncredito_detalle where id_credito=" . $pedido['id_credito'] . " order by id_credito");
            if (!empty($detalles)) {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetFont('', 'B', 12);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(30, 5, '', 0, 0, 'C');
                $pdf->Cell(85, 5, 'ARTICULO', 1, 0, 'C', 1);
                $pdf->Cell(25, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Cell(40, 5, 'PREC. UNIT', 1, 0, 'C', 1);
                $pdf->Cell(30, 5, 'IVA 5', 1, 0, 'C', 1);
                $pdf->Cell(30, 5, 'IVA 10', 1, 0, 'C', 1);
                $pdf->Cell(30, 5, 'SUBTOTAL', 1, 0, 'C', 1);

                $pdf->Ln(); //salto

                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetFont('', '', 11);
                $pdf->SetFillColor(255, 255, 255);

                foreach ($detalles as $detalle) {
                    $pdf->Cell(30, 5, '         ', 0, 0, 'C', 1);
                    
                    if ($detalle['pro_cod'] > 0) {
                        $pdf->Cell(85, 5, $detalle['pro_descri'], 1, 0, 'C', 1);
                        $pdf->Cell(25, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                        $pdf->Cell(40, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['iva5'], 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['iva10'], 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['subtotal'], 1, 0, 'C', 1);

                        $pdf->Ln();
                    } else {
                        $pdf->Cell(85, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(25, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(40, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['subtotal'], 1, 0, 'C', 1);
                        $pdf->Ln();
                    }
                }
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(30, 5, '                ', 0, 0, 'C', 1);
                $pdf->Cell(340, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                        . '--------------------------------------------------', 0, 1, 'L');

                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(160, 5, '', 0, 0, 'C', 1);

                $pdf->SetFont('', 'B', 15);

                $pdf->Cell(50, 5, 'TOTAL IVA', 1, 0, 'C', 1);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(100, 5, $pedido['total_iva'], 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(160, 5, '', 0, 0, 'C');
                $pdf->Cell(50, 5, 'TOTAL', 1, 0, 'C', 1);

                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(100, 5, $pedido['monto'], 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();

                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(0.2);

                //$pdf->Ln(); //salto
                $pdf->SetFont('', '');
                $pdf->SetFillColor(255, 255, 255);
            } else {
                $pdf->SetFont('times', 'B', '14');
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(300, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
                $pdf->SetFillColor(112, 174, 221);
                $pdf->SetTextColor(3, 26, 47);
                $pdf->Cell(15, 7, '', 0, 0, 'C');

//                $pdf->Ln();
//                $pdf->Ln();
//                $pdf->Ln();
//                $pdf->Ln();

                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();

                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(0.2);

                //$pdf->Ln(); //salto
                $pdf->SetFont('', '');
                $pdf->SetFillColor(255, 255, 255);
            }
        }
    } else {
        $pdf->SetFont('times', 'B', '18');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.2);

        //$pdf->Ln(); //salto
        $pdf->SetFont('', '');
        $pdf->SetFillColor(255, 255, 255);
    }
}
if ($_REQUEST['vopcion'] == '2') {
    $estados = $_REQUEST['vciudad'];
    $compras = consultas::get_datos("select * from v_ncredito where estado = $estados");
    if (!empty($compras)) {
        foreach ($compras as $pedido) {
            //columnas
            $pdf->Cell(0, 0, "REPORTE DE NOTAS DE CREDITO", 0, 1, 'C');
            $pdf->SetFont('', 'B', 12);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(40, 5, '                ', 0, 0, 'C', 1);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(190, 5, '         ', 0, 0, 'C');
            $pdf->Cell(30, 5, 'N° FACTURA', 1, 0, 'C', 1);

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', 'B', 12);
            $pdf->Cell(50, 5, $pedido['factu'], 1, 0, 'C', 1);

            $pdf->Ln(); //salto 
            $pdf->Ln(); //salto 
        

            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(1, 5, '', 0, 0, 'C', 1);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(160, 5, '         ', 0, 0, 'C');
            $pdf->Cell(70, 5, 'MOTIVO', 1, 0, 'C', 1);

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', 'B', 12);
            $pdf->Cell(80, 5, $pedido['descripcion'], 1, 0, 'C', 1);
            $pdf->Ln(); //salto 
            $pdf->Ln(); //salto 
            $pdf->Ln(); //salto 


            $pdf->SetFont('', 'B', 12);
            //columnas
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(20, 5, '                ', 0, 0, 'C', 1);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(40, 5, 'CODIGO', 1, 0, 'C', 1);
            $pdf->Cell(100, 5, 'FECHA', 1, 0, 'C', 1);
            $pdf->Cell(70, 5, 'USUARIO', 1, 0, 'C', 1);
            $pdf->Cell(80, 5, 'PROVEEDOR', 1, 0, 'C', 1);

            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 12);
            $pdf->Cell(20, 5, '         ', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $pedido['id_credito'], 1, 0, 'C', 1);
            $pdf->Cell(100, 5, $pedido['fecha_pedido'], 1, 0, 'C', 1);
            $pdf->Cell(70, 5, $pedido['usu_nick'], 1, 0, 'C', 1);
            $pdf->Cell(80, 5, $pedido['prv_razon_social'], 1, 0, 'C', 1);

            $pdf->Ln(); //salto 
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();

            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(290, 3, 'DETALLE DE NOTA DE CREDITO NRO.:  ' . $pedido['id_credito'], 0, 0, 'C', 0);
            $pdf->Ln();
            $pdf->Ln();

            $detalles = consultas::get_datos("select * from v_ncredito_detalle where id_credito=" . $pedido['id_credito'] . " order by id_credito");
            if (!empty($detalles)) {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetFont('', 'B', 12);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(30, 5, '', 0, 0, 'C');
                $pdf->Cell(85, 5, 'ARTICULO', 1, 0, 'C', 1);
                $pdf->Cell(25, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Cell(40, 5, 'PREC. UNIT', 1, 0, 'C', 1);
                $pdf->Cell(30, 5, 'IVA 5', 1, 0, 'C', 1);
                $pdf->Cell(30, 5, 'IVA 10', 1, 0, 'C', 1);
                $pdf->Cell(30, 5, 'SUBTOTAL', 1, 0, 'C', 1);

                $pdf->Ln(); //salto

                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetFont('', '', 11);
                $pdf->SetFillColor(255, 255, 255);

                foreach ($detalles as $detalle) {
                    $pdf->Cell(30, 5, '         ', 0, 0, 'C', 1);
                    
                    if ($detalle['pro_cod'] > 0) {
                        $pdf->Cell(85, 5, $detalle['pro_descri'], 1, 0, 'C', 1);
                        $pdf->Cell(25, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                        $pdf->Cell(40, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['iva5'], 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['iva10'], 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['subtotal'], 1, 0, 'C', 1);

                        $pdf->Ln();
                    } else {
                        $pdf->Cell(85, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(25, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(40, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, '-', 1, 0, 'C', 1);
                        $pdf->Cell(30, 5, $detalle['subtotal'], 1, 0, 'C', 1);
                        $pdf->Ln();
                    }
                }
                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(30, 5, '                ', 0, 0, 'C', 1);
                $pdf->Cell(340, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                        . '--------------------------------------------------', 0, 1, 'L');

                $pdf->Ln();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(160, 5, '', 0, 0, 'C', 1);

                $pdf->SetFont('', 'B', 15);

                $pdf->Cell(50, 5, 'TOTAL IVA', 1, 0, 'C', 1);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(100, 5, $pedido['total_iva'], 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(160, 5, '', 0, 0, 'C');
                $pdf->Cell(50, 5, 'TOTAL', 1, 0, 'C', 1);

                $pdf->SetFillColor(255, 255, 255);
                $pdf->Cell(100, 5, $pedido['monto'], 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();

                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(0.2);

                //$pdf->Ln(); //salto
                $pdf->SetFont('', '');
                $pdf->SetFillColor(255, 255, 255);
            } else {
                $pdf->SetFont('times', 'B', '14');
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(300, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
                $pdf->SetFillColor(112, 174, 221);
                $pdf->SetTextColor(3, 26, 47);
                $pdf->Cell(15, 7, '', 0, 0, 'C');

//                $pdf->Ln();
//                $pdf->Ln();
//                $pdf->Ln();
//                $pdf->Ln();

                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();

                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(0.2);

                //$pdf->Ln(); //salto
                $pdf->SetFont('', '');
                $pdf->SetFillColor(255, 255, 255);
            }
        }
    } else {
        $pdf->SetFont('times', 'B', '18');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.2);

        //$pdf->Ln(); //salto
        $pdf->SetFont('', '');
        $pdf->SetFillColor(255, 255, 255);
    }
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_ndebito.pdf', 'I');
?>
