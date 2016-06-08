<?php 

header("html/text; charset=utf-8");  
header("Cache-Control: no-cache");

require_once('../vo/voConn.php');
require_once('../oCentura.php');

$arg   = $_POST["data"];
parse_str($arg);
$idcli = $rfc;


ob_end_clean();
//ini_set ("memory_limit", '128M '); 
//error_reporting (E_ALL ^ E_NOTICE);
//ini_set ('error_reporting', E_ALL);
   


 
$regimen_fiscal = 'Régimen General de Ley Personas Morales';//$_REQUEST['regimen_emisor'];
$view = 1;

date_default_timezone_set('America/Mexico_city');

//
$tipo_cfdi         = "ingreso";//$tipo_cfdi;//trim($_REQUEST['tipo_cfd']);//ingreso,egreso,traspaso; 
$fecha             = date('Y-m-d')."T".date("H:i:s");//$_REQUEST['fecha']);
$lugar_expedicion  = "Villahermosa, Tabasco";//$arcomp[1];//trim($_REQUEST['lugar_expedicion']);
$aprobacion        = 1;//trim($_REQUEST['aprobacion']); 
$year_aprobacion   = "2012";//trim($_REQUEST['year_aprobacion']);
$serie             = $serie;//"U";//trim($_REQUEST['serie']); 
$folio             = "";//$folio;//$arcomp[2];//trim($_REQUEST['folio']); 
$dias_credito      = 0;//trim($_REQUEST['dias_credito']); 
$iva               = 16;//trim($_REQUEST['iva']); 
$Q = oCentura::getInstance();
$folio = $Q->getFolio($serie);

switch ($serie){
	case "A":
	case "B":
			$num_certificado   = "00001000000201013482";
			$file_cer          = "00001000000201013482.txt";
			$file_key          = "sit010509694_1205071050s.key.pem";
			$file_user         = "sit_0105@hotmail.com";
			$file_rfc          = "SIT010509694";
			$file_pass          = "GPM0105";

			$rfc_emisor           = 'SIT010509694';
			$razon_social_emisor  = 'SISTEMA INFORMATIVO DE TABASCO S.A DE C.V.';
			$calle_emisor         = 'PAGES LLERGO';
			$num_exterior_emisor  = '116';
			$num_interior_emisor  = '1ER PISO';
			$colonia_emisor       = 'COL. NUEVA VILLAHERMOSA';
			$municipio_emisor     = 'VILLAHERMOSA, CENTRO';
			$estado_emisor        = 'TABASCO';
			$codigo_postal_emisor = '86070';
			$pais_emisor          = 'MÉXICO';
			
			
			if ($serie=="A"){
				$rgb  = array(64,105,154);
				$logo = 'imgs/logo_presente.gif';
			}else{
				$rgb = array(166,24,23);
				$logo = 'imgs/logo_sol.gif';
			}
			
			break;
	case "C":
			$num_certificado   = "00001000000200495263";
			$file_cer          = "00001000000200495263.txt";
			$file_key          = "TTA960530HW0_1203061907S.key.pem";
			$file_user         = "sit_0105@hotmail.com";
			$file_rfc          = "SIT010509694";
			$file_pass         = "GPM0105";

			$rfc_emisor           = 'TTA960530HW0';
			$razon_social_emisor  = 'TV TABASCO S.A. DE C.V.';
			$calle_emisor         = 'PAGES LLERGO';
			$num_exterior_emisor  = '116';
			$num_interior_emisor  = '1ER PISO';
			$colonia_emisor       = 'COL. NUEVA VILLAHERMOSA';
			$municipio_emisor     = 'VILLAHERMOSA, CENTRO';
			$estado_emisor        = 'TABASCO';
			$codigo_postal_emisor = '86070';
			$pais_emisor          = 'MÉXICO';
			
			$logo                 = 'imgs/logo_radio.gif';
			
			$rgb = array(5,89,168);

 			break;
}

$certificado_texto = "";
$sello             = "";	
$folSer            = $serie."-".str_pad($folio, 6, "0", STR_PAD_LEFT);



$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");

$result = mysql_query("select rfc,razon_social,calle,num_externo, num_interno,colonia, localidad, municipio,estado, pais, idcodpos from _viClientes where idcli = $idcli limit 1");
//echo $result;
$rfc           = mysql_result($result, 0,"rfc");//$arrec[0]; // trim($_REQUEST['rfc']); 
$razon_social  = mysql_result($result, 0,"razon_social");//$arrec[1]; // trim($_REQUEST['razon_social']);
$calle         = mysql_result($result, 0,"calle");//$arrec[2]; // trim($_REQUEST['calle']); 
$num_exterior  = mysql_result($result, 0,"num_externo");//$arrec[3]; // trim($_REQUEST['num_exterior']); 
$num_interior  = mysql_result($result, 0,"num_interno");//$arrec[4]; // trim($_REQUEST['num_interior']);
$colonia       = mysql_result($result, 0,"colonia");//$arrec[5]; // trim($_REQUEST['colonia']); 
$localidad     = mysql_result($result, 0,"localidad");//$arrec[6]; // trim($_REQUEST['localidad']);
$municipio     = mysql_result($result, 0,"municipio");//$arrec[7]; // trim($_REQUEST['municipio']); 
$estado        = mysql_result($result, 0,"estado");//$arrec[8]; // trim($_REQUEST['estado']); 
$pais          = mysql_result($result, 0,"pais");//$arrec[9]; // trim($_REQUEST['pais']);
$codigo_postal = mysql_result($result, 0,"idcodpos");//$arrec[10]; // trim($_REQUEST['codigo_postal']); 
$referencia    = $referencia;//$arrec[11]; // trim($_REQUEST['referencia']);
$email         = $email;//$arrec[12]; // trim($_REQUEST['email']);


$result = mysql_query("select importe, descuento, iva, total, forma_pago_desc, metodo_pago_desc, isfe from _viFacturasEncab where idfactura = $idfactura limit 1");

$tot = mysql_result($result, 0, "importe");//$_GET["total"];	

$descuento=mysql_result($result, 0,"descuento");//0;

$subtotal = $tot;
$subtotal2 = $tot+$descuento;

$iva = mysql_result($result, 0,"iva");//0;
//$iva*$subtotal2;
$total = mysql_result($result, 0,"total");//$tot;
//$subtotal2 + $iva;
$total_cadena = $total;

$metodo_pago       = mysql_result($result, 0,"metodo_pago_desc");//$arcomp[0];//trim($_REQUEST['metodo_pago']); 

$forma_pago        = mysql_result($result, 0,"forma_pago_desc");// "Pago en una sola exhibición";//trim($_REQUEST['forma_pago']); 

$result = mysql_query("select isfe from _viFacturasEncab where idfactura = $idfactura limit 1");

$isfe              = intval(mysql_result($result, 0,"isfe"));// "Pago en una sola exhibición";//trim($_REQUEST['forma_pago']); 

if ($isfe == 1){
	echo "La Factura <strong>$folSer</strong> ya fu&eacute; TIMBRADA...";
	return false;
}


$arConc = array();
mysql_close($mysql);
for ($i=0;$i<100;++$i){
	$foo = "idproducto_".$i;
	$dprod = "producto_".$i;
	$cant = "cantidad_".$i;
	$dmedida = "med_".$i;
	$idpu = "precio_unitario_".$i;
	$imp = "importe_".$i;
	if (intval(isset($$foo))==1){
		$arConc[$i]=array("cantidad"=>intval($$cant,0),"medida"=>$$dmedida,"descripcion"=>$$dprod,"pu"=>str_replace(",","",$$idpu),"importe"=>str_replace(",","",$$imp));
	}
}
if (count($arConc)<=0){
    echo "Ocurrió un error al recuperar los datos "; 
    return false; 
}

include("createInvoiceXML1.php");

//Generamos la Cadena Original
$cfdi = $cadena_xml;//simplexml_load_file("facturas/Factura-".$serie."-".$folio.".xml");
$xml = new DOMDocument();
$xml->loadXML($cadena_xml) or die("\n\n\nXML no válido");
$xslt = new XSLTProcessor();
$XSL = new DOMDocument();
$XSL->load('presOpenSSL/cadenaoriginal_3_2.xslt', LIBXML_NOCDATA);
error_reporting(0); # Se deshabilitan los errores pues el xssl de la cadena esta en version 2 y eso genera algunos warnings
$xslt->importStylesheet( $XSL );
error_reporting(E_ALL); # Se habilitan de nuevo los errores (se asume que originalmente estaban habilitados)
$c = $xml->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
$cadena = $xslt->transformToXML( $c );
unset($xslt, $XSL);

$ar=fopen("presOpenSSL/".$file_cer,"r") or die("No se pudo abrir el archivo...");

//$ar=fopen("code-arji/cart_arji.txt","r") or die("No se pudo abrir el archivo");
while (!feof($ar))
	  {
		$certificado_texto.= fgets($ar);
	  }
fclose($ar);

//echo $certificado_texto;
	
//Gneramos el Sello Digital
$key='presOpenSSL/'.$file_key;
$fp = fopen($key, "r");
$priv_key = fread($fp, 8192);
//echo $fp;

fclose($fp);		
$pkeyid = openssl_get_privatekey($priv_key);
openssl_sign($cadena,$cadenafirmada,$pkeyid,OPENSSL_ALGO_SHA1);
$sello = base64_encode($cadenafirmada);

$folfis="";
include("createInvoiceXML1.php");

$myXML = "files/Fac-".$folSer.".xml";
// $myXML = "files/prueba.xml";

$new_xml = fopen ($myXML, "w");
fwrite($new_xml,$cadena_xml);
fclose($new_xml);

// Ahora Timbramos al Factura
$servicio = "http://www.factorumweb.com/FactorumWSv32/FactorumCFDiService.asmx?wsdl";
$parametros=array();
$data = file_get_contents($myXML);
$parametros['usuario']  = $file_user;
$parametros['rfc']      = $file_rfc;
$parametros['password'] = $file_pass;
$parametros['xml']=$data; //string, pero se maneja String aqui
//echo $data." ---> del data";
try {
	$client = new SoapClient($servicio, $parametros);
//	$result = $client->FactorumGenYaSelladoConArchivoTest($parametros);
	$result = $client->FactorumGenYaSelladoConArchivo($parametros);
} catch (SoapFault $E) {  
    echo "DevCH-> ".$E->faultstring; 
    return false;
}  

//echo $cadena_xml." ---> 2";
//return false;


foreach($result as $key => $value) {
    $data = $value->ReturnFileXML;
    $img = $value->ReturnFileQRCode;
}

$gif = "files/Fac-Img-".$folSer.".gif";

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
	  $folfis =  strtoupper($tfd['UUID']);
    }

//$gif = "files/fondo027.gif";

include("printPDFFac1.php");

//Guardamos el movimiento de la factura

if ($folfis!=""){
	$fxml = "Fac-".$folSer.".xml";
	$fpdf = "Fac-".$folSer.".pdf";
	$Conn = voConn::getInstance();
	$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
	mysql_select_db($Conn->db);
	mysql_query("SET NAMES UTF8");
	$result = mysql_query("update facturas_encab set isfe = 1, UUID = '$folfis', xml = '$fxml', pdf='$fpdf', fecha_timbrado = NOW() where idfactura = $idfactura ");
	mysql_close($mysql);
}


			
?>