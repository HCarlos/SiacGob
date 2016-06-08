<?php 

function cat_dep_prod_1($objPHPExcel,$result,$F,$iddep){

	$i=8;$k=0;	
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->producto);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$iddep==0?"CATALOGO DE SERVICIOS POR DEPENDENCIA ":"CATALOGO DE SERVICIOS DE '".utf8_decode($fila->grupo)."'";
	}
	$j = $i+3;
	$objPHPExcel->getActiveSheet()->setCellValue("C3", $title);
	$objPHPExcel->getActiveSheet()->setCellValue("B5", $F->getWith3LetterMonthH(date('Y-m-d H:i:s')));
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
}

function get_rep_1($objPHPExcel,$result,$fi, $ff,$F){
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d H:i:s')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=8;$k=0;
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, $fila->idprodgpo);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->dependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->sumid);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->verificado);
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->no_procede);
		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->otrasdep);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->tramite);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->atendidos);
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->resuelto);
		++$i;
		
	}
	
}

function get_rep_esp($objPHPExcel,$result,$fi, $ff,$F,$iddep,$msg){
	echo "En Proceso...";
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d H:i:s')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, date('d-m-Y',strtotime($fila->fecha)));
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->origen);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->cfolio);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->nombrec." (".$fila->idcli.")");
		
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->tel1);
		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->cel1);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->email);

		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->domc);
		
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->calle2);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->colonia2);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->ciudad2);

		$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->descripcion);
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->observaciones);
		$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->status);
		$objPHPExcel->getActiveSheet()->setCellValue("P".$i, date('d-m-Y',strtotime($fila->fecha_dep)));
		$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, intval(substr($fila->fexecdep,0,2))>0?date('d-m-Y',strtotime($fila->fexecdep)):'');
		$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->areadep);
		$objPHPExcel->getActiveSheet()->setCellValue("S".$i, $fila->respuesta_dep);
		$objPHPExcel->getActiveSheet()->setCellValue("T".$i, $fila->iddenuncia);
		$objPHPExcel->getActiveSheet()->setCellValue("U".$i, $fila->iddependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("V".$i, $fila->idareadep);
		$objPHPExcel->getActiveSheet()->setCellValue("W".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("X".$i, $fila->producto);
		$objPHPExcel->getActiveSheet()->setCellValue("Y".$i, $fila->colonia);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$iddep==0?"SERVICIOS SOLICITADOS ":"SERVICIOS SOLICITADOS A '".utf8_decode($fila->grupo)."'";
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("E3", $title." POR ".$msg);
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	echo "Reporte Finalizado...";
	
}

function get_rep_esp2($objPHPExcel,$result,$fi, $ff,$F,$iddep){
	$objPHPExcel->getActiveSheet()->setCellValue("E1", $F->getWith3LetterMonthH(date('Y-m-d H:i:s')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	$nCant = 0;
	$ntram = 0;
	$naten = 0;
	$nopro = 0;
	$notra = 0;
	$nover = 0;
	$nores = 0;
	while ($fila = mysql_fetch_object($result)) {
		if (intval($fila->idprod)>0){
		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->areadep);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->producto);
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->cantidad);
		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->atendidos);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->verificado);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->no_procede);
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->otrasdep);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->tramite);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->resuelto);

		$nCant = $nCant + $fila->cantidad;
		$ntram = $ntram + $fila->tramite;
		$naten = $naten + $fila->atendidos;
		$nopro = $nopro + $fila->no_procede;
		$notra = $notra + $fila->otrasdep;
		$nover = $nover + $fila->verificado;
		$nores = $nores + $fila->resuelto;

		
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$iddep==0?"SERVICIOS SOLICITADOS ":"SERVICIOS SOLICITADOS A '".utf8_decode($fila->grupo)."'";
		}
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	$objPHPExcel->getActiveSheet()->setCellValue("E".$j, $nCant);
	$objPHPExcel->getActiveSheet()->setCellValue("F".$j, $naten);
	$objPHPExcel->getActiveSheet()->setCellValue("G".$j, $nover);
	$objPHPExcel->getActiveSheet()->setCellValue("H".$j, $nopro);
	$objPHPExcel->getActiveSheet()->setCellValue("I".$j, $notra);
	$objPHPExcel->getActiveSheet()->setCellValue("J".$j, $ntram);
	$objPHPExcel->getActiveSheet()->setCellValue("K".$j, $nores);
}



function get_rep_2($objPHPExcel,$result,$fi, $ff,$F,$iddep){
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, date('d-m-Y',strtotime($fila->fecha)));
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->origen);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->cfolio);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->nombrec." (".$fila->idcli.")");
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->domc);

		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->calle2);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->colonia2);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->ciudad2);
		

		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->descripcion);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->observaciones);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->status);
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i, date('d-m-Y',strtotime($fila->fecha_dep)));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->respuesta_dep);
		$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->iddenuncia);
		$objPHPExcel->getActiveSheet()->setCellValue("P".$i, $fila->iddependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, $fila->idareadep);
		$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("S".$i, $fila->producto);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$iddep==0?"SERVICIOS SOLICITADOS ":"SERVICIOS SOLICITADOS A '".utf8_decode($fila->grupo)."'";
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("E3", $title);
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	
}

function get_rep_3($objPHPExcel,$result,$fi, $ff,$F,$iddep){
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, date('d-m-Y',strtotime($fila->fecha)));
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->origen);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->cfolio);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->nombrec." (".$fila->idcli.")");
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->domc);

		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->calle2);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->colonia2);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->ciudad2);

		
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->descripcion);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->observaciones);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->status);
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i, date('d-m-Y',strtotime($fila->fecha_dep)));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->respuesta_dep);
		$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->iddenuncia);
		$objPHPExcel->getActiveSheet()->setCellValue("P".$i, $fila->iddependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, $fila->idareadep);
		$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("S".$i, $fila->producto);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$iddep==0?"SERVICIOS SOLICITADOS":"SERVICIOS SOLICITADOS A '".utf8_decode($fila->grupo)."' CON STATUS DE '".strtoupper($fila->status)."'";
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("E3", $title);
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	
}


function get_rep_4($objPHPExcel,$result,$fi, $ff,$F,$origen){
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, date('d-m-Y',strtotime($fila->fecha)));
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->origen);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->cfolio);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->nombrec." (".$fila->idcli.")");
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->domc);
		
		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->calle2);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->colonia2);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->ciudad2);

		
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->descripcion);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->observaciones);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->status);
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i, date('d-m-Y',strtotime($fila->fecha_dep)));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->respuesta_dep);
		$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->iddenuncia);
		$objPHPExcel->getActiveSheet()->setCellValue("P".$i, $fila->iddependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, $fila->idareadep);
		$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("S".$i, $fila->producto);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$origen==0?"SERVICIOS SOLICITADOS :: TODOS LOS 'MEDIOS DE CAPTACION'":"SOLICITUDES CAPTADAS EN '".strtoupper($fila->origen)."'";
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("E3", $title);
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	
}

function get_rep_5($objPHPExcel,$result,$fi, $ff,$F,$status){
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, date('d-m-Y',strtotime($fila->fecha)));
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->origen);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->cfolio);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->nombrec." (".$fila->idcli.")");
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->domc);
	
		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->calle2);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->colonia2);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->ciudad2);
	
		
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->descripcion);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->observaciones);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->status);
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i, date('d-m-Y',strtotime($fila->fecha_dep)));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->respuesta_dep);
		$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->iddenuncia);
		$objPHPExcel->getActiveSheet()->setCellValue("P".$i, $fila->iddependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, $fila->idareadep);
		$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("S".$i, $fila->producto);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$status==0?"SERVICIOS SOLICITADOS :: TODOS LOS STATUS":"SOLICITUDES CON STATUS '".strtoupper($fila->status)."'";
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("E3", $title);
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	
}

function get_rep_6($objPHPExcel,$result,$fi, $ff,$F,$prioridad){
	$objPHPExcel->getActiveSheet()->setCellValue("I1", $F->getWith3LetterMonthH(date('Y-m-d')));
	$objPHPExcel->getActiveSheet()->setCellValue("C5", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));
	$i=9;$k=0;	
	$title="";
	//$row = mysql_fetch_row($result);
	while ($fila = mysql_fetch_object($result)) {

		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, date('d-m-Y',strtotime($fila->fecha)));
		$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->origen);
		$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->cfolio);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->nombrec." (".$fila->idcli.")");
		$objPHPExcel->getActiveSheet()->setCellValue("E".$i, $fila->domc);
		
		$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->calle2);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $fila->colonia2);
		$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->ciudad2);
		

		
		$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->descripcion);
		$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->grupo);
		$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->observaciones);
		$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->status);
		$objPHPExcel->getActiveSheet()->setCellValue("M".$i, date('d-m-Y',strtotime($fila->fecha_dep)));
		$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->respuesta_dep);
		$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->iddenuncia);
		$objPHPExcel->getActiveSheet()->setCellValue("P".$i, $fila->iddependencia);
		$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, $fila->idareadep);
		$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->idprod);
		$objPHPExcel->getActiveSheet()->setCellValue("S".$i, $fila->producto);
		++$i;++$k;
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
		$title=$prioridad==0?"SERVICIOS SOLICITADOS :: TODOS LAS 'PRIORIDADES'":"SOLICITUDES CON PRORIDAD '".strtoupper($fila->prioridad)."'";
	}
	$j = $i+2;
	$objPHPExcel->getActiveSheet()->setCellValue("E3", $title);
	$objPHPExcel->getActiveSheet()->setCellValue("B".$j, $k);
	
}

?>
