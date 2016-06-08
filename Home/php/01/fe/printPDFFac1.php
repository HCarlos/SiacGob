<?php

require('fpdf.php');           //para crear el pdf
require('numero_a_letra.php'); // funcion para convertir el total a letra


class PDF extends FPDF
{

    	public $gif;
    	public $serie;
    	public $folio;
    	public $folSer;
	public $rfc_emisor;
	public $razon_social_emisor;
	public $calle_emisor;
	public $num_exterior_emisor;
	public $num_interior_emisor;
	public $colonia_emisor;
	public $municipio_emisor;
	public $estado_emisor;
	public $codigo_postal_emisor;
	public $pais_emisor;
	public $regimen_fiscal = 'Personas Morales con fines no Lucrativos';
	public $logo;
	public $rgb;
	public $idcontrato;
	public $idcli;
	public $cuenta;
	public $idper;
    //Encabezado de página
    function Header()
    {   
		$this->SetFillColor($this->rgb[0],$this->rgb[1],$this->rgb[2]);
          $this->Image($this->logo,10,8,56);
		$this->Image('imgs/back.jpg',57,85,100);
		
		//$this->Image('imgs/back2.jpg',57,86,150);
		//$this->Image('imgs/cedula_arji.jpg',10,192,39);
		$this->Image($this->gif,10,172,39);
		$this->SetFont('Arial','B',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(50,4,"",0,0,'C');
		$this->Cell(120,4,utf8_decode($this->razon_social_emisor),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->SetTextColor(255,255,255);
		$this->Cell(25,4,"FACTURA",1,1,'C',true);
		$this->SetFont('Arial','B',9);
		$this->SetTextColor(0,0,0);
		$this->Cell(50,4,"",0,0,'C');
		$this->Cell(120,4,utf8_decode($this->rfc_emisor),0,0,'L');
		$this->SetFont('Arial','',8);
		$this->SetTextColor(0,0,0);
		/*$this->Cell(25,4,"Serie: ".$this->serie,1,0,'C')*/; 
		$this->Cell(25,4,$this->folSer,1,1,'C');
		$this->SetFont('Arial','B',8);
		$this->Cell(50,4,"",0,0,'L');
		$this->Cell(120,4,utf8_decode($this->calle_emisor." ".$this->num_exterior_emisor." ".$this->colonia_emisor),0,1,'L');
		$this->Cell(50,4,"",0,0,'L');
		$this->Cell(120,4,utf8_decode($this->municipio_emisor." ".$this->codigo_postal_emisor),0,1,'L');
		$this->Ln(4);
    } 
}
			
	$pdf=new PDF('P','mm','Letter');
	$pdf->folio                = $folio;
	$pdf->serie                = $serie;
	$pdf->rfc_emisor           = $rfc_emisor;
	$pdf->razon_social_emisor  = $razon_social_emisor;
	$pdf->calle_emisor         = $calle_emisor;
	$pdf->num_exterior_emisor  = $num_exterior_emisor;
	$pdf->num_interior_emisor  = $num_interior_emisor;
	$pdf->colonia_emisor       = $colonia_emisor;
	$pdf->municipio_emisor     = $municipio_emisor;
	$pdf->estado_emisor        = $estado_emisor;
	$pdf->codigo_postal_emisor = $codigo_postal_emisor;
	$pdf->pais_emisor          = $pais_emisor;
	$pdf->folSer               = $folSer;
	$pdf->logo                 = $logo;
	$pdf->gif                  = $gif;
	$pdf->rgb                  = $rgb;
	$pdf->idcontrato           = $idcontrato;
	$pdf->idcli                = $idcli;
	$pdf->cuenta               = $CuentaQi;
	$pdf->idper                = $idper;
	$pdf->AliasNbPages();
	$pdf->AddPage();    
	$pdf->Ln(7);

	$pdf->SetFillColor($rgb[0],$rgb[1],$rgb[2]);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(135,4,"CLIENTE",1,0,'C',true);
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	
	//datos del cliente y datos del CFD
	$pdf->Cell(59,4,utf8_decode("Lugar de Expedición: Villahermosa, Tabasco"),"LRT",1,'L');
	$pdf->Cell(135,4,utf8_decode($razon_social),"LR",0,'L');
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,utf8_decode("Fecha: $fecha"),"LR",1,'L');
	$pdf->Cell(135,4,"RFC: ".$rfc,"LR",0,'L');
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,utf8_decode("Certificado: $num_certificado"),"LR",1,'L');
	$pdf->Cell(135,4,utf8_decode("$calle $num_exterior $num_interior, Col. $colonia, $localidad"),"LR",0,'L');
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,utf8_decode("Aprobación: $aprobacion   Año: $year_aprobacion"),"LR",1,'L');
	$pdf->Cell(135,4,utf8_decode("$municipio, $estado, $pais CP.$codigo_postal"),"LBR",0,'L');
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,"","LRB",1,'L');
    
	$pdf->Ln(5);
	
	$pdf->Cell(135,4,utf8_decode('Régimen Fiscal: '.$regimen_fiscal),'TLR',0,'L',false);
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,utf8_decode("Contrato Núm:  ").$idcontrato,"LRT",1,'L');

	$pdf->Cell(135,4,utf8_decode('Forma de  pago: '.$forma_pago),'LR',0,'L',false);
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,utf8_decode('Cliente Núm: ').$idcli.', IdAge: '.$idper,'LR',1,'L');

	$pdf->Cell(135,4,utf8_decode('Método de pago: '.$metodo_pago.' '.$referencia),'RLB',0,'L',false);
	$pdf->Cell(1,4,"",0,0,'C');
	$pdf->Cell(59,4,utf8_decode("Cuenta: ").$CuentaQi,"LRB",1,'L');
			
	
	//detalle de conceptos
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255,255,255);
     $pdf->Cell(75,5,utf8_decode('DESCRIPCIÓN'),1,0,'C',true);
     $pdf->Cell(30,5,'UNIDAD',1,0,'C',true);
     $pdf->Cell(30,5,'CANTIDAD',1,0,'C',true);
     $pdf->Cell(30,5,"PRECIO UNITARIO",1,0,'C',true);
     $pdf->Cell(30,5,"IMPORTE",1,1,'C',true);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);

/*
	$descuento=0;
	$subtotal = $tot;
	$subtotal2 = $tot;
	$iva = 0;
	$iva*$subtotal2;
	$total = $tot;
	$subtotal2 + $iva;
*/ 
	//$arConc = explode(';',$cadConc);
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
	
	//cerrar tabla de conceptos
    	$h = 170-($pdf->GetY());
    	$pdf->Cell(75,$h," ",'LB',0,'C');
    	$pdf->Cell(30,$h," ",'LB',0,'C');
    	$pdf->Cell(30,$h," ",'LB',0,'C');
    	$pdf->Cell(30,$h," ",'LB',0,'C');
    	$pdf->Cell(30,$h," ",'LRB',1,'C');
            
    //subtotal y pagarè
	$pdf->SetFont('Arial','',6);
    	$pdf->Cell(42,4," ",0,0,'L');
    	$pdf->Cell(93,4,utf8_decode("Debo y pagaré a la orden de $razon_social_emisor "),0,0,'L');
	$pdf->SetFont('Arial','',8); $pdf->Cell(30,5,"Subtotal: ",0,0,'R');
    	$pdf->Cell(30,4,"$".number_format($subtotal, 2, '.', ','),0,1,'C');

    //descuento 
    	$pdf->SetFont('Arial','',6);
	$pdf->Cell(42,4," ",0,0,'L');
    	$pdf->Cell(93,4,utf8_decode("en cualquier plaza donde se requiera el pago de la cantidad consignada"),0,0,'L');
    	$pdf->SetFont('Arial','',8); $pdf->Cell(30,4,"Descuento: ",0,0,'R');
    	$pdf->Cell(30,4,"$".number_format($descuento, 2, '.', ','),0,1,'C');

    //subtotal 2
    	$pdf->SetFont('Arial','',6);
	$pdf->Cell(42,4," ",0,0,'L');
    	$pdf->Cell(93,4,utf8_decode("en éste título de credito, en un plazo no mayor a $dias_credito dias a partir del $fecha"),0,0,'L');
    	$pdf->SetFont('Arial','',8); $pdf->Cell(30,4,"Subtotal: ",0,0,'R');
    	$pdf->Cell(30,4,"$".number_format($subtotal2, 2, '.', ','),0,1,'C');

    //IVA y ejecutivo
    	$pdf->Cell(165,4,"IVA: 16% ",0,0,'R');
    	$pdf->Cell(30,4,"$".number_format($iva, 2, '.', ','),0,1,'C');

    //cantidad con letra y total
    	$letras=utf8_decode(num2letras($total,0,0)." pesos  ");
	$total_cadena=$total;
	$total = "$".number_format($total, 2, '.', ',');
	$ultimo = substr (strrchr ($total, "."), 1 ); //recupero lo que este despues del decimal
	$letras = $letras." ".$ultimo."/100 M. N.";
			
	$pdf->SetFont('Arial','',6);
    	$pdf->Cell(35,4,"",0,0,'R');
	$pdf->Cell(100,4,"______________________________________",0,0,'C');
			
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(30,4,"Total: ",0,0,'R');
    	$pdf->Cell(30,4,$total,0,1,'C');
			
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(35,4,"",0,0,'R');
	$pdf->Cell(100,4,"Firma",0,1,'C');
			
	//$pdf->Ln(3);$pdf->SetFont('Arial','B',8);
	//$pdf->Cell(35,4,"",0,0,'R');
	//$pdf->Cell(160,4,"Importe en letra: ".$letras,0,1,'C');
	$pdf->Ln(2);$pdf->SetFont('Arial','B',8);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->Cell(0,3,"Importe en letra: ".$letras,0,'L');
	$pdf->Ln(3);	

	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode("Cadena Original"),0,'L');
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode($cadena),0,'L');
	$pdf->Ln(1);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode("Sello Digital"),0,'L');
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode($sello),0,'L');
	$pdf->Ln(1);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode("Folio Fiscal"),0,'L');
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode($folfis),0,'L');
	$pdf->Ln(1);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(42,3,"",0,0,'C');
	$pdf->MultiCell(0,3,utf8_decode('Este documento es una representación impresa de un CFDi'),0,'L');

	$pdf->Output("files/Fac-".$folSer.".pdf","F");  //guardo en disco
	$pdf->Output();//muestro el pdf



?>