<?php
header("application/json; charset=utf-8");  
header("Cache-Control: no-cache"); 

$t    = $_POST['tipo'];
$c    = $_POST['celular'];
$l    = $_POST['idlocation'];
require_once("oCentura.php");
$f = oCentura::getInstance();
switch(intval($t)){
	case 0:
		$cel = trim(utf8_decode($c));
		$arg = " WHERE trim(celular) = '$cel' and image like ('%.jpg%') ";
		$ret = $f->getQuerys(5001,$arg);
		break;
	case 1:
		$arg = intval($l);
		$ret = $f->setSaveData(40,'',0,$arg,8);

		break;
}

$m = json_encode($ret);
echo $m;

 ?>