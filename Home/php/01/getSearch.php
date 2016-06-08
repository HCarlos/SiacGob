<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");


require_once("oSearch.php");
$f = oSearch::getInstance();

$index = $_GET['o'];
$obj   = $_GET['s'];
$type  = $_GET['t'];
$cad   = $_GET['term'];

if (!isset($type)){
	$type=0;
}

$ret = $f->getData($index,trim($cad), $obj, $type );

$m = json_encode($ret);

echo $m;
?>
