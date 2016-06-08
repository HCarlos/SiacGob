<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");


require_once("oCentura.php");
$f = oCentura::getInstance();

$index    = $_POST['o'];
$var2     = $_POST['t'];
$cad      = $_POST['c'];
$proc     = $_POST['p'];
$from     = $_POST['from'];
$cantidad = $_POST['cantidad'];
$otros    = $_POST['s'];

$ret = array();
switch($index){
	case -3:
		switch($proc){
			case 0:
				$ret = $f->getDepAreaFromUser($cad);
				$ret[0]->iduser =$ret[0]; 
				$ret[0]->iddep =$ret[1]; 
				break;
		}
		break;
	case -2:
		$ret = $f->getPermissions($cad);
		break;
	case -1:
		switch($proc){
			case 0:
				$ret = $f->getDepFromUser($cad);
				$ret[0]->iduser =$ret[0]; 
				$ret[0]->iddep =$ret[1]; 
				break;
		}
		break;
	case 0:
	case 1:
	case 2:
	case 11:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
                    $res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
			case 3:
				$ret = $f->getQuerys($var2,$cad,0,0,0);
				if (count($ret) <= 0){
						$ret[0]->razon_social = "No se encontraron datos";
						$ret[0]->idcli  = -1;
						$ret[0]->tel1   = "";
						$ret[0]->cel1   = "";
						$ret[0]->email  = "";
				}
				break;
			case 4:
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				if (count($ret) <= 0){
						$ret[0]->razon_social = "No se encontraron datos";
						$ret[0]->idcli  = -1;
						$ret[0]->tel1   = "";
						$ret[0]->cel1   = "";
						$ret[0]->email  = "";
				}else{
					$xx = 0;
					if (intval($var2)==22) {
						$x = $f->getQuerys($var2,$cad,0,$from,$cantidad,array(),$otros,0);
						$xx = count($x);
					}
					foreach($ret as $i=>$value){
						$ret[$i]->registros = $xx;
					}
				}
				break;
		}
		break;
	case 3:
	case 4:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
                    $res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
			case 3:
				$ret = $f->getQuerys($var2,$cad,0,0,0);
				if (count($ret) <= 0){
						$ret[0]->producto = "No se encontraron datos";
						$ret[0]->idprod  = -1;
						$ret[0]->p_venta    = "";
						$ret[0]->unidades   = "";
						$ret[0]->grupo  = "";
				}
				break;
			case 4:
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				if (count($ret) <= 0){
						$ret[0]->producto = "No se encontraron datos";
						$ret[0]->idprod  = -1;
						$ret[0]->p_venta    = "";
						$ret[0]->unidades   = "";
						$ret[0]->grupo  = "";
				}
				break;
		}
		break;
	case 6:
	case 7:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
				//parse_str($_POST[$cad], $searcharray);
				//print_r($searcharray); // Only for print array
                    $res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
			case 3:
				$ret = $f->getQuerys($var2,$cad,0,0,0);
				break;
		}
		break;
	case 8:
	case 9:
	case 10:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
				//parse_str($_POST[$cad], $searcharray);
				//print_r($searcharray); // Only for print array
                    $res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
			case 3:
				$ret = $f->getQuerys($var2,$cad,0,0,0);
				
				if (count($ret) > 0){
					foreach($ret as $i=>$value){
						$arrareas  = $f->getCombo(-2,"",0,0,$ret[$i]->idper);
						$arrgrupos = $f->getCombo(-3,"",0,0,$ret[$i]->idper);
						require_once("oFunctions.php");
						$Q = oFunctions::getInstance();
						$ret[$i]->areas  = $Q->ArrayComboToString($arrareas); 
						$ret[$i]->grupos = $Q->ArrayComboToString($arrgrupos);
					}
				}else{
						$ret[0]->nombre_completo = "No se encontraron datos";
						$ret[0]->idper  = -1;
						$ret[0]->cel    = "";
						$ret[0]->mail   = "";
						$ret[0]->areas  = "";
						$ret[0]->grupos = "";
				}
				break;
		}
		break;
	case 20:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
				//parse_str($_POST[$cad], $searcharray);
				//print_r($searcharray); // Only for print array
                    $res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
			case 3:
				$ret = $f->getQuerys($var2,$cad,0,0,0);
				
				if (count($ret) <= 0){
						$ret[0]->cliente = "No se encontraron datos";
						$ret[0]->idcontrato  = -1;
						$ret[0]->total    = "";
						$ret[0]->fecha   = "";
						$ret[0]->guia  = "";
						$ret[0]->agente = "";
				}
				break;
		}
		break;
	case 30:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
				//parse_str($_POST[$cad], $searcharray);
				//print_r($searcharray); // Only for print array
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
			case 3:
			
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				
				if (count($ret) <= 0){
						$ret[0]->producto = "No se encontraron datos";
						$ret[0]->idcontrato  = -1;
						$ret[0]->precio_unitario    = "";
						$ret[0]->cantidad   = "";
						$ret[0]->importe  = "";
						$ret[0]->medida = "";
						$ret[0]->grupo = "";
				}
				break;
			case 4:
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				if (count($ret) <= 0){
				   $ret[0]->idcontrato  = -1;
				}
				break;
		}
		break;
	case 40:
		switch($proc){
			case 0:
			
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				//$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				$rt = explode(".",$res);
				if ($rt[0]=="OK"){
					if (intval($var2)==0){
				   		include("core/sendMail.php");
				   		sendMail($cad,$rt[1]);
					}
				}
				break;
			case 3:
			
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad,array(),$otros);
				
				if (count($ret) <= 0){
						$ret[0]->iddenuncia = "";
						$ret[0]->fecha_programada = "---16";
						$ret[0]->fecha_normal = "---";
						$ret[0]->grupo = "---";
						$ret[0]->status  = "---";
						$ret[0]->prioridad  = "---";
						$ret[0]->registros = 0;
				}else{
					$xx = 0;
					if (intval($var2)==13) {
						$x = $f->getQuerys($var2,$cad,0,$from,$cantidad,array(),$otros,0);
						$xx = count($x);
					}
					require_once("oFunctions.php");
					$Q = oFunctions::getInstance();
					foreach($ret as $i=>$value){
                           	$ret[$i]->fecha_normal     = $Q->getWith3LetterMonthH($ret[$i]->fecha);
						$fp = intval(substr($ret[$i]->fecha_dep,0,2));
                           	$ret[$i]->fecha_programada = $fp>0? $Q->getWith3LetterMonthH($ret[$i]->fecha_dep):"";
						$ret[$i]->registros = $xx;
					}
				}
				break;
			case 5:
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad,array(),$otros);
				break;
			case 6:
				require_once("oFunctions.php");
				$Q = oFunctions::getInstance();
                    $ret = $f->getQuerys($var2,$cad,0,$from,$cantidad,array(),$otros);
				if (count($ret) <= 0){
					$ret[0]->msg = "Registro no encontrado. ".$ret[0]->msg;
				}else{
					if (count($ret[0]->respuesta_dep)<=0){
						$ret[0]->msg = "Registro solicitado ".count($ret);
					}else{
						$fp = intval(substr($ret[0]->fecha_dep,0,2));
						$fp = $fp>0?"Fecha de Respuesta: ".$Q->getWith3LetterMonthH($ret[0]->fecha_dep):"";
						parse_str($cad);
						$xf = "No de Usuario: ".$idcli." <span style='width:10em; height:1em; display:inline-block;'> </span> Folio de la Solicitud: ".$folio."<br><br>"; 
						$sol= "<strong>SOLICITUD:</strong> <br>";
						$sol.=$ret[0]->descripcion."<br><br>";
						$res= "<strong>RESPUESTA:</strong> <br>";
						$ret[0]->msg = $xf.$sol.$res.$ret[0]->respuesta_dep."<br><br>".$fp;
					}
				}
				break;
			case 7:
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				$rt = explode(".",$res);
				if ($rt[0]=="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = sol_env_int($rt[1]);
				}
				break;
			case 8:
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				$camp = explode(".",$ret[0]->msg);
				break;
				
		}
		break;
	case 41:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
                    $res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				break;
		}
		break;
		
	case 50:
		switch($proc){
			case 0:
			
				$ret = $f->getCombo($index,$cad,0,0,$var2);
				break;
			case 1:
				//$ret[0]->msg = $f->setAsocia($index,$cad,0,0,$var2);
				break;
			case 2:
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				
				$ret[0]->msg = $res;
				$camp = explode(".",$ret[0]->msg);
				/*
				if ($camp[0]!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				*/
				break;
			case 3:
			
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				
				if (count($ret) <= 0){
						$ret[0]->serie = "No se encontraron datos";
						$ret[0]->folio = "1";
						$ret[0]->fecha  = "";
						$ret[0]->importe    = 0;
						$ret[0]->descuento   = 0;
						$ret[0]->iva  = 0;
						$ret[0]->total = 0;
				}
				break;
			case 4:
				
				$ret = $f->getQuerys($var2,(get_magic_quotes_gpc()) ? stripslashes($cad) : $cad,0,$from,$cantidad);
				if (count($ret) <= 0){
				   $ret[0]->idcontrato  = -1;
				   $ret[0]->referencia  = "Elemento no encontrado";
				   parse_str($cad);
				   $ret2 = $f->getQuerys(3," where idcli = $idcli ",0,$from,$cantidad);
				   if (count($ret2) <= 0){
					   $ret[0]->idcli = -1;
					   $ret[0]->idcontrato = 0;
				   }else{
	 					$ret[0]->idmovto = 0;
						$ret[0]->idcli = $ret2[0]->idcli;
	 					$ret[0]->idfactura = 0;
	 					$ret[0]->idingreso = 0;
	 					$ret[0]->fecha = 0;
	 					$ret[0]->dfecha = 0;
	 					$ret[0]->cargo = 0;
	 					$ret[0]->abono = 0;
	 					$ret[0]->tipo = 0;
	 					$ret[0]->id = 0;
	 					$ret[0]->tipoi = 0;
	 					$ret[0]->referencia ='';
	 					$ret[0]->razon_social = '';
	 					$ret[0]->saldo = 0;
	 					$ret[0]->anticipos = 0; 
	 					$ret[0]->total_abono = 0;
	 					$ret[0]->fecha_total_pagado = '';
	 					$ret[0]->dfecha_abono = '';
	 					$ret[0]->idcontrato = 0;
	 					$ret[0]->referfac = '';
	 					$ret[0]->total_factura = 0;
	 					$ret[0]->status = 0;
	 					$ret[0]->tipo_pago = 0;
					   
				   }
				}
				
				/*
				$str = $from >= 0 ? " limit $from, $cantidad " : "";
				$query = "SELECT * FROM _viMovimientos ".(get_magic_quotes_gpc()) ? stripslashes($cad) : $cad.$str;
				$ret[0]->referencia = $query;
				*/
				break;
		}
		break;
	case 60:
	case 70:
		switch($proc){
			case 2:
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				if (trim($res)!="OK"){
					require_once('core/messages.php');
					$ret[0]->msg = error_message_html(array($res));
				}
				
				break;
			case 4:
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				if (count($ret) <= 0){
						$ret[0]->producto = "No se encontraron datos...";
						$ret[0]->idcontrato  = -1;
						$ret[0]->precio_unitario    = "";
						$ret[0]->cantidad   = "";
						$ret[0]->importe  = "";
						$ret[0]->medida = "";
						$ret[0]->grupo = "";
						
						
						
// INICIA Quitar esto

					$ret[0]->idcontratoesqval=1;
					$ret[0]->codigo = "200,150;0,0;1;IMG_2465.jpg";

					$ret[1]->idcontratoesqval=2;
					$ret[1]->codigo = "200,150;0,0;3;firma_logydes.jpg";

					if ($index==60){
						
						parse_str($cad);
						
						$j = 0;
						//foreach($ret as $i=>$valor){
							//if(intval($ret[$i]->esquemado)==1){
				
								//$ret[0]->idcontratoesqval=1;
								//$ret[0]->codigo = "200,150;0,0";

								$filejason = array();
								foreach($ret as $i=>$value){
									$filejason[$j]=array("id"=>$ret[$i]->idcontratoesqval,"codigo"=>$ret[$i]->codigo);
									++$j;
								}
								$fl = json_encode($filejason);
								$ourFileName = "../../files/esqval-".$fecha.".json";

								$create_file = fopen($ourFileName, "w+"); //create the new file
								if (fwrite($create_file, $fl) === FALSE) { }
								
							//}
						//}
					}



// FINALIZA Quitar esto						
						
						
						
				}else{
				
					if ($index==60){
						
					$ret[0]->idcontratoesqval=1;
					$ret[0]->codigo = "200,150;0,0";
						parse_str($cad);
						
						$j = 0;
						foreach($ret as $i=>$valor){
							if(intval($ret[$i]->esquemado)==1){
				
								$filejason = array();
								foreach($ret as $i=>$value){
									$filejason[$j]=array("id"=>$ret[$i]->idcontratoesqval,"codigo"=>$ret[$i]->codigo);
								}
								$fl = json_encode($filejason);
								$ourFileName = "../../files/esqval-".$fecha.".json";

								$create_file = fopen($ourFileName, "w+"); //create the new file
								if (fwrite($create_file, $fl) === FALSE) { }
								++$j;
							}
						}
					}

				}
				
				
				break;
		}
		break;
	case 200:
		switch($proc){
			case 0:
				$ret = $f->getCombo($index, $cad,0,0,$var2);
				break;
			case 1:
				$ret = $f->getQuerys($var2,$cad,0,$from,$cantidad);
				break;
			case 2:
				$ret = $f->getCombo($index, $cad,0,0,$var2);
				break;
			case 3:
				$res = $f->setSaveData($index,$cad,0,0,$var2);
				$ret[0]->msg = $res;
				$camp = explode(".",$ret[0]->msg);
				break;
		}
		break;
		
}
$m = json_encode($ret);
echo $m;
?>
