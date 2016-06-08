<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

require_once("oCentura.php");
$f = oCentura::getInstance();
$us   = $_POST['username'];
$ps   = $_POST['password'];

$arg = "username=$us&password=$ps";
$res = $f->getCombo(1000,$arg,0,0,0);
$ret = array();
if (count($res)>0){
	$ret[0]->msg = "OK";
}else{
	$ret[0]->msg = "Username o Password incorrectos. ".count($res)." US ".$us." PW ".$ps;
}
$m = json_encode($ret);
echo $m;

?>
