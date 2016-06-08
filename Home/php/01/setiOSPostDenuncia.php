<?php
function redimencionar($file,$W=0,$H=0,$sufijo="",$filename) {
	$extension = explode(".",$filename);
	
	// Creamos la Imagen Principal
    $imagen = ImageCreateFromJPEG($file);
    unlink($file); // BORRAMOS el archivo original
    $width  = imagesx($imagen);
    $height = imagesy($imagen);
    
    $nueva_anchura  = $width;
    $nueva_altura = $height ;
    
    if (function_exists("imagecreatetruecolor")) {
           $calidad = ImageCreateTrueColor($nueva_anchura, $nueva_altura);
     } else $calidad = ImageCreate($nueva_anchura, $nueva_altura);

    ImageCopyResized($calidad, $imagen, 0, 0, 0, 0, $nueva_anchura, $nueva_altura, $width, $height);
    ImageJPEG($calidad, $file, 40);
    //imagedestroy($imagen);

    //Se crea una imagen mini
    	$nueva_anchura  = 100;
    	$nueva_altura = 100 ;
    
	$target_path = "uploads/"; 
	$target_path = $target_path.$extension[0]."-mini.".$extension[1]; 
	$file = $target_path;
    
    if (function_exists("imagecreatetruecolor")) {
           $calidad = ImageCreateTrueColor($nueva_anchura, $nueva_altura);
     } else $calidad = ImageCreate($nueva_anchura, $nueva_altura);

    ImageCopyResized($calidad, $imagen, 0, 0, 0, 0, $nueva_anchura, $nueva_altura, $width, $height);
    ImageJPEG($calidad, $file, 70);

    //Se crea una imagen -S
    	$nueva_anchura  = 253;
    	$nueva_altura = 223 ;
    
	$target_path = "uploads/"; 
	$target_path = $target_path.$extension[0]."-s.".$extension[1]; 
	$file = $target_path;
    
    if (function_exists("imagecreatetruecolor")) {
           $calidad = ImageCreateTrueColor($nueva_anchura, $nueva_altura);
     } else $calidad = ImageCreate($nueva_anchura, $nueva_altura);

    ImageCopyResized($calidad, $imagen, 0, 0, 0, 0, $nueva_anchura, $nueva_altura, $width, $height);
    ImageJPEG($calidad, $file, 100);
    imagedestroy($imagen);




    
    return true;
}

$target_path = "uploads/"; 
$target_path = $target_path.$_FILES['userfile']['name']; 
$filename = $_FILES['userfile']['name']; 
$ret = array();
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) { 
	redimencionar($target_path,0,0,"",$filename);
	
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
	$ms   = "Vacio";//$_POST['message'];
	$arg = "nombre=$u&celular=$t&idF=$i&latitud=$la&longitud=$lo&imagen=$filename&denuncia=$de&username=$un&modulo=$mod";
	$res = $f->setSaveData(40,$arg,0,0,102);
	$ret[0]->msg = "OK";
 } else { 
	$ret[0]->msg = "Error";
 }
header("application/json; charset=utf-8");  
header("Cache-Control: no-cache"); 
$m = json_encode($ret);
echo $m;

 ?>