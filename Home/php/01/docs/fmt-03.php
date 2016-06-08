<?php
$cfolio      = $_POST["cfolio"];
$nombrec     = $_POST["nombrec"];
$producto    = $_POST["producto"];
$descripcion = $_POST["descripcion"];
$fecha       = $_POST["fecha"];
$idcli       = $_POST["idcli"];

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


require('../diag/sector.php');

class PDF_Diag extends PDF_Sector {
    var $legends;
    var $wLegend;
    var $sum;
    var $NbVal;
    var $ley;
    var $datos;

    function Header()
    {   
		$this->SetFillColor(64,64,64);
          $this->Image('../../../images/img-web/sidc-logo-3-inner.jpg',0,0,300);
		$this->Ln(25);
	} 
    
}


$pdf = new PDF_Diag('P','mm',array(215.9, 69.85));
$pdf->SetDisplayMode('fullpage');
$pdf->AddPage();

require_once("../oFunctions.php");
$F = oFunctions::getInstance();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(55);
$pdf->Cell(20, 5, "ACUSE DE RECIBO", 0, 0, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetX(135);
$pdf->Cell(20, 5, $F->getWith3LetterMonthD(date('Y-m-d',strtotime($fecha)))."   ID:".$idcli, 0, 1, 'L');

$pdf->SetFont('Arial', '', 16);
$pdf->Ln(3.8);
$pdf->SetX(90);
$pdf->Write(5,"FOLIO: ");
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 5, $cfolio, 0, 1, 'L');


$pdf->Output();

?>
