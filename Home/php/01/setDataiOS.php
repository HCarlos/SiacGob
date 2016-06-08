<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

require_once("oCentura.php");
$f = oCentura::getInstance();
$u    = $_POST['nombre'];
$t    = $_POST['celular'];
$i    = $_POST['idF'];
$la   = $_POST['latitud'];
$lo   = $_POST['longitud'];
$ms   = $_POST['message'];
$arg = "nombre=$u&celular=$t&idF=$i&latitud=$la&longitud=$lo&message=$ms";
$res = $f->setSaveData(40,$arg,0,0,6);
$ret = array();
$ret[0]->msg = $res;
$m = json_encode($ret);
echo $m;

?>
