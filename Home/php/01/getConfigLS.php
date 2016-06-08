<?php

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

$ret = array();

$ret[0]->Catalogo = "Catálogo de Ciudadanos";
$ret[1]->Catalogo = "Grupo de Clientes";
$ret[2]->Catalogo = "Asocia datos fiscales en clientes";
$ret[3]->Catalogo = "Servicios";
$ret[6]->Catalogo = "Usuarios";
$ret[7]->Catalogo = "Grupo de Usuarios";
$ret[8]->Catalogo = "Personas";
$ret[9]->Catalogo  = "Asignación de Delegados a Comunidades";
$ret[10]->Catalogo = "Grupos de Personal";
$ret[11]->Catalogo = "Relación Cuentas ContPAQi - Clientes";
$ret[20]->Catalogo = "Contratos";
$ret[30]->Catalogo = "Detalle del Contrato";
$ret[40]->Catalogo = "Solicitud Ciudadana";
$ret[41]->Catalogo = "Asignar Facturas a Cobrador";
$ret[50]->Catalogo = "Pagos";
$ret[60]->Catalogo = "Esquemar";
$ret[70]->Catalogo = "Validar";

$ret[200]->Catalogo = "Reportes Varios";

$m = json_encode($ret);
echo $m;
?>
