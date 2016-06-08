<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Mexico_City');
set_include_path(get_include_path() . PATH_SEPARATOR . '../PHPExcel/Classes/');

require_once("../PHPExcel/Classes/PHPExcel.php");
require_once("../PHPExcel/Classes/PHPExcel/Reader/Excel2007.php");
require_once('../vo/voConn.php');
require_once("../oFunctions.php");

$arg = $_POST["data"];
parse_str($arg);


$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");

if ($prodgpo=="T"){			
	$result = mysql_query("select * from _viFacturasEncab where (fecha between '$fi' and '$ff') order by fecha, serie, idfactura");
}else{
	$result = mysql_query("select * from _viFacturasEncab where (fecha between '$fi' and '$ff') and serie = '$prodgpo' order by fecha, serie, idfactura");
}

$tiemp = "TODAS LAS SERIES";	
switch ($prodgpo){
	case "A":
	   $tiemp = "DIARIO PRESENTE (A)";
		break;
	case "B":
	   $tiemp = "EL SOL DEL SURESTE (B)";
		break;
	case "C":
	   $tiemp = "RADIO FÓRMULA (C)";
		break;
}



$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(false);

//$objPHPExcel = new PHPExcel();
//$objPHPExcel = $objReader->load("_rep-fac-1.xlsx");
//$objWorksheet = $objPHPExcel->getActiveSheet();

$objPHPExcel = $objReader->load("templates/_rep-fac-1.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //objeto de PHPExcel, para escribir en el excel

//echo "hola3";
//return false;

$objPHPExcel->getActiveSheet()->setCellValue("C4", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));

$i=10;	
while ($fila = mysql_fetch_object($result)) {

$lopcta = "";	
switch ($fila->serie){
	case "A":
	   $lopcta = "4101-";
		break;
	case "B":
	   $lopcta = "4101-";
		break;
	case "C":
	   $lopcta = "4102-";
		break;
}

$objPHPExcel->getActiveSheet()->setCellValue("C6", $tiemp);
$objPHPExcel->getActiveSheet()->setCellValue("I5", "Fecha de Impresión: ".$F->getWith3LetterMonthH(date('Y-m-d')));

$objPHPExcel->getActiveSheet()->setCellValue("A".$i, $fila->idfactura);
$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $fila->cfolio);
$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->razon_social);
$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $lopcta.$fila->cuenta);

$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->importe);
$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->iva);
$objPHPExcel->getActiveSheet()->setCellValue("J".$i, 0.00);
$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->total);
$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->fecha);
++$i;
$objPHPExcel->getActiveSheet()->insertNewRowBefore($i, 1);
}
            
mysql_free_result($result);
mysql_close($mysql);
$ti=  '';//time();
$fileout= "myfile-test".$ti.".xlsx";
$objWriter->save($fileout);//guardamos el archivo excel  

echo "Archivo generado con éxito, para abrir haga click <a href='http://dc.tabascoweb.com/php/01/docs/".$fileout."'>aqu&iacute;</a>"  

?>