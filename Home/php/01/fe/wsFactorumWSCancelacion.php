<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php


//Se asigna el servicio
$servicio="http://www.factorumweb.com/Factorum_cancelacion_ws/Factorumwscancelacion.asmx?wsdl"; //url del servicio
//parametros de la llamada
$parametros=array(); 



$data = file_get_contents("RFC.pfx");

//Se preparan los parametros con los valores adecuados
$parametros['userWS']="prueba1@factorum.com.mx"; //String
$parametros['rfcWS']="AAA010101AAA";//String
$parametros['pwdWS']="prueba2011";//String

$parametros['rfcEmisor']="AAA010101AAA";//String

$parametros['uuid']="111111111111";//String, valor del UUID a cancelar
$parametros['BytePFX']=$data; //base64Binary, pero se maneja String aqui
$parametros['cvePFX']="pppppp";//String Clave privada 


//Se crea el cliente del servicio
$client = new SoapClient( $servicio, $parametros);

//Se hace el metodo que vamos a probar
$result = $client->wsFactorumWSCancelacion($parametros);

//Para observar el Dump de lo que regresa, es puramente de debug
echo "Valor dump del servicio:";
echo "<BR>";
var_dump($result);
echo "<BR>";
echo "<BR>";

//Aislar cada valor de lo que regresa, y poder manipularlo como sea
foreach($result as $key => $value) {
    echo "Valor de ByteXML:";
    echo "<BR>";
    var_dump($value->ByteXML);
	 echo "<BR>";
    echo "<BR>";
    echo "Valor de MensajeError:";
    echo "<BR>";
    var_dump($value->MensajeError);
		 echo "<BR>";
    echo "<BR>";
    echo "Valor de CodigoError:";
    echo "<BR>";
    var_dump($value->CodigoError);
}

?>
        
    </body>
</html>
