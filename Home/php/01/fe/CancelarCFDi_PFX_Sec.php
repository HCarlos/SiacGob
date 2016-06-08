<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php


//Se asigna el servicio
$servicio="https://www.factorumweb.com/factorum_cancelacion/service.asmx?wsdl"; //url del servicio
//parametros de la llamada
$parametros=array(); 



$data = file_get_contents("RFC.pfx");

//Se preparan los parametros con los valores adecuados
$parametros['rfc']="AAA010101AAA";//String
$parametros['pfx']=$data; //base64Binary, pero se maneja String aqui
$parametros['clavepfx']="prueba2011";//String
$parametros['rfclogin']="AAA010101AAA";//String
$parametros['usuariologin']="prueba1@factorum.com.mx"; //String
$parametros['clavelogin']="prueba2011";//String


//Se crea el cliente del servicio
$client = new SoapClient( $servicio, $parametros);

//Se hace el metodo que vamos a probar
$result = $client->CancelarCFDi_PFX_Sec($parametros);

//Para observar el Dump de lo que regresa, es puramente de debug
echo "Valor dump del servicio:";
echo "<BR>";
var_dump($result);
echo "<BR>";
echo "<BR>";

//Aislar cada valor de lo que regresa, y poder manipularlo como sea
foreach($result as $key => $value) {
    echo "Valor de CancelarCFDi_PFX_SecResult:";
    echo "<BR>";
    var_dump($value->CancelarCFDi_PFX_SecResult);
}

?>
        
    </body>
</html>
