<?php

require('fpdf.php');           //para crear el pdf
require('numero_a_letra.php'); // funcion para convertir el total a letra
require_once('../vo/voConn.php');
require_once("../oFunctions.php");
$fecha   = $_POST["fecha"];

class PDF extends FPDF
{

	public $logo;
	public $fecha;
    //Encabezado de página
    function Header()
    {   
		$this->SetFillColor(64,64,64);
          $this->Image('imgs/logo_presente.gif',10,8,56);
		//$this->Image('imgs/back.jpg',57,85,100);
		
		//$this->Image('imgs/back2.jpg',57,86,150);
		//$this->Image('imgs/cedula_arji.jpg',10,192,39);
		//$this->Image($this->gif,10,172,39);
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(50,4,"",0,0,'C');
		$this->Cell(120,4,'SISTEMA INFORMATIVO DE TABASCO S.A DE C.V.',0,1,'L');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','B',0);
		$this->Cell(50,4,"",0,0,'C');
		$this->Cell(50,4,utf8_decode($this->fecha),0,1,'L');
		$this->SetFont('Arial','B',12);
		$this->Cell(50,4,"",0,0,'C');
		$this->Cell(50,4,"RECIBO DE PAGO",0,1,'L');
		$this->Cell(20,4,"Folio",0,1,'R');
		$this->Ln(8);
    } 
}

$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");
$result = mysql_query("select * from _viCorteCaja where fecha_cobro = '$fecha' and incluirencorte=1 ");

if (mysql_num_rows($result) <= 0) {echo "No existen datos en esa fecha "; return false;}

			
	$pdf=new PDF('P','mm','Letter');
	$pdf->fecha = $F->getDateLong($fecha);
	$pdf->AliasNbPages();
	$pdf->AddPage();    
	$pdf->Ln(4);
	

	
	
	//detalle de conceptos
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255,255,255);
     $pdf->Cell(14,6,'FOLIO',1,0,'C',true);
     $pdf->Cell(60,6,'CLIENTE',1,0,'C',true);
     $pdf->Cell(20,6,'EFECTIVO',1,0,'C',true);
     $pdf->Cell(20,6,'CHEQUE',1,0,'C',true);
     $pdf->Cell(20,6,"DEPOSITO",1,0,'C',true);
     $pdf->Cell(20,6,"ANTICIPO",1,0,'C',true);
     $pdf->Cell(40,6,"REFERENCIA",1,1,'C',true);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	
	
$sumEfe = 0;
$sumChe = 0;
$sumDep = 0;
$sumAnt = 0;

while ($fila = mysql_fetch_object($result)) {

		$posy1=$pdf->GetY();//posición antes de escribir concepto
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
    		$pdf->MultiCell(15,6,$fila->folio,'L','L');
    		$posy2=$pdf->GetY();
    		$posX2=$pdf->GetX();//posicion despues de escribir concepto
		
    		$dif_y = $posy2-$posy1;//obtengo alto de las siguientes celdas
		$pdf->SetY($posy1);
    		$pdf->SetX(24);//reposiciono Y y X despues del concepto, 10 de margen en x
    
    			$pdf->Cell(60,$dif_y,$fila->razon_social,'LR',0,'L');
    			$pdf->Cell(20,$dif_y,$fila->Efectivo!=0?number_format($fila->Efectivo, 2, '.', ','):"",'R',0,'R');
    			$pdf->Cell(20,$dif_y,$fila->Cheque!=0?number_format($fila->Cheque, 2, '.', ','):"",'R',0,'R');
    			$pdf->Cell(20,$dif_y,$fila->Deposito!=0?number_format($fila->Deposito, 2, '.', ','):"",'R',0,'R');
    			$pdf->Cell(20,$dif_y,$fila->Anticipo!=0?number_format($fila->Anticipo, 2, '.', ','):"",'R',0,'R');
			
			
    			$pdf->Cell(40,$dif_y,utf8_decode($fila->referencia),'R',1,'R');
			
			$sumEfe += $fila->Efectivo;
			$sumChe += $fila->Cheque;
			$sumDep += $fila->Deposito;
			$sumAnt += $fila->Anticipo;
			
    
}
mysql_free_result($result);
mysql_close($mysql);

	//$arConc = explode(';',$cadConc);
	/*
	foreach($arConc as $i=>$value){
		//$Item = explode('|',$arConc[$i]);
    		
		$posy1=$pdf->GetY();//posición antes de escribir concepto
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
    		$pdf->MultiCell(75,5,"\n ".utf8_decode($arConc[$i]["descripcion"]),'L','L');
    		$posy2=$pdf->GetY();
    		$posX2=$pdf->GetX();//posicion despues de escribir concepto
		
    		$dif_y = $posy2-$posy1;//obtengo alto de las siguientes celdas
		$pdf->SetY($posy1);
    		$pdf->SetX(85);//reposiciono Y y X despues del concepto, 10 de margen en x
		if ($view == 0){
    			$pdf->Cell(30,$dif_y,utf8_decode($arConc[$i]["medida"]),'L',0,'L');
    			$pdf->Cell(30,$dif_y,utf8_decode($arConc[$i]["cantidad"]),'L',0,'R');
    			$pdf->Cell(30,$dif_y,utf8_decode($arConc[$i]["pu"]),'L',0,'R');
    			$pdf->Cell(30,$dif_y,utf8_decode($arConc[$i]["importe"]),'LR',1,'R');
		}else{
    			$pdf->Cell(30,$dif_y,utf8_decode($arConc[$i]["medida"]),'L',0,'L');
    			$pdf->Cell(30,$dif_y,number_format($arConc[$i]["cantidad"], 2, '.', ','),'L',0,'R');
    			$pdf->Cell(30,$dif_y,number_format($arConc[$i]["pu"], 2, '.', ','),'L',0,'R');
    			$pdf->Cell(30,$dif_y,number_format($arConc[$i]["importe"], 2, '.', ','),'LR',1,'R');
		}

    		$posy1=$pdf->GetY();//posición antes de escribir concepto


	}
	*/
	
	//cerrar tabla de conceptos
    	//$h = 255-($pdf->GetY());
	$h = 4;
    	$pdf->Cell(14,$h," ",'LB',0,'C');
    	$pdf->Cell(60,$h," ",'LB',0,'C');
    	$pdf->Cell(20,$h," ",'LB',0,'C');
    	$pdf->Cell(20,$h," ",'LB',0,'C');
    	$pdf->Cell(20,$h," ",'LB',0,'C');
    	$pdf->Cell(20,$h," ",'LB',0,'C');
    	$pdf->Cell(40,$h," ",'LRB',1,'C');

	$pdf->Cell(50,4," ",0,1,'R',false);
    	$pdf->Cell(14,0," ",'0',0,'L',false);
    	$pdf->Cell(60,0,"TOTAL $ ",'0',0,'R',false);
    	$pdf->Cell(20,0,$sumEfe!=0?number_format($sumEfe, 2, '.', ','):"",'0',0,'R',false);
    	$pdf->Cell(20,0,$sumChe!=0?number_format($sumChe, 2, '.', ','):"",'0',0,'R',false);
    	$pdf->Cell(20,0,$sumDep!=0?number_format($sumDep, 2, '.', ','):"",'0',0,'R',false);
    	$pdf->Cell(20,0,$sumAnt!=0?number_format($sumAnt, 2, '.', ','):"",'0',0,'R',false);
    	$pdf->Cell(40,0," ",'0',1,'R',false);
            
    //subtotal y pagarè

	$pdf->Output("files/corte-caja-1.pdf","F");  //guardo en disco
	$pdf->Output();//muestro el pdf



?>