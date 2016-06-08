<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

require_once("oCentura.php");
$f = oCentura::getInstance();
$us   = $_POST['username'];
$ps   = $_POST['password'];
$u    = $_POST['nombre'];
$t    = $_POST['celular'];
$i    = $_POST['idF'];
$la   = $_POST['latitud'];
$lo   = $_POST['longitud'];
$ms   = $_POST['message'];

$arg = "username=$us&password=$ps&nombre=$u&celular=$t&idF=$i&latitud=$la&longitud=$lo&message=$ms";
$res = $f->setSaveData(40,$arg,0,0,100);
if ($res=="OK"){
	require_once("core/sendMailMobile1.php");
	sendMail($us);
}

$ret = array();
$ret[0]->msg = $res;
$m = json_encode($ret);
echo $m;

?>
