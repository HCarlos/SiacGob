<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$arg = $_POST["data"];
$v = $_POST["v"];
$opt = intval($v);
parse_str($arg);
if (!isset($dependencia)){
	$dependencia=$iddep;
}
if (!isset($area)){
	$area=$idareadep;
}

require_once('../vo/voConn.php');
require_once("../oFunctions.php");

$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");

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
		//$this->Ln(2);
	} 
    
}

$pdf=new PDF_Diag('P','mm','Letter');
		$pdf->AddPage();
if ($area==0){
	$query = "Select * from _viDemanda where idprodgpo = $dependencia and (fecha between '$fi' and '$ff') order by idareadep, iddenuncia ";
}else{
	$query = "Select * from _viDemanda where idprodgpo = $dependencia and idareadep = $area and (fecha between '$fi' and '$ff') order by iddenuncia asc";
}
$result = mysql_query($query);
$i = 1;
$ia = 0;
while ($fila = mysql_fetch_object($result)) {
	if (($i>3) || ($fila->idareadep != $ia)){
		$pdf->AddPage();
		$i = 1;
		$ia = $fila->idareadep;
	}
	
	$pdf->SetFillColor(64,64,64);
	$pdf->Image('../../../images/img-web/logo-centro.gif',2,2,30,8);
	$pdf->Ln(2);
	$pdf->Ln(2);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(100, 5, "ORDEN DE TRABADO PARA LAS BRIGADAS", "LTB", 0, 'L');
	$pdf->Cell(100, 5, "SISTEMA DE AGUA Y SANEAMIENTO - ATENCION CIUDADANA", "TBR", 1, 'R');
	$pdf->Ln(2);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(40, 5, "Folio: ".$fila->cfolio, 0, 0, 'L');
	$pdf->Cell(40, 5, "Fecha: ".$F->getWith3LetterMonthD(date('Y-m-d',strtotime($fila->fecha))), 0, 0, 'L');
	$pdf->Cell(100, 5, "Brigada: ".utf8_decode($fila->areadep), 0, 1, 'L');
	$pdf->Ln(2);
	$pdf->SetFont('Arial', '', 10);
	$pdf->MultiCell(200, 7,"Servicio: ".utf8_decode($fila->producto), 0);
	$pdf->Ln(2);
	$pdf->SetFont('Arial', '', 10);
	$pdf->MultiCell(200, 7,utf8_decode("Descripción: ").utf8_decode($fila->descripcion), 0);
	$pdf->Ln(2);
	$pdf->SetFont('Arial', 'bi', 10);
	$pdf->Cell(200, 5, "DATOS DEL CIUDADANO:", 0, 1, 'L');
	$pdf->Ln(2);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(100, 5, "Nombre: ".utf8_decode($fila->nombrec), 0, 0, 'L');
	$pdf->Cell(100, 5, utf8_decode("Teléfonos: ").utf8_decode($fila->tel1).", ".utf8_decode($fila->cel1), 0, 1, 'L');
	$pdf->MultiCell(200, 7,"Localidad: ".utf8_decode($fila->domc), 0);
	$pdf->Cell(200, 5, " ", "B", 1, 'C');
	$pdf->Ln(4);
	++$i;

	}


// Column chart
$pdf->Output();

?>
