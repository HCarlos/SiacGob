<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Document</title>
</head>

<body>
<p>Hola Mundo</p>
<?php 


require_once('../vo/voConn.php');
$arg   = $_POST["data"];
echo $arg;
parse_str($arg);
echo $rfc;

ob_end_clean();

   
 
   

//datos de la empresa que factura
$rfc_emisor = 'CAR7909222P7';
$razon_social_emisor = 'SISTEMA INFORMATIVO DE TABASCO S.A DE C.V.';
$calle_emisor = 'PAGES LLERGO';
$num_exterior_emisor = '116 1ER. PISO';
$colonia_emisor ='COL. NUEVA VILLAHERMOSA';
$municipio_emisor='VILLAHERMOSA, CENTRO';
$estado_emisor='TABASCO';
$codigo_postal_emisor='86070';
$pais_emisor='MÉXICO';
$regimen_fiscal = 'Personas Morales con fines no Lucrativos';//'Régimen General de Ley Personas Morales';//$_REQUEST['regimen_emisor'];

//

$forma_pago        = $forma_pago;//"Pago en una sola exhibición";//trim($_REQUEST['forma_pago']); 
$tipo_cfd          = "ingreso";//trim($_REQUEST['tipo_cfd']);//ingreso,egreso,traspaso; 
$fecha             = $fecha;//date_format($fecha, 'Y-m-d T H:i:s');//$_REQUEST['fecha']);
$metodo_pago       = $metodo_pago;//$arcomp[0];//trim($_REQUEST['metodo_pago']); 
$lugar_expedicion  = "Villahermosa, Tabasco";//$arcomp[1];//trim($_REQUEST['lugar_expedicion']);
$aprobacion        = 1;//trim($_REQUEST['aprobacion']); 
$year_aprobacion   = "2012";//trim($_REQUEST['year_aprobacion']);
$serie             = $serie;//"U";//trim($_REQUEST['serie']); 
$folio             = $folio;//$arcomp[2];//trim($_REQUEST['folio']); 
$dias_credito      = 0;//trim($_REQUEST['dias_credito']); 
$iva               = 16;//trim($_REQUEST['iva']); 
$num_certificado   = "SIT010509694";//"00001000000201570746";//trim($_REQUEST['numero_certificado']);

$certificado_texto = "";
$sello             = "";	



$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");
$result = mysql_query("select rfc,razon_social,calle,num_externo, num_interno,colonia, localidad, municipio,estado, pais, idcodpos, importe, descuento, iva, total from _viClientes where idcli = $rfc limit 1");

if (!$result) {
    	$ret=0;
}else{
    	$ret=intval(mysql_result($result, 0));
}

/*
$rfc           = mysql_result($result, 0);//$arrec[0]; // trim($_REQUEST['rfc']); 
$razon_social  = mysql_result($result, 1);//$arrec[1]; // trim($_REQUEST['razon_social']);
$calle         = mysql_result($result, 2);//$arrec[2]; // trim($_REQUEST['calle']); 
$num_exterior  = mysql_result($result, 3);//$arrec[3]; // trim($_REQUEST['num_exterior']); 
$num_interior  = mysql_result($result, 4);//$arrec[4]; // trim($_REQUEST['num_interior']);
$colonia       = mysql_result($result, 5);//$arrec[5]; // trim($_REQUEST['colonia']); 
$localidad     = mysql_result($result, 6);//$arrec[6]; // trim($_REQUEST['localidad']);
$municipio     = mysql_result($result, 7);//$arrec[7]; // trim($_REQUEST['municipio']); 
$estado        = mysql_result($result, 8);//$arrec[8]; // trim($_REQUEST['estado']); 
$pais          = mysql_result($result, 9);//$arrec[9]; // trim($_REQUEST['pais']);
$codigo_postal = mysql_result($result, 10);//$arrec[10]; // trim($_REQUEST['codigo_postal']); 
$referencia    = $referencia;//$arrec[11]; // trim($_REQUEST['referencia']);
$email         = $email;//$arrec[12]; // trim($_REQUEST['email']);


$tot = mysql_result($result, 11);//$_GET["total"];	

$descuento=mysql_result($result, 12);//0;
//$subtotal = $tot;
//$subtotal2 = $tot;
$iva = mysql_result($result, 13);//0;
//$iva*$subtotal2;
$total = mysql_result($result, 14);//$tot;
//$subtotal2 + $iva;
$total_cadena = $total;
*/
mysql_close($mysql);

/*

include("sayCadOr.php");

//Generamos la Cadena Original
$cfdi = $cadena_xml;//simplexml_load_file("facturas/Factura-".$serie."-".$folio.".xml");
$xml = new DOMDocument();
$xml->loadXML($cadena_xml) or die("\n\n\nXML no válido");
$xslt = new XSLTProcessor();
$XSL = new DOMDocument();
$XSL->load('codeArji/cadenaoriginal_3_2.xslt', LIBXML_NOCDATA);
error_reporting(0); # Se deshabilitan los errores pues el xssl de la cadena esta en version 2 y eso genera algunos warnings
$xslt->importStylesheet( $XSL );
error_reporting(E_ALL); # Se habilitan de nuevo los errores (se asume que originalmente estaban habilitados)
$c = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
$cadena = $xslt->transformToXML( $c );
unset($xslt, $XSL);

 
$ar=fopen("codeArji/certificado_arji.txt","r") or die("No se pudo abrir el archivo...");
//$ar=fopen("code-arji/cart_arji.txt","r") or die("No se pudo abrir el archivo");
while (!feof($ar))
	  {
		$certificado_texto.= fgets($ar);
	  }
fclose($ar);
	
//Gneramos el Sello Digital
$key='codeArji/CAR7909222P7_1207141115S.key.pem';
$fp = fopen($key, "r");
$priv_key = fread($fp, 8192);
fclose($fp);		
$pkeyid = openssl_get_privatekey($priv_key);
//openssl_sign($cadena_original,$cadenafirmada,$pkeyid,OPENSSL_ALGO_SHA1);
openssl_sign($cadena,$cadenafirmada,$pkeyid,OPENSSL_ALGO_SHA1);
$sello = base64_encode($cadenafirmada);


include("sayCadOr.php");

$myXML = "facturas/Fac-".$serie."-".$folio.".xml";

$new_xml = fopen ($myXML, "w");
fwrite($new_xml,$cadena_xml);
fclose($new_xml);

// Ahora Timbramos al Factura
$servicio = "http://www.factorumweb.com/FactorumWSv32/FactorumCFDiService.asmx?wsdl";
$parametros=array();
$data = file_get_contents($myXML);

//Ya puedes comenzar a utilizar nuestro servicio de Webservice Tus datos de acceso son:*Usuario: rived67@hotmail.com* Clave: u98Kh7 RFC: CAR7909222P7

$parametros['usuario']="rived67@hotmail.com"; //$mail; //String
$parametros['rfc']="CAR7909222P7";//$rfc;//String
$parametros['password']="u98Kh7";//$password;//String
$parametros['xml']=$data; //string, pero se maneja String aqui
try {
	$client = new SoapClient($servicio, $parametros);
	$result = $client->FactorumGenYaSelladoConArchivo($parametros);
} catch (SoapFault $E) {  
    echo $E->faultstring; 
}  

foreach($result as $key => $value) {
    $data = $value->ReturnFileXML;
    $img = $value->ReturnFileQRCode;
}

$gif = "facturas/Fac-Img-".$serie."-".$folio.".gif";

$fp = fopen($gif, 'w');
fwrite($fp, $img);
fclose($fp);

$new_xml = fopen ($myXML, "w");
fwrite($new_xml,$data);
fclose($new_xml);


    $xml = simplexml_load_file($myXML);
    $ns = $xml->getNamespaces(true);
    $xml->registerXPathNamespace('c', $ns['cfdi']);
    $xml->registerXPathNamespace('t', $ns['tfd']);

    //ESTA ULTIMA PARTE ES LA QUE GENERABA EL ERROR
    foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
	  $folfis = $tfd['UUID'];
    }

*/

//include("printPDFFac1.php");
			
?>
</body>
</html>