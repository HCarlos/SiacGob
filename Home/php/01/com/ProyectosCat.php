
<div id="msgResponse"></div>
<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all">
	<span class="ui-icon ui-icon-contact"></span>
	<span id="tituloForm">...</span>
</div>
	<fieldset>
	   	<label for="txtclientes">Cliente </label>
        	<input type="text" name="txtclientes" id="txtclientes" class="text ui-widget-content ui-corner-all" title="Cliente"  placeholder="Cliente" required />
	   
	   	<label for="txt_viPersonal" class="fieldset-margin-left">Agente </label>
        	<input type="text" name="txt_viPersonal" id="txt_viPersonal" class="fieldset-margin-left text ui-widget-content ui-corner-all" title="Agente"  placeholder="Agente" required />
	   
		<label class="fieldset-margin-left">Requiere inicio y fin: </label>            
		
		<input type = "radio" name= "inicia_termina" id = "itS" value = "1" onChange="evalOption"/>
          <label for = "itS">Si</label>
          
          <input type = "radio" name = "inicia_termina" id = "itN" value = "0" />
          <label for = "itN">No</label>
	</fieldset>	
	
	<fieldset id="fechas">
        	<label for="fecha_inicial">Fecha de inicio</label>
        	<input type="date" name="fecha_inicial" id="fecha_inicial" title="Fecha de inicio" maxlength="12" placeholder="dd/mm/YYYY" value="<?php echo date('Y-m-d'); ?>" required/>
		
        	<label for="fecha_final" class="fieldset-margin-left">Fecha final</label>
        	<input type="date" name="fecha_final" id="fecha_final" title="Fecha final" maxlength="12" placeholder="dd/mm/YYYY" value="<?php echo date('Y-m-d'); ?>" required/>
	</fieldset>	
	
	<fieldset>
	   	<label for="guia" class="fieldset-margin-left">Guía </label>
        	<input type="text" name="guia" id="guia" class=" text ui-widget-content ui-corner-all" title="Guía"  placeholder="Guía" required />
	   
	   	<label for="importe" class="fieldset-margin-left">Importe </label>
        	<input type="text" name="importe" id="importe" class=" text ui-widget-content ui-corner-all" title="Importe"  placeholder="Importe" maxlength="10" pattern="^\d+\.\d{2}$" required  />
	   
		<input type="hidden" name="idcontrato" id="idcontrato" value="0" />
		<input type="hidden" name="idcli" id="idcli" value="0" />
		<input type="hidden" name="idper" id="idper" value="0" />
		<input type="hidden" name="iduser" id="iduser" value="0" />
		
    </fieldset>
    
    <fieldset>
        <input type="submit" value="Enviar" />
    </fieldset>
    
</form>

<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="addItem">Nuevo</button>
	<button id="delItem">Quitar</button>
	<button id="refreshTable">Actualizar</button>
	<button id="find">Buscar</button>
	<span id="spanTitle">Contratos</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="cliente">Cliente</th>
				<th class="total">Importe</th>
				<th class="fecha">fecha</th>
				<th class="guia">Guia</th>
				<th class="agente">Agente</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<style>
#tableList .item{width:100px; padding-top:5px;}
#tableList{display:inline; position:relative;}
.opItem{width:30px; margin-top:3px; background-color:#09F;}
#tableList .cliente,#tableList .agente{width:200px;}
#tableList .total{width:100px;}
#tableList .fecha{width:100px;}
#tableList .guia{width:400px;}
#tableList .money{ text-align:right; display:block; margin-right:1em !important;}
input[type='text'],input[type='tel'],input[type='mail']{ width:200px;}
.cssWidth250px{ width:250px !important;} 

/*
#toolbar{margin-top:1em; text-align:left; width:96% !important; margin-left:1.4em; margin-bottom:2em; padding: 1em 0.4em; }
#toolbar form #radio > h1{ display:inline; text-align:right; margin:0px; padding:0px; border:0; margin-left:10em;}
*/
#toolbar{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
.ui-autocomplete-loading { background: white url('../../images/img-web/ui-anim_basic_16x16.gif') right center no-repeat; }
.shrt{ width:50px !important} 
.btnPlusIcon{ background:url(../../images/img-web/plus-icon.png) top left no-repeat !important; margin-left:0.3em; width:16px; height:20px; line-height:18px; display:inline-block; cursor:pointer; }
</style>


<script type="text/javascript"> 

	var tipo          = 0;
	var index         = -1;
	var proc          = 2;
	var arrItems      = new Array();
	var arOrderBy     = [" idcontrato asc "," idcontrato desc "," cliente asc "," cliente desc "," total asc "," total desc "," fecha asc "," fecha desc "," descripcion asc "," descripcion desc "," agente asc "," agente desc "];
	var objInAuto     = ["clientes","_viPersonal"];
	var objInAutoId   = ["idcli","idper"];
	var objInAutoTerm = ["razon_social","nombre_completo"];
	var orderBy       = arOrderBy[1];
	var urlSearch     = obj.getValue(0)+"getSR/?o=";
	$("#tableList > tbody").html(getPreloader());
	
	$("#iduser").val(sessionStorage.Id);
	
	$("#users-contain").css("min-height",function(){
		var initHeight = $(window).height()-obj.height;
		return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
	});
	
	//$( "#fecha_inicial" ).datepicker({dateFormat:"dd/mm/yyyy",currentText: "Today" });
	//$( "#fecha_final"   ).datepicker({dateFormat:"dd/mm/yyyy",currentText: "Now" });

		
	$("#addItem").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		proc = 2;
		$('#formBody').clearForm();
		$('#formBody').resetForm();
		$("#idcontrato").val(0);
		$('td input[name="radio"]').each(function () {$(this).attr("checked",false);index = -1;});		
		orderBy="";
		var f = new Date();	
		var fecha = f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear()
		$( "#fecha_inicial").val(fecha);
		$( "#fecha_final"  ).val(fecha);
		$('#txtclientes').focus();
	});
	
	
	$("#delItem").on('click',function(event){
		event.preventDefault();
		proc = 2;
		eliminarRegistroActual();
		
	});
	
	$("#refreshTable").on('click',function(event){
		event.preventDefault();
		tablaDeElementos();
	});
	
	$("#find").on('click',function(event){
		event.preventDefault();
		buscarNombreCompleto();
	});

	$("#toolbar form #radio > h1").text("Tabla de "+obj.cat[obj.index].Catalogo); 
	$("#formBody > #h3 > #tituloForm").text(obj.cat[obj.index].Catalogo); 
	$("#radio").buttonset();

	// Operaciones con el Formulario 
	$('#formBody').submit(function() { 
    		$(this).ajaxSubmit({ beforeSubmit: validateForm, success: invocarFormulario }); 
     	return false; 
	});

	// Operaciones con el Formulario de Cambio de Password
	$('#form-find-data-proy').submit(function() {
    		$(this).ajaxSubmit({ success: tablaDeElementosFiltrados(this)}); 
     	return false; 
	});
	
	// Por Cadenas de Markov
	$(".item").on("click",function(){
		orderBy = orderBy == arOrderBy[0] ? arOrderBy[1]:arOrderBy[0];
		tablaDeElementos();
	});
	$(".cliente").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeElementos();
	});
	$(".total").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});
	$(".fecha").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});
	$(".descripcion").on("click",function(){
		orderBy = orderBy == arOrderBy[8] ? arOrderBy[9]:arOrderBy[8];
		tablaDeElementos();
	});

	$(".agente").on("click",function(){
		orderBy = orderBy == arOrderBy[10] ? arOrderBy[11]:arOrderBy[10];
		tablaDeElementos();
	});

	$.each(objInAuto, function(i, item) {
			var val  = item;
			var vals = item+"|"+objInAutoId[i]+"|"+objInAutoTerm[i];
			$("#txt"+val).autocomplete({source: urlSearch+i+"&s="+vals+"&t=1",minLength: 2,autoFocus:true,
				select:function(event,ui) {$("#"+objInAutoId[i]).val(ui.item.id);},
				change:function(event,ui) {$("#"+objInAutoId[i]).val(ui.item.id);}
			});
			$("#txt"+val).on("change",function(){
				$("#"+objInAutoId[i]).val(0);
			})
	});
	
	$("input[name='inicia_termina']:radio").bind("click",function(event){
		parseInt(event.currentTarget.value) == 0?$("#fechas").hide():$("#fechas").show();
	})

	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})
	$( "#find" ).button({text: true,icons: {primary: "ui-icon-search"}})

	tablaDeElementos();
	
	stream.on("servidor", jsNewReg);   


function jsNewReg(datosServer){
	if (datosServer.mensaje=="p4"){
		tablaDeElementos();
	}
}

function invocarFormulario(responseText, statusText, xhr, $form){
	//event.preventDefault();
 //alert($form); 
	//   return false;	
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $form.formSerialize(); 
	
	//alert(queryString);
	
	//return false;
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			if (json[0].msg=="OK"){
				$form.clearForm();
				$form.resetForm();
				tablaDeElementos();
				stream.emit("cliente", {mensaje: "p4"});
			}
 		}, "json"
	);
}

//Listado Registros Completos
function tablaDeElementos(){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	//alert(oBy+orderBy);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:7, p:3,c:oBy+orderBy },
		function(json){
			if (json.length<=0) { return false;alert("Error.");}
			cargarRegistrosLeidos(json);
 	}, "json");
}

//Listado Registros Completos
function tablaDeElementosFiltrados(form){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	var queryString = $(form).formSerialize(); 
	
	//alert(oBy+orderBy+"|"+queryString);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:8, p:3,c:oBy+orderBy+"|"+queryString },
		function(json){
			if (json.length==0) {$("#tableList > tbody").html("");	return false;}
			$(form).clearForm();
			$(form).resetForm();
			cargarRegistrosLeidos(json);
 	}, "json");
}


function cargarRegistrosLeidos(json){
	//event.preventDefault();
	$("#tableList tbody").html("");
	$.each(json, function(i, item) {

		var id=item.idcontrato;

		arrItems[i] = {idcontrato:item.idcontrato, idper:item.idper, idcli:item.idcli, inicia_termina:item.inicia_termina, 
					fecha_inicial:item.fecha_inicial, fecha_final:item.fecha_final, guia:item.guia, agente:item.agente, 
					cliente:item.cliente, importe:item.importe, descuento:item.descuento, iva:item.iva, total:item.total, 
					fecha_captura:item.fecha_captura
					};
		var str = "";
		
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		str +='<td><span>'+item.cliente+'</span></td>'; 
		str +='<td><span class="money">'+item.importe+'</span></td>'; 
		str +='<td><span>'+item.fecha_captura+'</span></td>'; 
		str +='<td><span>'+item.guia+'</span></td>'; 
		str +='<td><span>'+item.agente+'</span></td>'; 
		str +="</tr>";
		$("#tableList > tbody").append(str);	
	});
	index = -1;
	$(".money").formatCurrency({symbol:''});
	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
		$('td input[name="radio"]',this).attr("checked", true);
		editarRegistroActual();
	})
}


function editarRegistroActual(){
	//event.preventDefault();
	
	tipo = 1;

	$("#idcontrato").val(parseInt(arrItems[index].idcontrato));
	$("#idcli").val(parseInt(arrItems[index].idcli));
	$("#idper").val(parseInt(arrItems[index].idper));
	$("#txtclientes").val(arrItems[index].cliente);
	$("#txt_viPersonal").val(arrItems[index].agente);
	$("#fecha_inicial").val(arrItems[index].fecha_inicial);
	$("#fecha_final").val(arrItems[index].fecha_final);
	$("#guia").val(arrItems[index].guia);
	$("#importe").val(parseFloat(arrItems[index].importe).toFixed(2));

	switch(parseInt(arrItems[index].inicia_termina)){
		case 1:
		     $("#itS").attr("checked","checked");
			break;
		case 0:
		     $("#itN").attr("checked","checked");
			break;
	}
	parseInt(arrItems[index].inicia_termina) == 0?$("#fechas").hide():$("#fechas").show();
	
}

function eliminarRegistroActual(){
	event.preventDefault();
	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:180,
		modal: true,
		buttons: {
			"Eliminar registro": function() {
					tipo = 2;
					//invocarFormulario( $("#formBody") );
					$("#formBody").ajaxSubmit({ beforeSubmit: validateForm, success: invocarFormulario }); 
					$( this ).dialog( "close" );
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
}

function validateForm(formData, jqForm, options) { 
	//var rs           = $('input[name=razon_social]').fieldValue(); 
	var idcli          = $('input[name=idcli]').fieldValue(); 
	var idper          = $('input[name=idper]').fieldValue(); 

	var guia           = $('input[name=guia]').fieldValue(); 
	var fecha_inicial  = $('input[name=fecha_inicial]').fieldValue(); 
	var fecha_final    = $('input[name=fecha_final]').fieldValue(); 
	var inicia_termina = $('input[name=inicia_termina]').fieldValue(); 

	var importe           = $('input[name=importe]').fieldValue(); 

	var q = "";
	
	//alert(fecha_inicial[0]+" ::: "+fecha_final[0]);

	if (parseInt(idcli[0])     <=0 ){q="Falta el Cliente.";  }
		else if (parseInt(idper[0])   <=0 ){q="Falta el Agente";  }
		else if (parseInt(importe[0])   <=0 ){q="Falta el Importe";  }
			else if (!inicia_termina[0]){q="Selección una opción en Inicia-Termina";  }
			else if (!guia[0]) {q="Falta la guia";  }
			else if (!fecha_inicial[0]) {q="Falta la fecha inicial";  }
			else if (!fecha_final[0]) {q="Falta la fecha final";  }
			else if (!compare_dates(fecha_final[0],fecha_inicial[0]) && parseInt(inicia_termina[0])==1 ){q="La fecha final debe ser mayor o igual a la fecha inicial";}
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}else{
		return true;
	}
}

function buscarNombreCompleto(){
	$( "#dialog-form-cli" ).dialog({
		resizable: false,
		height:250,
		width:300,
		modal: true,
		buttons: {
			"Aceptar": function() {
					$("#form-find-data-proy").submit();
					$( this ).dialog( "close" );
			},
			Cancel: function() {
				$(this).clearForm();
				$(this).resetForm();
				$( this ).dialog( "close" );

			}
		}
	});
}

</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

<div id="dialog-form-cli" title="Buscar nombre" style="display:none;">

	<form id="form-find-data-proy">
	<br/><br/>
	<fieldset>
		<label for="datoc" class="findNameComplete">Dato</label>
		<input type="text" name="datoc" id="datoc" title="Buscar dato con: " maxlength="60" required min="4" 
			   placeholder="Escriba algunas palabras" value="" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="opciones" >Buscar por</label>
		<select name="opciones" id="opciones" size=1  value="" >
			<option value="cliente" selected >Cliente</option>
			<option value="agente"             >Agente</option>
			<option value="guia"             >Guía</option>
			<option value="idcontrato"             >ID</option>
	   	</select><br/><br/>
		<label for="crit" >Criterio</label>
		<select name="crit" id="crit" size=1  value="" >
			<option value="0" selected >En cualquier parte</option>
			<option value="1"             >Al inicio</option>
			<option value="2"             >Al final</option>
	   	</select>
			   
	</fieldset>
	</form>
</div>
