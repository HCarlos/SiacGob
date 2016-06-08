<?php
function redimencionar($file) {
// Función que REEMPLAZA una imágen JPEG por otra con diferenetes dimenciones...
// Se da por echo la imágen existe y es una imágen JPEG (no se hacen validaciones)

    $imagen = ImageCreateFromJPEG($file);
        unlink($file); // BORRAMOS el archivo original
    $width  = imagesx($imagen);
    $height = imagesy($imagen);
    if ($width>=$height){
	  $nueva_anchura  = 418;
    	  $nueva_altura = 300 ;// Para un alto proporcinal (RECOMENDADO) ó ingresa directamente el alto requerido.
	    
    }else{
	  $nueva_anchura  = 300;
    	  $nueva_altura = 418 ;// Para un alto proporcinal (RECOMENDADO) ó ingresa directamente el alto requerido.
    }
    
    
//    $nueva_anchura  = 800; // Define aquí el ancho requerdo
//    $nueva_altura = ($nueva_anchura * $height) / $width ;// Para un alto proporcinal (RECOMENDADO) ó ingresa directamente el alto requerido.
    
        if (function_exists("imagecreatetruecolor")) {
           $calidad = ImageCreateTrueColor($nueva_anchura, $nueva_altura);
        } else $calidad = ImageCreate($nueva_anchura, $nueva_altura);

    ImageCopyResized($calidad, $imagen, 0, 0, 0, 0, $nueva_anchura, $nueva_altura, $width, $height);
    ImageJPEG($calidad, $file, 100);
    imagedestroy($imagen);
    return true;
// Forma de uso:
// redimencionar(/ruta/archivo.jpg) 
}

$target_path = "uploads/"; 
$target_path = $target_path.$_FILES['userfile']['name']; 
$filename = $_FILES['userfile']['name']; 
$ret = array();
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) { 
	redimencionar($target_path);
	require_once("oCentura.php");
	$f = oCentura::getInstance();
	$u    = $_POST['namex'];
	$t    = $_POST['phone'];
	$i    = $_POST['iD'];
	$la   = $_POST['la'];
	$lo   = $_POST['lo'];
	$ms   = "Vacio";//$_POST['message'];
	$arg = "nombre=$u&celular=$t&idF=$i&latitud=$la&longitud=$lo&message=$ms&image=$filename";
	$res = $f->setSaveData(40,$arg,0,0,7);
	$ret[0]->msg = "OK";
 } else { 
	$ret[0]->msg = "Error";
 }
header("application/json; charset=utf-8");  
header("Cache-Control: no-cache"); 
$m = json_encode($ret);
echo $m;

 ?>