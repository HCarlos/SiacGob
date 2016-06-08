
<div id="msgResponse"></div>
<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all">
	<span class="ui-icon ui-icon-contact"></span>
	<span id="tituloForm">...</span>
</div>


	<fieldset>
		<label for="app">Ap. Paterno</label>
        	<input type="text" name="app" id="app" title="Ap. Parterno" maxlength="20" placeholder="Ap. Paterno" autofocus required/>
		<label for="apm" class="fieldset-margin-left">Ap. Materno</label>
        	<input type="text" name="apm" id="apm" title="Ap. Marterno" maxlength="20" placeholder="Ap. Materno" required/>
		<label for="nombre" class="fieldset-margin-left">Nombre</label>
        	<input type="text" name="nombre" id="nombre" title="Nombre" maxlength="20" placeholder="Nombre" required/>
	</fieldset>	
     
	<fieldset>
	   <label for="tel">Teléfono (opcional)</label>
        <input type="tel" name="tel" id="tel" title="Teléfono" maxlength="20" placeholder="(999)999-9999" pattern="[\(]\d{3}[\)]\d{3}[\-]\d{4}"/>
	   <label for="cel" class="fieldset-margin-left">Celular </label>
        <input type="tel" name="cel" id="cel" title="Celular" maxlength="20" placeholder="(999)999-9999"  pattern="[\(]\d{3}[\)]\d{3}[\-]\d{4}"/>
        <label for="mail" class="fieldset-margin-left">E-Mail</label>
        <input type="email" name="mail" id="mail" title="Correo electrónico" maxlength="50" placeholder="Correo Electrónico" />
	</fieldset>	
	
	<fieldset>
        	<label for="f_alta">Fecha de Alta</label>
        	<input type="date" name="f_alta" id="f_alta" title="Fecha de Alta" maxlength="12"  value="<?php echo date('Y-m-d'); ?>"/>
		
		<label class="fieldset-margin-left">Sexo: </label>            
		
		<input type = "radio" name = "sexo" id = "sexoF" value = "F"/>
          <label for = "sexoF">Femenino</label>
          
          <input type = "radio" name = "sexo" id = "sexoM" value = "M" />
          <label for = "sexoM">Masculino</label>
 
	</fieldset>	


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
</div>



<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="username">Nombre Completo</th>
				<th class="cel">Celular</th>
				<th class="email">E-Mail</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<style>
#tableList .item{width:100px; padding-top:5px;}
.opItem{width:30px; margin-top:3px; background-color:#09F;}
#tableList .username{width:200px;}
#tableList .cel{width:100px;}
#tableList .email{width:200px;}
#tableList .areas{width:100px;}
#tableList .grupos{width:100px;}
input[type='text'],input[type='tel'],input[type='mail']{ width:135px;}
/*
#toolbar{margin-top:1em; text-align:left; width:96% !important; margin-left:1.4em; margin-bottom:2em; padding: 1em 0.4em; }
#toolbar form #radio > h1{ display:inline; text-align:right; margin:0px; padding:0px; border:0; margin-left:10em;}
*/
#toolbar{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden; height:41% !important; text-align:left; }
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
</style>


<script type="text/javascript"> 

	var tipo      = 0;
	var index     = -1;
	var proc      = 2;
	var arrItems  = new Array();
	var arOrderBy = [" idper asc "," idper desc "," nombre_completo asc "," nombre_completo desc "," cel asc "," cel desc "," mail asc "," mail desc "];
	var orderBy   = " idper desc ";

	$("#iduser").val(sessionStorage.Id);
	
	$("#tableList > tbody").html(getPreloader());	

	
	$("#addItem").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		proc = 2;
		$('#formBody').clearForm();
		$('#formBody').resetForm();
		$("#idper").val(0);
		$('td input[name="radio"]').each(function () {$(this).attr("checked",false);index = -1;});		
		orderBy="";
		$('#app').focus();
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
    		$(this).ajaxSubmit({ beforeSubmit: validateForm, success: invocarFormulario(this) }); 
     	return false; 
	});

	// Operaciones con el Formulario de Cambio de Password
	$('#form-find-data').submit(function() {
    		$(this).ajaxSubmit({ success: tablaDeElementosFiltrados}); 
     	return false; 
	});

	// Por Cadenas de Markov
	$(".item").on("click",function(){
		orderBy = orderBy == arOrderBy[0] ? arOrderBy[1]:arOrderBy[0];
		tablaDeElementos();
	});
	$(".username").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeElementos();
	});
	$(".cel").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});
	$(".email").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});
	
	tablaDeElementos();
	
	stream.on("servidor", jsNewReg);   


function jsNewReg(datosServer){
	if (datosServer.mensaje=="D1"){
		tablaDeElementos();
	}
}
function invocarFormulario(form){
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $('#formBody').formSerialize(); 
	//alert(queryString);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			if (json[0].msg=="OK"){
				$(form).clearForm();
				$(form).resetForm();
				tablaDeElementos();
				stream.emit("cliente", {mensaje: "D1"});
			}
 		}, "json"
	);
}

//Listado Registros Completos
function tablaDeElementos(){
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:1, p:3,c:oBy+orderBy },
		function(json){
			if (json.length<=0) { return false;alert("Error.");}
			cargarRegistrosLeidos(json);
 	}, "json");
}

//Listado Registros Completos
function tablaDeElementosFiltrados(responseText, statusText, xhr, $form){
	event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	var queryString = $form.formSerialize(); 
	
	//alert(oBy+orderBy+"|"+queryString);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:2, p:3,c:oBy+orderBy+"|"+queryString },
		function(json){
			if (json.length==0) {$("#tableList > tbody").html("");	return false;}
			$form.clearForm();
			$form.resetForm();
			cargarRegistrosLeidos(json);
 	}, "json");
}


function cargarRegistrosLeidos(json){
	$("#tableList tbody").html("");
	$.each(json, function(i, item) {
		var id=item.idper;
		arrItems[i] = {idper:item.idper, nombre_completo:item.nombre_completo, app:item.app, apm:item.apm, nombre:item.nombre, tel:item.tel, cel:item.cel, mail:item.mail, f_alta:item.f_alta, sexo:item.sexo, areas:item.areas, grupos:item.grupos};
		var str = "";
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		str +='<td><span>'+item.nombre_completo+'</span></td>'; 
		str +='<td><span>'+item.cel+'</span></td>'; 
		str +='<td><span>'+item.mail+'</span></td>'; 
		str +="</tr>";
		$("#tableList > tbody").append(str);	
	});
	index = -1;
	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
		$('td input[name="radio"]',this).attr("checked", true);
		editarRegistroActual();
	})
}


function editarRegistroActual(){
	tipo = 1;

	$("#idper").val(arrItems[index].idper);
	$("#nombre").val(arrItems[index].nombre);
	$("#app").val(arrItems[index].app);
	$("#apm").val(arrItems[index].apm);
	$("#tel").val(arrItems[index].tel);
	$("#cel").val(arrItems[index].cel);
	$("#mail").val(arrItems[index].mail);
	$("#f_alta").val(arrItems[index].f_alta);
	//$("#sexo").val(arrItems[index].sexo);
	switch(arrItems[index].sexo){
		case "F":
		     $("#sexoF").attr("checked","checked");
			break;
		case "M":
		     $("#sexoM").attr("checked","checked");
			break;
	}
}

function eliminarRegistroActual(){
	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:180,
		modal: true,
		buttons: {
			"Eliminar registro": function() {
					tipo = 2;
					invocarFormulario( $("#formBody") );
					$( this ).dialog( "close" );
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
}

function validateForm(formData, jqForm, options) { 
	var nombre = $('input[name=nombre]').fieldValue(); 
	var app = $('input[name=app]').fieldValue(); 
	var apm   = $('input[name=apm]').fieldValue(); 
	var sexo   = $('input[name=sexo]').fieldValue(); 
	var fecha = $('input[name=f_alta]').fieldValue(); 
	
	var q = "";

	if (!nombre[0]){q="Proporcione un nombre";  }
		else if (!app[0]){q="Falta Apellido Paterno";  }
			else if (!apm[0]){q="Falta Apellido Materno";  }
				else if (!sexo[0]){q="Falta el Sexo";  }
				else if (!fecha[0]){q="Falta la Fecha";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}
}

$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})
$( "#find" ).button({text: true,icons: {primary: "ui-icon-search"}})
	   

function buscarNombreCompleto(){
	$( "#dialog-form" ).dialog({
		resizable: false,
		height:250,
		width:300,
		modal: true,
		buttons: {
			"Aceptar": function() {
					tipo = 2;
					proc = 3
					$("#form-find-data").submit();
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

<div id="dialog-form" title="Buscar nombre" style="display:none;">

	<form id="form-find-data">
	<br/><br/>
	<fieldset>
		<label for="nombrec" class="findNameComplete">Nombre</label>
		<input type="text" name="nombrec" id="nombrec" title="Buscar los Nombres con: " maxlength="60" required min="4" 
			   placeholder="Escriba algunas palabras" value="" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="opciones" >Buscar por</label>
		<select name="opciones" id="opciones" size=1  value="" >
			<option value="nombre" selected >Nombre</option>
			<option value="app"             >Apellido Paterno</option>
			<option value="apm"             >Apellido Materno</option>
			<option value="tel"             >Teléfono</option>
			<option value="cel"             >Celular</option>
			<option value="mail"            >E-Mail</option>
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


