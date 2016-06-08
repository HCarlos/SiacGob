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
		$this->Ln(20);
	} 
    
}


$pdf = new PDF_Diag('P','mm',array(215.9, 139.7));
$pdf->AddPage();

require_once("../oFunctions.php");
$F = oFunctions::getInstance();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetX(135);
$pdf->Cell(20, 5, $cfolio, 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetX(135);
$pdf->Cell(20, 5, $F->getWith3LetterMonthD(date('Y-m-d',strtotime($fecha))), 0, 1, 'L');

// Column chart
$pdf->Ln(15);
$pdf->SetFont('Arial', '', 12);
//$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(60);
$pdf->Cell(20, 5, "Estimado: ", 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(5,utf8_decode($nombrec)." (".$idcli.")".", " );
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(180, 5, utf8_decode("su petición ha sido recibida."), 0, 0, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(180, 5, utf8_decode("e iniciará el trámite pertinente. "), 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->SetX(60);
$pdf->Cell(180, 5, utf8_decode("El Gobierno Municipal de Centro agradece su colaboración"), 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetX(60);
$pdf->Cell(180, 5, utf8_decode("y le garantiza confidencialidad y una pronta respuesta."), 0, 1, 'L');
$pdf->Ln(10);
$pdf->SetX(25);
$pdf->Cell(180, 5, utf8_decode("H. AYUNTAMIENTO CONSTITUCIONAL DE CENTRO"), 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetX(25);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(180, 5, utf8_decode("DIRECCIÓN DE ATENCION CIUDADANA"), 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetX(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(180, 5, utf8_decode("TEL (993) 310-3232 ext 3288"), 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetX(20);
$pdf->SetFont('Arial', 'U', 10);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(180, 5, utf8_decode("http://www.villahermosa.gob.mx"), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);

$pdf->Ln(10);

$pdf->Output();

?>
