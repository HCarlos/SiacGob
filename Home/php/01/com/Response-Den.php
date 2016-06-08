<?php
$iddenuncia = $_POST["idden2"];
require_once("../oCentura.php");
$f = oCentura::getInstance();
$ret = $f->getQuerys(2000,"",$iddenuncia);
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<title>SIAC | Centro 2013 - 2015</title>
<link rel="stylesheet" type="text/css" href="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>css/external/normalize.css" /><link rel="stylesheet" type="text/css" href="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>css/config.css" /><link rel="stylesheet" type="text/css" href="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>css/01/class_gen.css" /><link rel="stylesheet" type="text/css" href="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>css/01/forms.css" /><link href="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>css/external/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css"/><script src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/api/jquery-1.7.2.min.js"></script><script src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/api/jquery-ui-1.8.21.custom.min.js"></script><script src="http://187.157.37.204:8080/socket.io/socket.io.js" > </script> <script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/01/persistent.js"></script><script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/01/base.js"></script><script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/api/jquery.form.js"></script><script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/init.js"></script><script> var stream; var ids = <?php echo $ret[0]->idstatus ?>;</script>
	
	

<style type="text/css">

#form-respuesta-dep >  fieldset > #descripcion{width:100% !important; height:5em !important;}
#form-respuesta-dep >  fieldset > #respuesta_dep{width:100% !important; height:10em !important;}
#form-respuesta-dep >  fieldset > #observaciones{width:100% !important; height:10em !important;}
#titleRespuesta{ color:#FFF !important;}
#h3{ padding:0.5em !important; margin-bottom:1em !important;}
.shrt{ width:50px !important;} 
.eme10{position:relative !important; display:inline-block !important; height:1em !important; vertical-align:top !important; width:10em !important;}

</style>

</head>
<body>
<div id="dialog-form-respuesta-dep" >
	<form id="form-respuesta-dep" class="form ui-widget-content">
		<div id="h3" class=" ui-widget-header ui-corner-all" >
			<span id="titleRespuesta" > ... </span>
		</div>
		<fieldset>
			<label for="descripcion" class="1emBottom" >Descripci&oacute;n de la Solicitud: </label><br>
        		<textarea type="text"  name="descripcion" id="descripcion" class="shrt text ui-widget-content ui-corner-all" readonly><?php echo $ret[0]->descripcion; ?></textarea>
		</fieldset>
		<fieldset>
			<label for="fecha_dep" >Fecha Ingreso: </label>
        		<input type="date" name="fecha_dep" id="fecha_dep" class=" ui-widget-content ui-corner-all" value="<?php echo date('Y-m-d'); ?>" required/>
			<label for="fecha_ejecucion" class="fieldset-margin-left">Fecha Programada: </label>
        		<input type="date" name="fecha_ejecucion" id="fecha_ejecucion" class=" ui-widget-content ui-corner-all" value="" required/><br>
		</fieldset>	
		<fieldset>
			<label for="cfolio">Folio: </label>
        		<input type="text" name="cfolio" id="cfolio" class=" ui-widget-content ui-corner-all" value="<?php echo $ret[0]->cfolio; ?>" readonly/>
			<label for="status" class="fieldset-margin-left">Status: </label>
			<Select name="status" id="status" required > 
			</select>
		</fieldset>	
		<fieldset>
			<label for="respuesta_dep" class="1emBottom" >Respuesta de la Dependencia: </label><br>
        		<textarea type="text"  name="respuesta_dep" id="respuesta_dep" class="shrt text ui-widget-content ui-corner-all"><?php echo $ret[0]->respuesta_dep; ?></textarea>
		</fieldset>
		<fieldset>
			<label for="observaciones" class="1emBottom" >Observaciones: </label><br>
        		<textarea type="text"  name="observaciones" id="observaciones" class="shrt text ui-widget-content ui-corner-all"><?php echo $ret[0]->observaciones; ?></textarea>
		</fieldset>
		<fieldset>
		     <input type="submit" id="cmdSave" name="cmdSave" value="Guardar" /><span class="eme10"></span>
			<button type="button" id="closeWindow" >Cerrar Ventana</button>
			<input type="hidden" name="iduser2" id="iduser2" value="0" />
			<input type="hidden" id="idden2" name="idden2" value="0" />
		</fieldset>
	</form>
</div>

<script>
var iddepM = <?php echo $ret[0]->iddependencia ?>;

<!------------------------------------------------------------>

var oIndex=40;var IdUser=sessionStorage.Id;if($("#closeWindow").length){$("#closeWindow").button({icons:{primary:"ui-icon-close",},text:true})}$("#closeWindow").on("click",function(event){close()});$("#form-respuesta-dep").submit(function(){$(this).ajaxSubmit({beforeSubmit:validateFormResp,success:invocarFormularioRESPUESTA});return false});function getStatus(){var lbl;$("#form-respuesta-dep > fieldset > select[name=status]").html("");$.post(obj.getValue(0)+"getEC/",{o:oIndex,t:3,p:0},function(json){if(json.length<=0){return false}$.each(json,function(i,item){var sdi=item.data==ids?"selected":"";var lbl=item.label.split(".");if((parseInt(lbl[1])==iddepM)||(parseInt(lbl[1])<=0)){$("#form-respuesta-dep > fieldset > select[name=status]").append('<option value="'+item.data+'" '+sdi+">"+lbl[0]+"</option>")}})},"json")}function invocarFormularioRESPUESTA(responseText,statusText,xhr,$form){var queryString=$("#form-respuesta-dep").formSerialize();$.post(obj.getValue(0)+"getEC/",{o:oIndex,t:4,p:2,c:queryString},function(json){var jsn=json[0].msg.split(".");if(jsn[0]=="OK"){stream.emit("cliente",{mensaje:"D20"});alert("Datos guadados con éxito");close()}},"json")}function validateFormResp(formData,jqForm,options){var form=jqForm[0];if(!form.fecha_dep.value){alert("No hay dato que guardar");return false}}getStatus();

<!------------------------------------------------------------>

$( "input[name=fecha_dep]" ).val("<?php echo $ret[0]->fecha_dep ?>");
$( "input[name=fecha_ejecucion]" ).val("<?php echo $ret[0]->fecha_ejecucion==""?date('Y-m-d'):$ret[0]->fecha_ejecucion ?>");
stream = io.connect('http://187.157.37.204:8080');
$( "#form-respuesta-dep > fieldset >  select[name=status]" ).val(<?php echo $ret[0]->idstatus ?>);
$( "input[name=iduser2]" ).val(IdUser);
$( "input[name=idden2]" ).val(<?php echo $iddenuncia ?>);
$("#titleRespuesta").html("RESPUESTA: <?php echo $ret[0]->grupo ?> | <?php echo $ret[0]->producto ?>");


</script>
</body>
</html>