<?php
$cadena_xml='<?xml version="1.0" encoding="utf-8" ?>'."\r\n";
$cadena_xml.='<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="3.2" serie="'.$serie.'" folio="'.$folio.'" fecha="'.$fecha.'" sello="'.$sello.'" formaDePago="Pago en una sola exhibicion" noCertificado="'.$num_certificado.'" subTotal="'.number_format($subtotal2, 2, '.','').'" certificado="'.$certificado_texto.'" Moneda="MXN" total="'.number_format($total_cadena, 2, '.','').'" tipoDeComprobante="'.$tipo_cfdi.'" metodoDePago="'.$metodo_pago.'" LugarExpedicion="'.$lugar_expedicion.'"  FolioFiscalOrig="" SerieFolioFiscalOrig="" FechaFolioFiscalOrig="'.$fecha.'"  xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">'."\r\n";
$cadena_xml .= '<cfdi:Emisor rfc="'.$rfc_emisor.'" nombre="'.$razon_social_emisor.'">'."\r\n";
$cadena_xml .= '<cfdi:DomicilioFiscal calle="'.$calle_emisor.'" noExterior="'.$num_exterior_emisor.'" noInterior="'.$num_interior_emisor.'" colonia="'.$colonia_emisor.'" municipio="'.$municipio_emisor.'" estado="'.$estado_emisor.'" pais="'.$pais_emisor.'" codigoPostal="'.$codigo_postal_emisor.'"/>'."\r\n";
$cadena_xml .= '<cfdi:RegimenFiscal Regimen="'.$regimen_fiscal.'"/>'."\r\n";
$cadena_xml .= '</cfdi:Emisor>'."\r\n";  
  $cadena_xml.='<cfdi:Receptor rfc="'.$rfc.'" nombre="'.$razon_social.'">'."\r\n";
    $cadena_xml.='<cfdi:Domicilio calle="'.$calle.'" noExterior="'.$num_exterior.'" localidad="'.$localidad.'" colonia="'.$colonia.'" municipio="'.$municipio.'" estado="'.$estado.'" pais="Mexico"/>'."\r\n";
  $cadena_xml.='</cfdi:Receptor>'."\r\n";
  $cadena_xml.='<cfdi:Conceptos>'."\r\n"; 
foreach($arConc as $i=>$value){
    $cadena_xml.='<cfdi:Concepto cantidad="'.$arConc[$i]["cantidad"].'" unidad="'.$arConc[$i]["medida"].'" descripcion="'.$arConc[$i]["descripcion"].'" valorUnitario="'.$arConc[$i]["pu"].'" importe="'.$arConc[$i]["importe"].'"/>'."\r\n";
}
  $cadena_xml.='</cfdi:Conceptos>'."\r\n";
  $cadena_xml.='<cfdi:Impuestos totalImpuestosTrasladados="'.$iva.'" totalImpuestosRetenidos="0.00">'."\r\n";
    $cadena_xml.='<cfdi:Traslados>'."\r\n";
      $cadena_xml.='<cfdi:Traslado impuesto="IVA" tasa="16.00" importe="'.$iva.'"/>'."\r\n";
    $cadena_xml.='</cfdi:Traslados>'."\r\n";
  $cadena_xml.='</cfdi:Impuestos>'."\r\n";
$cadena_xml.='</cfdi:Comprobante>'."\r\n";
$cadena_xml = str_replace("&","&amp;",$cadena_xml);
?>