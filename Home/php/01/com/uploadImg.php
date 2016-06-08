<?php

$target_path = "uploads/"; 
$target_path = $target_path.$_FILES['userfile']['name']; 
$filename = $_FILES['userfile']['name']; 
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) { 

	require_once("oCentura.php");
	$f = oCentura::getInstance();
	$u    = $_POST['name'];
	$t    = $_POST['phone'];
	$i    = $_POST['iD'];
	$la   = $_POST['la'];
	$lo   = $_POST['lo'];
	$ms   = "Vacio";//$_POST['message'];
	$arg = "nombre=$u&celular=$t&idF=$i&latitud=$la&longitud=$lo&message=$ms&image=$filename";
	$res = $f->setSaveData(40,$arg,0,0,7);
	$ret = array();
	$ret[0]->msg = "Success ! The file has been uploaded";
 } else { 
	$ret[0]->msg = "Error";
 }
header("application/json; charset=utf-8");  
header("Cache-Control: no-cache"); 
$m = json_encode($ret);
echo $m;

 ?>