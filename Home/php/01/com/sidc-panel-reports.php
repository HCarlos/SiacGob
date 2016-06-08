<h2> </h2>
<div class="desdeCat"  style="width:96%" >
<form id="formContract" class="form" style="width:96%">
	<fieldset class="formContract">
		<label for="type_report" class="fieldset-margin-left">Tipo de Reporte: </label>
		<Select name="type_report" id="type_report" size=1 > 
			<OPTION VALUE="0" >Gr&aacute;fico por Dependencias</OPTION>
			<OPTION VALUE="1" selected>&Aacute;rea</OPTION>
			<OPTION VALUE="2"  >Status</OPTION>
			<OPTION VALUE="3"  >Medio de Captaci&oacute;n</OPTION>
			<OPTION VALUE="4"  >Prioridad</OPTION>
			<OPTION VALUE="5"  >Catálogo de Servicios</OPTION>
			<OPTION VALUE="6"  >Dependencia vs Servicios m&aacute;s solicitados</OPTION>
			<OPTION VALUE="7"  >SAS Orden de Trabajo a Brigadas</OPTION>
		</select>
		 <input type="submit" value="Consultar" />
	</fieldset>				
</form>
<hr>
<form id="formMiscRep" class="form ui-widget-content" style="width:96%" >
					
	<fieldset id="fs-fi-ff" class="formContract">
		<label for="fi" class="fieldset-margin-left">Desde:</label>
        	<input type="date" name="fi" id="fi" class=" ui-widget-content ui-corner-all cff" value="<?php echo date('Y-m-d'); ?>" required/>

		<label for="ff" class="fieldset-margin-left">Hasta:</label>
        	<input type="date" name="ff" id="ff" class=" ui-widget-content ui-corner-all cff" value="<?php echo date('Y-m-d'); ?>" required/>
	</fieldset>				
	
	<fieldset id="fs-dependencia" class="formContract">
		<label for="dependencia"  class="fieldset-margin-left" >Dependencia: </label>
		<Select name="dependencia" id="dependencia" > </select>
	</fieldset>				
	
	<fieldset id="fs-area" class="formContract">
		<label for="area" class="fieldset-margin-left" >&Aacute;rea: </label>
		<Select name="area" id="area" > </select>
	</fieldset>	

	<fieldset id="fs-producto" class="formContract">
		<label for="producto" class="fieldset-margin-left" >Servicio: </label>
		<Select name="producto" id="producto" > </select>
	</fieldset>	

	<fieldset id="fs-origen" class="formContract">
		<label for="origen" class="fieldset-margin-left" >Captada en: </label>
		<Select name="origen" id="origen" > </select>
	</fieldset>				
	
	<fieldset id="fs-status" class="formContract">
		<label for="status" class="fieldset-margin-left" >Status: </label>
		<Select name="status" id="status" > </select>
	</fieldset>	
					
	<fieldset id="fs-prioridad" class="formContract">
		<label for="prioridad" class="fieldset-margin-left" >Proridad: </label>
		<Select name="prioridad" id="prioridad" > </select>
	</fieldset>	
					
	<fieldset id="fs-formato" class="formContract">
	   	<label for="formato" class="fieldset-margin-left">Mostrar en </label>
		<Select name="formato" id="formato" size=1 > 
			<OPTION VALUE="pie-chart-xls.php" selected >MS Excel</OPTION>
			<OPTION VALUE="pie-chart-html.php"  >Pantalla</OPTION>
			<OPTION VALUE="pie-chart-pdf.php"  >PDF</OPTION>
		</select>
		<input type="hidden" id="iddep" name="iddep" value="0" />
		<input type="hidden" id="idareadep" name="idareadep" value="0" />
		
	</fieldset>	
				
	<fieldset id="fs-filterBlank" class="formContract">
		<label for="filterBlank" class="fieldset-margin-left" >Filtrar campos en blanco: </label>
		<Select name="filterBlank" id="filterBlank" > 
			<OPTION VALUE="0" selected >Todos</OPTION>
			<OPTION VALUE="1"  >Solo campos completos</OPTION>
			<OPTION VALUE="2"  >Solo campos incompletos</OPTION>
		</select>
	</fieldset>	

</form>
				     
</div>
<style>
.formContract{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formMiscRep > fieldset >  input[type=submit]{margin:2em 1.5em; }

</style>				
				
<script type="text/javascript"> 

//prodgpo();
$("#fs-fi-ff").show();
$("#fs-formato").hide();
hideComponents();
$("#fs-filterBlank").show();



$(".asignaciones1 h2").html(obj.cat[obj.index].Catalogo); 
$(".asignaciones1").css("height", function() { return $(window).height()-obj.height;});
		
$("#iduser").val(sessionStorage.Id);
var iduser = sessionStorage.Id;
	
$("#users-contain").css("min-height",function(){
	var initHeight = $(window).height()-obj.height;
	return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
});
	

function hideComponents(){
	$("#fs-producto").hide();
	$("#fs-origen").hide();
	$("#fs-status").hide();
	$("#fs-prioridad").hide();
	$("#fs-filterBlank").hide();
}
	
// Operaciones con el Formulario de reportes Varios 
$('#formContract').submit(function() { 
    	$(this).ajaxSubmit({beforeSubmit: validQuery,  success: invocarFormulario }); 
     return false; 
});

$("#formContract > fieldset > select[name=type_report]").on('change',function(event){
	event.preventDefault();
	var val = event.currentTarget.value;
	hideComponents();
	$("#fs-area").hide();
	switch(parseInt(val)){
		case 0:
			break;
		case 1:
		case 7:
			$("#fs-area").show();
			$("#fs-filterBlank").show();
			break;
		case 2:
			$("#fs-status").show();
			break;
		case 3:
			$("#fs-origen").show();
			break;
		case 4:
			$("#fs-prioridad").show();
			break;
	}
  
});


getDependencia();
getOrigen();
getStatus();
getPrioridad();

//getAreaSel(iddep);

$.post(obj.getValue(0)+"getEC/", { o:-1, t:0, p:0,c:iduser },
	function(json){
		if (json.length==0) {
			     iduser=0;
				getAreaSel(-1000);
				return false;
		}else{
			iduser = parseInt(json[0]);
			iddep  = parseInt(json[1]);
			
			if (iddep!=20){
				$('#formMiscRep > fieldset > select[name=dependencia]').val(iddep);
				$('#formMiscRep > fieldset > input[name=iddep]').val(iddep);
				$('#formMiscRep > fieldset > select[name=dependencia]').prop('disabled', true);
				//$("#formMiscRep > fieldset > select[name=type_report]: option[value=0]").attr('disabled','disabled');
				if (iddep!=4){
					$("#formContract > fieldset > select[name=type_report]").find("option[value=0]").attr('disabled', true);
				}
			}
			getAreaSel(iddep);
		}
 }, "json");


function invocarFormulario(formData, jqForm, options) { 

	var queryString = $('#formMiscRep').formSerialize();  
	var val = $("select[name=type_report]").val();
	var PARAMS = {data:queryString, v:val};  
	var url;
	switch(parseInt(val)){
		case 0:
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
			url = obj.getValue(0)+"php/01/docs/"+$('select[name="formato"]').val();
			break;
		case 7:
			url = obj.getValue(0)+"php/01/docs/fmt-04.php";
			break;
	}
	//alert(url);
	var temp=document.createElement("form");
	temp.action=url;
	temp.method="POST";
	temp.target="_blank";
	temp.style.display="none";
	for(var x in PARAMS) {
		var opt=document.createElement("textarea");
		opt.name=x;
		opt.value=PARAMS[x];
		temp.appendChild(opt);
	}
	document.body.appendChild(temp);
	temp.submit();
	return temp;
}

function validQuery(formData, jqForm, options) { 
	var val = $("select[name=type_report]").val();
	return true;
	
}

function getDependencia(){
	
	$.post(obj.getValue(0)+"getEC/", { o:40, t:0, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name=dependencia]").html('<OPTION VALUE="0" selected >&lt;Todas&gt;</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name=dependencia]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
		//getProdCont();
	}, "json");

}

$('select[name=dependencia]').on('change',function(event){
	getProdSel(event.currentTarget.value);
	getAreaSel(event.currentTarget.value);

});

function getProdSel(id){
	$.post(obj.getValue(0)+"getEC/", { o:40, t:1, p:0, c:' idprodgpo = '+id },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='producto']").html('<OPTION VALUE="0" selected >&lt;Todos&gt;</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="producto"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
			});
			/*
			if (tipo==1){
				$('select[name=producto]').val(arrItems[index].idprod);
				$("#formMiscRep > fieldset > input[name='idproducto']").val(arrItems[index].idprod);
			}
			*/
	}, "json");

}

function getAreaSel(id){
	$.post(obj.getValue(0)+"getEC/", { o:40, t:-1, p:0, c:' idprodgpo = '+id },
 		function(json){
			$("select[name=area]").html('<OPTION VALUE="0" selected >&lt;Todas&gt;</OPTION>');	
			if (json.length<=0) { return false;}
			$.each(json, function(i, item) {
				$('select[name=area]').append('<option value="'+item.data+'">'+item.label+'</option>');	
			});
			/*
			if (tipo==1){
				$('select[name=area]').val(arrItems[index].idprod);
				$("#formMiscRep > fieldset > input[name='idareadep']").val(arrItems[index].idprod);
			}
			*/
	}, "json");

}


$('select[name="producto"]').on('change',function(event){
	$("#formMiscRep > fieldset > input[name='idproducto']").val(event.currentTarget.id);
});

$('select[name=area]').on('change',function(event){
	$("#formMiscRep > fieldset > input[name=idareadep]").val(event.currentTarget.id);
});


function getOrigen(){
	var lbl;
	$.post(obj.getValue(0)+"getEC/", { o:40, t:2, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name=origen]").html('<OPTION VALUE="0" selected >&lt;Todos&gt;</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name=origen]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
	}, "json");

}

function getStatus(){
	var lbl;
	$.post(obj.getValue(0)+"getEC/", { o:40, t:3, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name=status]").html('<OPTION VALUE="0" selected >&lt;Todos&gt;</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name=status]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
	}, "json");

}

function getPrioridad(){
	var lbl;
	$.post(obj.getValue(0)+"getEC/", { o:40, t:4, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name=prioridad]").html('<OPTION VALUE="0" selected >&lt;Todos&gt;</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name=prioridad]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
	}, "json");

}

	
		
</script> 		
