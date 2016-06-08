<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

require_once("oCentura.php");
$f = oCentura::getInstance();

$u   = $_POST['u'];
$p   = $_POST['p'];
$arg = $u.".".$p;
$ret = array();
$ret = $f->getCombo(-1,$arg,0,0);
if (count($ret)>0){
	$ret[0]->data = $ret[0]->data.'|'.$u.'|'.$p;
	$ret[0]->url = $f->URL."dashboard/";
}
$m = json_encode($ret);
echo $m;
?>
