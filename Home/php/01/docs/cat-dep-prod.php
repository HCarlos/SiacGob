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
$v = $_POST["v"];
$opt = intval($v);
parse_str($arg);

$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(false);

$fileout= "cat-dep-prod-1.xlsx";
$query = "Select distinct idprodgpo,grupo from _viDemanda where idprodgpo = $dependencia order by idgrupo asc, grupo asc";

$result = mysql_query($query);

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //objeto de PHPExcel, para escribir en el excel
$objWriter->setIncludeCharts(TRUE);
include("rep2php.php");

cat_dep_prod_1($objPHPExcel,$result,$F,$dependencia);
            
$objWriter->save($fileout);//guardamos el archivo excel  

include("-rep-2.php");


?>


