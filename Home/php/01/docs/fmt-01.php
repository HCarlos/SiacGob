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

$result = mysql_query("select * from _viDemanda where (fecha between '$fecha' and '$fecha') order by fecha, iddenuncia");



$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(false);

//$objPHPExcel = new PHPExcel();
//$objPHPExcel = $objReader->load("_rep-fac-1.xlsx");
//$objWorksheet = $objPHPExcel->getActiveSheet();

$objPHPExcel = $objReader->load("templates/_fmt-01.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //objeto de PHPExcel, para escribir en el excel

//echo "hola3";
//return false;

//$objPHPExcel->getActiveSheet()->setCellValue("C4", "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff));

$i=2;	
while ($fila = mysql_fetch_object($result)) {

$tel = $fila->tel1==""?$fila->cel1:";".$fila->cel1;
$objPHPExcel->getActiveSheet()->setCellValue("A".$i, $fila->iddenuncia);
$objPHPExcel->getActiveSheet()->setCellValue("B".$i, $F->getWith3LetterMonthH($fila->fecha));
$objPHPExcel->getActiveSheet()->setCellValue("C".$i, $fila->nombrec);
$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $fila->domc);
$objPHPExcel->getActiveSheet()->setCellValue("F".$i, $fila->localidad);
$objPHPExcel->getActiveSheet()->setCellValue("G".$i, $tel);
$objPHPExcel->getActiveSheet()->setCellValue("H".$i, $fila->email);
$objPHPExcel->getActiveSheet()->setCellValue("I".$i, $fila->producto);
$objPHPExcel->getActiveSheet()->setCellValue("J".$i, $fila->cantidad);
$objPHPExcel->getActiveSheet()->setCellValue("K".$i, $fila->medida);
$objPHPExcel->getActiveSheet()->setCellValue("L".$i, $fila->descripcion);
$objPHPExcel->getActiveSheet()->setCellValue("N".$i, $fila->grupo);
$objPHPExcel->getActiveSheet()->setCellValue("O".$i, $fila->origen);
$objPHPExcel->getActiveSheet()->setCellValue("P".$i, $fila->respuesta_dep);
$objPHPExcel->getActiveSheet()->setCellValue("Q".$i, $fila->status);
$objPHPExcel->getActiveSheet()->setCellValue("R".$i, $fila->prioridad);

++$i;
}
            
mysql_free_result($result);
mysql_close($mysql);
$ti=  '';//time();
$fileout= "_fmt-01".$ti.".xlsx";
$objWriter->save($fileout);//guardamos el archivo excel  

echo "Archivo generado con &eacute;xito, para abrir haga click <a href='http://dc.tabascoweb.com/php/01/docs/".$fileout."'>aqu&iacute;</a>"  

?>