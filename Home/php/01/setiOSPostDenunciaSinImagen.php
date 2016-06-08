<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

require_once("oCentura.php");
$f = oCentura::getInstance();
$un   = $_POST['username'];
$de   = $_POST['denuncia'];
$u    = $_POST['namex'];
$t    = $_POST['phone'];
$i    = $_POST['iD'];
$la   = $_POST['la'];
$lo   = $_POST['lo'];
$mod  = $_POST['modulo'];

$arg = "imagen=&nombre=$u&celular=$t&idF=$i&latitud=$la&longitud=$lo&denuncia=$de&username=$un&modulo=$mod";
$res = $f->setSaveData(40,$arg,0,0,102);
$ret = array();
$ret[0]->msg = $res;
$m = json_encode($ret);
echo $m;

?>
