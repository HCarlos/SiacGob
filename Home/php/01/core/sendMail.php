<?php
function sendMail($data,$cfolio){
	parse_str($data);
// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.utf8_decode('Info Logydes').' <info@logydes.com.mx>'. "\r\n";
$cabeceras .= utf8_decode('From: SIAC Centro 2013 - 2015 <dc@tabascoweb.com>') . "\r\n";
$cabeceras .= 'Cc: manager@logydes.com.mx' . "\r\n";
$titulo = utf8_decode("Se ha agregado una nueva solicitud al sistema");
//mail("dc@tabascoweb.com",$titulo,"Jorge, se agregó la solicitud:".$cfolio." al sistema, realizado el día ".$fecha,$cabeceras);

//mail("dc@tabascoweb.com",$titulo,"Carlos, se agregó la solicitud:".$cfolio." al sistema, realizado el día ".$fecha,$cabeceras);

}
?>

