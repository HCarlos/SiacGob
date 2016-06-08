<?php

require('../fe/fpdf.php');           //para crear el pdf
require_once('../vo/voConn.php');
require_once("../oFunctions.php");


if (isset($_POST["idcli"])){
	$idcli = $_POST["idcli"];
	$finit = $_POST["finit"];
	$ffin  = $_POST["ffin"];
}else{
	if (isset($_GET["idcli"])){
		$idcli = $_GET["idcli"];
	}else{
    		echo "Acceso Denegado."; 
    		return false; 
	}
}

class PDF extends FPDF
{

	public $logo;
	public $fecha;
	public $iding;
	public $cfilter;
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
		$this->Cell(120,4,'SISTEMA INFORMATIVO DE TABASCO S.A DE C.V.'.$type,0,1,'L');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',0);
		$this->Cell(25,5,utf8_decode(" "),0,0,'C');
		$this->Cell(50,4,utf8_decode($this->fecha),0,1,'L');
		$this->SetFont('Arial','B',12);
		$this->Cell(25,10,"",0,0,'C');
		$this->Cell(70,6,"ESTADO DE CUENTA",0,0,'L');
		$this->SetFont('Arial','',10);
		$this->Cell(100,6,utf8_decode($this->cfilter),0,1,'R');
		$this->Ln(8);
    } 
}


$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");
$result = mysql_query("select razon_social from _viClientes where idcli = $idcli limit 1 ");

			
	$pdf=new PDF('P','mm','Letter');
	$pdf->fecha = $F->getDateLong(date('Y-m-d'));
	$pdf->iding = $iding;
	$pdf->cfilter = mysql_result($result, 0,"razon_social");
	$pdf->AliasNbPages();
	$pdf->AddPage();    
	$pdf->Ln(4);
	

	
	
	//detalle de conceptos
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255,255,255);
     $pdf->Cell(18,6,'FECHA',1,0,'C',true);
     $pdf->Cell(20,6,'CARGO',1,0,'C',true);
     $pdf->Cell(20,6,'ABONO',1,0,'C',true);
     $pdf->Cell(20,6,'SALDO',1,0,'C',true);
     $pdf->Cell(60,6,'REFERENCIA',1,1,'C',true);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);

$sumimp = 0;
$sumiva = 0;
$sumtot = 0;
/*
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
*/
$saldo = 0;
$sumabono = 0;
$sumcargo = 0;
$result = mysql_query("select * from _viMovimientos where idcli = $idcli order by idmovto ");
if (mysql_num_rows($result) <= 0) {echo "No existen datos ".$iding; return false;}
while ($fila = mysql_fetch_object($result)) {

		$posy1=$pdf->GetY();//posición antes de escribir concepto
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
    		$pdf->MultiCell(18,6,$fila->dfecha,'LR','L');
    		$posy2=$pdf->GetY();
    		$posX2=$pdf->GetX();//posicion despues de escribir concepto
		
    		$dif_y = $posy2-$posy1;//obtengo alto de las siguientes celdas
		$pdf->SetY($posy1);
    		$pdf->SetX(24);//reposiciono Y y X despues del concepto, 10 de margen en x
          
		
		$cargo = $fila->cargo; 
          if ($fila->tipo==1){
		   $ref = $fila->folio;
		   $saldo += ($cargo-$fila->abono); 
		}else{
		   if ($fila->tipoi==7){
			  $ref = "Ant Apl (".$fila->folio.") ".$fila->referencia;
			  //$saldo += $fila->abono; 
		   }else{
			     $sAnt=$fila->folio!=""?"  (".$fila->folio.") ":" - ";
		   		$ref = $fila->tipo_pago.$sAnt.$fila->referencia;
		  		 $saldo += ($cargo-$fila->abono); 
		   }
		}
		
		
    		$pdf->Cell(24,$dif_y,$cargo!=0?number_format($cargo, 2, '.', ','):"",'R',0,'R');
    		$pdf->Cell(20,$dif_y,$fila->abono!=0?number_format($fila->abono, 2, '.', ','):"",'R',0,'R');
          
    		$pdf->Cell(20,$dif_y,$saldo!=0?number_format($saldo, 2, '.', ','):"",'R',0,'R');
    			
    		$pdf->Cell(60,$dif_y,$ref,'LR',1,'C');
			
		$sumcargo += $fila->cargo;
		$sumabono += $fila->tipoi!=7?$fila->abono:0;
    
}

	//cerrar tabla de conceptos
    	//$h = 255-($pdf->GetY());
	$h = 4;
    	$pdf->Cell(18,$h," ",'LRBT',0,'C');

	$pdf->Cell(20,$h,$sumcargo>0?number_format($sumcargo, 2, '.', ','):"",'RBT',0,'R');
    	$pdf->Cell(20,$h,$sumabono>0?number_format($sumabono, 2, '.', ','):"",'RBT',0,'R');
    	$pdf->Cell(20,$h,number_format($saldo, 2, '.', ','),'RBT',0,'R');
    	
    	$pdf->Cell(60,$h," ",'RBT',1,'R',false);
            
    //subtotal y pagarè


mysql_free_result($result);
mysql_close($mysql);

    
	$pdf->Output("account-status.pdf","F");  //guardo en disco
	$pdf->Output();//muestro el pdf



?>