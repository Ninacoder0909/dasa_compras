<?php
include '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

class MYPDF extends TCPDF {
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('helvetica','I',8);
        $this->Cell(0,0,'Pag. '.$this->getAliasNumPage() . '/' . $this->getAliasNbPages(),0,false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nina');
$pdf->SetTitle('Reporte de deposito');
$pdf->SetSubject('TCPDF TUTORIAL');
$pdf->SetKeywords('TCDPDF, PDF, example');
$pdf->SetPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'', PDF_FONT_SIZE_MAIN));
$pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//Se repite porque uno es del margen y otro es del salto automatico
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//tipo de letra 
$pdf->SetFont('times', 'N', 20);
//Agregar pagina
$pdf->AddPage('P','LEGAL');
//Formato de titulo
$pdf->Cell(0, 0, "Reporte de deposito", 0, 1, 'C');
//Salto de linea 
$pdf->Ln();
//tabla
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.1);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('','B',12);
$pdf->SetFillColor(180, 180, 180);
$pdf->Cell(60, 5,'Deposito', 1, 0, 'C',1);
$pdf->Cell(60, 5,'Sucursal', 1, 0, 'C',1);
$pdf->Cell(70, 5,'Direccion', 1, 0, 'C',1);
$pdf->Ln();
$pdf->SetFont('','');
$pdf->SetFillColor(255, 255, 255);

//CONSULTA DE DATOS 
$sqls = consultas::get_datos("SELECT * FROM v_ref_deposito ORDER BY id_depo");
foreach ($sqls AS $sql){
    $pdf->Cell(60, 5, $sql['dep_descri'], 1, 0, 'C',1);
    $pdf->Cell(60, 5, $sql['suc_descri'], 1, 0, 'C',1);
     $pdf->Cell(70, 5, $sql['suc_direccion'], 1, 0, 'C',1);
    $pdf->Ln();
}
//Salida al navegador
$pdf->Output('Reporte_deposito.pdf','I');
?>
