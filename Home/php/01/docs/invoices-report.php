<?php

require('../fe/fpdf.php');           //para crear el pdf
require_once('../vo/voConn.php');
require_once("../oFunctions.php");

$fecha   = $_POST["fecha"];
$type    = $_POST["order"];

switch($type){
	case 0:
		$cfilter = "Todas en orden Cronológico";
		break;
	case 1:
		$cfilter = "Todas en ordernadas por empresa";
		break;
	case 2:
		$cfilter = "Todas las de Diario Presente en orden Cronológico";
		break;
	case 3:
		$cfilter = "Todas las del Sol del Surese en orden Cronolóico";
		break;
	case 4:
		$cfilter = "Todas las de Radio Fórmula en orden Cronológico";
		break;

}

class PDF extends FPDF
{

	public $logo;
	public $fecha;
	public $iding;
	public $cfilter;
	public $sumimp;
	public $sumiva;
	public $sumtot;
	
    //Encabezado de página
    function Header()
    {   
		$this->SetFillColor(64,64,64);
          $this->Image('imgs/logo-gpm-1.gif',10,4,20);
		//$this->Image('imgs/back.jpg',57,85,100);
		
		//$this->Image('imgs/back2.jpg',57,86,150);
		//$this->Image('imgs/cedula_arji.jpg',10,192,39);
		//$this->Image($this->gif,10,172,39);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(25,4,"",0,0,'C');
		$this->Cell(120,4,'SISTEMA INFORMATIVO DE TABASCO S.A DE C.V.'.$type,0,0,'L');
		$this->SetFont('Arial','',8);
		$this->SetTextColor(0,0,0);
		$this->Cell(54,4,utf8_decode('Página ').$this->PageNo().' de {nb}',0,1,'R');		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',0);
		$this->Cell(25,5,"",0,0,'C');
		$this->Cell(50,4,utf8_decode($this->fecha),0,1,'L');
		$this->SetFont('Arial','B',12);
		$this->Cell(25,10,"",0,0,'C');
		$this->Cell(70,6,"LISTADO DE FACTURAS",0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(100,6,utf8_decode($this->cfilter),0,1,'R');
		$this->Ln(10);
		
		$this->SetFont('Arial','B',8);
		$this->SetTextColor(255,255,255);
     	$this->Cell(14,6,'FOLIO',1,0,'C',true);
     	$this->Cell(20,6,'IMPORTE',1,0,'C',true);
     	$this->Cell(20,6,'IVA',1,0,'C',true);
     	$this->Cell(20,6,'TOTAL',1,0,'C',true);
     	$this->Cell(40,6,'XML',1,0,'C',true);
     	$this->Cell(40,6,'PDF',1,0,'C',true);
     	$this->Cell(40,6,"CONT | CLI",1,1,'C',true);
		$this->SetFont('Arial','',8);
		$this->SetTextColor(0,0,0);
		
    } 
    
    function Footer(){
		$h = 4;
		$this->SetFont('Arial','',8);
		$this->SetTextColor(0,0,0);
		$this->SetFont('','');
		
    		$this->Cell(14,$h," ",'LRBT',0,'C');

		$this->Cell(20,$h,$this->sumimp!=0?number_format($this->sumimp, 2, '.', ','):"",'RBT',0,'R');
    		$this->Cell(20,$h,$this->sumiva!=0?number_format($this->sumiva, 2, '.', ','):"",'RBT',0,'R');
    		$this->Cell(20,$h,$this->sumtot!=0?number_format($this->sumtot, 2, '.', ','):"",'RBT',0,'R');
    		$this->Cell(40,$h," ",'RBT',0,'C');
    		$this->Cell(40,$h," ",'RBT',0,'C');
    	
    		$this->Cell(40,$h," ",'RBT',1,'R',false);
				
    }
}


$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");


			
	$pdf=new PDF('P','mm','Letter');
	$pdf->fecha = $F->getDateLong($fecha);
	$pdf->iding = $iding;
	$pdf->cfilter = $cfilter;
	$pdf->AliasNbPages();
	$pdf->AddPage();    
	//$pdf->Ln(4);
	

	
	
	//detalle de conceptos

$sumimp = 0;
$sumiva = 0;
$sumtot = 0;

switch($type){
	case 0:
		$result = mysql_query("select * from _viFacturasEncab where fecha = '$fecha' ");
		break;
	case 1:
		$result = mysql_query("select * from _viFacturasEncab where fecha = '$fecha' order by serie ");
		break;
	case 2:
		$result = mysql_query("select * from _viFacturasEncab where fecha = '$fecha' and serie = 'A' order by serie ");
		break;
	case 3:
		$result = mysql_query("select * from _viFacturasEncab where fecha = '$fecha' and serie = 'B' order by serie ");
		break;
	case 4:
		$result = mysql_query("select * from _viFacturasEncab where fecha = '$fecha' and serie = 'C' order by serie ");
		break;

}
if (mysql_num_rows($result) <= 0) {echo "No existen datos ".$iding; return false;}
while ($fila = mysql_fetch_object($result)) {

		$posy1=$pdf->GetY();//posición antes de escribir concepto
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('','');
		
    		$pdf->MultiCell(14,6,$fila->cfolio,'LR','L');
    		$posy2=$pdf->GetY();
    		$posX2=$pdf->GetX();//posicion despues de escribir concepto
		
    		$dif_y = $posy2-$posy1;//obtengo alto de las siguientes celdas
		$pdf->SetY($posy1);
    		$pdf->SetX(24);//reposiciono Y y X despues del concepto, 10 de margen en x
    
    		$pdf->Cell(20,$dif_y,$fila->importe>0?number_format($fila->importe, 2, '.', ','):"",'R',0,'R');
    		$pdf->Cell(20,$dif_y,$fila->iva>0?number_format($fila->iva, 2, '.', ','):"",'R',0,'R');
    		$pdf->Cell(20,$dif_y,$fila->total>0?number_format($fila->total, 2, '.', ','):"",'R',0,'R');


		$pdf->SetTextColor(0,0,255);
		$pdf->SetFont('','U');
    		
		//$pdf->Cell(40,$dif_y,$fila->xml,'R',0,'R');
		
		if (strlen($fila->xml)>0){
    			$pdf->Cell(13,$dif_y,'','',0,'R');
    			$pdf->Cell(4,$dif_y,$pdf->Write(6,$fila->xml,"http://dc.tabascoweb.com/php/01/fe/files/".$fila->xml),'R',0,'R');
		}else{
    			$pdf->Cell(40,$dif_y,'','R',0,'R');
		}
		
		if (strlen($fila->pdf)>0){
    			$pdf->Cell(13.3,$dif_y,'','',0,'R');
    			$pdf->Cell(4,$dif_y,$pdf->Write(6,$fila->pdf,"http://dc.tabascoweb.com/php/01/fe/files/".$fila->pdf),'R',0,'R');
		}else{
    			$pdf->Cell(40,$dif_y,'','R',0,'R');
		}
		
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('','');
    			
    		$pdf->Cell(20,$dif_y,$fila->idcontrato." | ",'',0,'R');
		$pdf->SetTextColor(0,0,255);
		$pdf->SetFont('','U');
		
    		$pdf->Write(6,str_pad($fila->idcli,'6','0',STR_PAD_LEFT),"http://dc.tabascoweb.com/php/01/docs/account-status.php?idcli=".$fila->idcli);
    		$pdf->Cell(10.5,$dif_y,'','R',1,'L');
			
		$sumimp += $fila->importe;
		$sumiva += $fila->iva;
		$sumtot += $fila->total;
		
		$pdf->sumimp = $sumimp;
		$pdf->sumiva = $sumiva;
		$pdf->sumtot = $sumtot;
		
		if ($pdf->GetY()==250.00125){
			$pdf->AddPage();    
		}

    
}
            
    //subtotal y pagarè


mysql_free_result($result);
mysql_close($mysql);

    
	$pdf->Output("invoices-report.pdf","F");  //guardo en disco
	$pdf->Output();//muestro el pdf



?>