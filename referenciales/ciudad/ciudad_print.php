<?php
include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

class MYPDF extends TCPDF
{
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nina');
$pdf->SetTitle('Reporte de Ciudad');
$pdf->SetSubject('TCPDF TUTORIAL');
$pdf->SetKeywords('TCDPDF, PDF, example');
$pdf->SetPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->SetHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//Se repite porque uno es del margen y otro es del salto automatico
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//tipo de letra 
$pdf->SetFont('times', 'B', 14);
//Agregar pagina
$pdf->AddPage('P', 'LEGAL');
//Formato de titulo
$pdf->Cell(0, 0, "Reporte de Ciudad", 0, 1, 'C');
//Salto de linea 
$pdf->Ln();
//tabla
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('', 'B', 12);
$pdf->SetFillColor(180, 180, 180);
$pdf->Cell(60, 5, 'Codigo', 1, 0, 'C', 1);
$pdf->Cell(60, 5, 'Ciudad', 1, 0, 'C', 1);


$pdf->Ln();
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);

$sqls = consultas::get_datos("SELECT * FROM v_ref_ciudad ORDER BY id_ciudad");
foreach ($sqls as $sql) {
    $pdf->Cell(60, 5, $sql['id_ciudad'], 1, 0, 'C', 1);
    $pdf->Cell(60, 5, $sql['ciu_descri'], 1, 0, 'C', 1);

    $pdf->Ln();
}
//Salida al navegador
$pdf->Output('Reporte_ciudad.pdf', 'I');
