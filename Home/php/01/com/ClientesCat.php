
<div id="msgResponse"></div>
<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all">
	<span class="ui-icon ui-icon-contact"></span>
	<span id="tituloForm">...</span>
</div>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Datos Generales</a></li>
		<li><a href="#tabs-2">Otros Datos</a></li> 
	</ul>
	<div id="tabs-1">
	<fieldset>
		<label for="app_rs">Ap. Paterno</label>
        	<input type="text" name="app_rs" id="app_rs" class="text ui-widget-content ui-corner-all"  maxlength="30" min="4" autofocus />

		<label for="apm_rs" class="fieldset-margin-left">Ap. Materno</label>
        	<input type="text" name="apm_rs" id="apm_rs" class="text ui-widget-content ui-corner-all"  maxlength="30" min="4"  />

		<label for="nombre_rs" class="fieldset-margin-left">Nombre</label>
        	<input type="text" name="nombre_rs" id="nombre_rs" class="text ui-widget-content ui-corner-all" maxlength="30" min="4"  />
	</fieldset>
	   
	<fieldset>
	   	<label for="txtcalle">Calle </label>
        	<input type="text" name="txtcalle" id="txtcalle" class="text ui-widget-content ui-corner-all" required /><span id="spn-calle" class="btnPlusIcon" title="Agregar otra Calle"></span>
	   
	   	<label for="num_externo" class="fieldset-margin-left">Num. Externo </label>
        	<input type="text" name="num_externo" id="num_externo" class="shrt text ui-widget-content ui-corner-all"/>
	   
	   	<label for="num_interno" class="fieldset-margin-left">Num. Interno </label>
        	<input type="text" name="num_interno" id="num_interno" class="shrt text ui-widget-content ui-corner-all"/>

	</fieldset>
	   
	<fieldset>
	   	<label for="txtcolonia">Colonia </label>
        	<input type="text" name="txtcolonia" id="txtcolonia" class="text ui-widget-content ui-corner-all" required /><span id="spn-colonia" class="btnPlusIcon" title="Agregar otra Colonia"></span>

	   	<label for="txtlocalidad" class="fieldset-margin-left">Localidad </label>
        	<input type="text" name="txtlocalidad" id="txtlocalidad" class="text ui-widget-content ui-corner-all" required /><span id="spn-localidad" class="btnPlusIcon" title="Agregar otra Localidad"></span>

	   	<label for="idcodpos" class="fieldset-margin-left">C.P.</label>
        	<input type="number" name="idcodpos" id="idcodpos" class="shrt text ui-widget-content ui-corner-all" maxlength="5"/>
	</fieldset>
	
		</div>
	<div id="tabs-2">

	<fieldset>
	   	<label for="tel1">Tel 1</label>
        	<input type="tel" name="tel1" id="tel1" class="text ui-widget-content ui-corner-all"/>

	   	<label for="cel1" class="fieldset-margin-left">Celular </label>
        	<input type="tel" name="cel1" id="cel1" class="text ui-widget-content ui-corner-all"/>

	   	<label for="cel2" class="fieldset-margin-left">SMS </label>
        	<input type="tel" name="cel2" id="cel2" class="text ui-widget-content ui-corner-all"/>

        	<label for="email" class="fieldset-margin-left">E-Mail</label>
        	<input type="email" name="email" id="email" class="text ui-widget-content ui-corner-all" pattern="^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$" />
	</fieldset>
	<fieldset>
	   	<label for="razon_social">Razón Social: </label>
        	<input type="text" name="razon_social" id="razon_social" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	<fieldset>
		<label for="sexo">Sexo: </label>
		<Select name="sexo" id="sexo" size=1 > 
				<OPTION VALUE="0" selected >Seleccione un valor</OPTION>
				<OPTION VALUE="1"  >Hombre</OPTION>
				<OPTION VALUE="2"  >Mujer</OPTION>
		</select>
		
		<label for="idcategoria" class="fieldset-margin-left">Categoria: </label>
		<Select name="idcategoria" id="idcategoria" size=1 > 
		</select><span id="spn-clientes_categorias-categoria" class="btnPlusIcon2" title="Agregar otra Categoria"></span>

	   	<label for="representante" class="fieldset-margin-left">Desc. Pto.: </label>
        	<input type="text" name="representante" id="representante" class="text ui-widget-content ui-corner-all" /> 

	</fieldset>
	</div>

		<input type="hidden" name="idcli"       id="idcli" value="0" />
		<input type="hidden" name="idcalle"     id="idcalle" value="0" />
		<input type="hidden" name="idcolonia"   id="idcolonia" value="0" />
		<input type="hidden" name="idlocalidad" id="idlocalidad" value="0" />
		<input type="hidden" name="idciudad"    id="idciudad" value="1" />
		<input type="hidden" name="idmunicipio" id="idmunicipio" value="1" />
		<input type="hidden" name="idestado"    id="idestado" value="1" />
		<input type="hidden" name="idpais"      id="idpais" value="1" />
		<input type="hidden" name="iduser"      id="iduser" value="0" />
        
    <fieldset class="formContract">
        <input type="submit" id="cmdSave" name="cmdSave" value="Guardar" />
	   <span id="obspan">Capturar todo en mayúscula y sin acentos</span>
    </fieldset>
</div>
    
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
				<th class="nombrec">Nombre Completo</th>
				<th class="tel1">Teléfono</th>
				<th class="cel1">Celular</th>
				<th class="dependencia">Capturado por</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr class="ui-widget-header borderBottom">
				<td colspan="8"> <span id="oPagination">  </span> </td>
			</tr>
		</tfoot>
	</table>
</div>

<style>
#tableList .item{width:100px; padding-top:5px;}
#tableList{display:inline; position:relative;}
.opItem{width:30px; margin-top:3px; background-color:#09F;}
#tableList .tel1{width:80px;}
#tableList .cel1{width:80px;}
#tableList .nombrec{width:200px;}
#tableList .dependencia{width:300px;}
#obspan{position:relative; float:right; font-size:9px;}
.formContract{width:96% !important; padding:0 1em !important; }

input[type='text']{ width:100px;}
input[type='tel']{ width:80px;}
.cssWidth250px{ width:250px !important;} 
.dat_rs{ margin-left:1em !important;}
input[name='email']{ width:220px !important;}

#toolbar{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
#razon_social{width:40% !important;} 
#representante{width:22% !important;}
.ui-autocomplete-loading { background: white url('../../images/img-web/ui-anim_basic_16x16.gif') right center no-repeat; }
.shrt{ width:50px !important} 
.btnPlusIcon, .btnPlusIcon2{ background:url(../../images/img-web/plus-icon.png) top left no-repeat !important; margin-left:0.3em; width:16px; height:20px; line-height:18px; display:inline-block; cursor:pointer; }
.findNameComplete{ margin-bottom:0.2em !important;}
#users-contain{ overflow-y:scroll;}
</style>


<script type="text/javascript"> 

	var tipo      = 0;
	var index     = -1;
	var proc      = 2;
	var arrItems  = new Array();
	var arOrderBy = [" idcli asc "," idcli desc "," nombrec asc "," nombrec desc "," tel1 asc "," tel1 desc "," cel1 asc "," cel1 desc "," dependencia asc "," dependencia desc "];
	var objInAuto = ["calle","colonia","localidad","categoria"];
	var orderBy   = arOrderBy[1];
	var urlSearch = obj.getValue(0)+"getSR/?o=";
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:10};
	var idcli     = 0;
	var agregadoen = 10;
	
	$("#dat_rs1").hide();    

	var xc = obj.getMinHeight()-($("#formBody").height()+$("#toolbar").height()+60);
	$("#users-contain").height(xc);

	$("#iduser").val(sessionStorage.Id);
	var iduser = sessionStorage.Id;
	if (!obj.getUser(11)){
		$("#delItem").hide();
	}	

		if (!obj.getUser(17)){
		$("#pn-clientes_categorias-categoria").hide();
	}	

	$("#tableList > tbody").html(getPreloader());


     $(".btnPlusIcon").on("click",function(event){
		var id = event.currentTarget.id.split("-");
		agregarDomFis(id[1],event.currentTarget.title);	
	});
	
     $(".btnPlusIcon2").on("click",function(event){
		var id = event.currentTarget.id.split("-");
		agregarDomFis2(id[1],event.currentTarget.title,id[2]);	
	});

	$.each(objInAuto, function(i, item) {
		var val = item;
		$("#txt"+val).keypress(function(event) {
  			if ( event.which == 17 ) {
				var o = event.currentTarget.id.substr(3,event.currentTarget.id.length-3);
				var id = $("#spn-"+o);
				agregarDomFis(o,id.attr("title"));	
  		 	}
		});
	});
	
		
	$("#addItem").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		proc = 2;
		$('#formBody').clearForm();
		$('#formBody').resetForm();
		$("#idcli").val(0);
		$('td input[name="radio"]').each(function () {$(this).attr("checked",false);index = -1;});		
		orderBy="";
		idcli = 0;
		$('#app_rs').focus();
	});
	
	
	$("#delItem").on('click',function(event){
		event.preventDefault();
		proc = 2;
		eliminarRegistroActual();
		
	});
	
	$("#refreshTable").on('click',function(event){
		event.preventDefault();
		oPag.currentPage=0;
		getPag2(idcli,"clientes","idcli", oPag,4,-1,20);
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
	$('#form-find-data-cli').submit(function() {
    		$(this).ajaxSubmit({ success: tablaDeElementosFiltrados}); 
     	return false; 
	});
	
	
	// Operaciones con el Formulario de Cambio de Password
	$('#form-find-data-add-dom').submit(function() {
    		$(this).ajaxSubmit({success: invocarFormularioDomFis(this)}); 
     	return false; 
	});

	// Por Cadenas de Markov
	$(".item").on("click",function(){
		orderBy = orderBy == arOrderBy[0] ? arOrderBy[1]:arOrderBy[0];
		tablaDeElementos();
	});
	$(".nombrec").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeElementos();
	});
	$(".tel1").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});
	$(".cel1").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});
	$(".dependencia").on("click",function(){
		orderBy = orderBy == arOrderBy[8] ? arOrderBy[9]:arOrderBy[8];
		tablaDeElementos();
	});

	$.each(objInAuto, function(i, item) {
			var val = item;
			$("#txt"+val).autocomplete({source: urlSearch+i+"&s="+val,minLength: 2,autoFocus:true,
				select:function(event,ui) {$("#id"+val).val(ui.item.id);},
				change:function(event,ui) {$("#id"+val).val(ui.item.id);}
			});
			$("#txt"+val).on("change",function(){
				$("#id"+val).val(0);
				//alert($("#id"+val).val());
			})
	});

	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})
	$( "#find" ).button({text: true,icons: {primary: "ui-icon-search"}})


	$("#tabs").tabs({
    		show: function(event, ui) {
			switch(ui.panel.id){
				case "tabs-1":
					$('#app_rs').focus();
					break;
				case "tabs-2":
					$('#tel1').focus();
					break;
			}	
    		}
	});
	

function sayPintaPaginacion(oPag){
	$("#oPagination").html("");
	for (var i=0;i<oPag.totalPaginas;i++){
		var j = i+1;
		var clasebase = i==0?'oPagBold':'';
		$("#oPagination").append("<a id='oPA-"+i+"' class='oPag "+ clasebase +"'>"+j+"</a>");
	}
	$(".oPag").on("click",function(event){
		var id = event.currentTarget.id
		var arr = id.split("-");
		oPag.currentPage=arr[1]*oPag.CantidadPagina;
		$(".oPag").removeClass('oPagBold');
		$(".oPag").addClass('oPagNormal');
		$("#"+id).addClass('oPagBold');
		tablaDeElementos();
	}); 
}
	



function jsNewReg(datosServer){
	if (datosServer.mensaje=="D2"){
		if (index <= 0){
		   tablaDeElementos();
		}
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
				if (tipo == 0 || tipo == 2){
				   getPag2(idcli,"clientes","idcli", oPag,4,-1,20);
				}
				stream.emit("cliente", {mensaje: "D2"});
			}
 		}, "json"
	);
}

//Listado Registros Completos
function tablaDeElementos(){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:21, p:4,c:oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina   },
		function(json){
			if (json.length<=0) { return false;alert("Error.");}
			cargarRegistrosLeidos(json);
 	}, "json");
}

//Listado Registros Completos
function tablaDeElementosFiltrados(responseText, statusText, xhr, $form){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	var queryString = $form.formSerialize(); 
	
	//alert(oBy+orderBy+"|"+queryString);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:22, p:4,c:oBy+orderBy+"|"+queryString,from:oPag.currentPage, cantidad:oPag.CantidadPagina   },
		function(json){
			if (json.length==0) {$("#tableList > tbody").html("");	return false;}
			//$(form).clearForm();
			//$(form).resetForm();
			
			$form.clearForm();
			$form.resetForm();
			
			//alert(parseInt(json[0].registros));
			$("#oPagination").html(json[0].registros+" registros encontrados");

			cargarRegistrosLeidos(json);
 	}, "json");
}


function cargarRegistrosLeidos(json){
	//event.preventDefault();
	$("#tableList tbody").html("");
	$.each(json, function(i, item) {
		var id=item.idcli;

		arrItems[i] = {idcli:item.idcli, idcalle:item.idcalle, num_externo:item.num_externo, 
					num_interno:item.num_interno, idcolonia:item.idcolonia, idlocalidad:item.idlocalidad, idciudad:item.idciudad,
					idmunicipio:item.idmunicipio, idestado:item.idestado, idpais:item.idpais, idcodpos:item.idcodpos, tel1:item.tel1, 
					cel1:item.cel1, cel2:item.cel2, email:item.email, calle:item.calle, colonia:item.colonia, ciudad:item.ciudad, 
					localidad:item.localidad,municipio:item.municipio, estado:item.estado, pais:item.pais, 
					app_rs:item.app_rs, apm_rs:item.apm_rs, nombre_rs:item.nombre_rs, nombrec:item.nombrec, 
					razon_social:item.razon_social, representante:item.representante, idcategoria:item.idcategoria,
					sexo:item.sexo, csexo:item.csexo,dependencia:item.dependencia
					};
		var str = "";
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		str +='<td><span>'+item.nombrec+'</span></td>'; 
		str +='<td><span>'+item.tel1+'</span></td>'; 
		str +='<td><span>'+item.cel1+'</span></td>'; 
		str +='<td><span>'+item.dependencia+'</span></td>'; 
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
	//event.preventDefault();
	
	tipo = 1;
	
     $("#app_rs").val("");
     $("#apm_rs").val("");
     $("#nombre_rs").val("");
	
	idcli = parseInt(arrItems[index].idcli);

	$("#idcli").val(parseInt(arrItems[index].idcli));
	$("#nombrec").val(arrItems[index].nombre_comercial);
	$("#num_externo").val(arrItems[index].num_externo);
	$("#num_interno").val(arrItems[index].num_interno);
	$("#idcolonia").val(parseInt(arrItems[index].idcolonia));
	$("#idlocalidad").val(parseInt(arrItems[index].idlocalidad));
	$("#idciudad").val(parseInt(arrItems[index].idciudad));
	$("#idmunicipio").val(parseInt(arrItems[index].idmunicipio));
	$("#idestado").val(parseInt(arrItems[index].idestado));
	$("#idcalle").val(parseInt(arrItems[index].idcalle));
	$("#idpais").val(parseInt(arrItems[index].idpais));
	$("#idcodpos").val(arrItems[index].idcodpos);
	$("#tel1").val(arrItems[index].tel1);
	$("#cel1").val(arrItems[index].cel1);
	$("#cel2").val(arrItems[index].cel2);
	$("#email").val(arrItems[index].email);
	$("#txtcalle").val(arrItems[index].calle);
	$("#txtcolonia").val(arrItems[index].colonia);
	$("#txtlocalidad").val(arrItems[index].localidad);
	$("#representante").val(arrItems[index].representante);
	
	$('select[name="sexo"]').val(parseInt(arrItems[index].sexo))
	$('select[name="idcategoria"]').val(parseInt(arrItems[index].idcategoria))
		
     $("#app_rs").val(arrItems[index].app_rs);
     $("#apm_rs").val(arrItems[index].apm_rs);
     $("#nombre_rs").val(arrItems[index].nombre_rs);
     $("#razon_social").val(arrItems[index].razon_social);
	
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
	var app_rs     = $('input[name=app_rs]').fieldValue(); 
	var apm_rs     = $('input[name=apm_rs]').fieldValue(); 
	var nombre_rs  = $('input[name=nombre_rs]').fieldValue(); 

	var txtcalle     = $('input[name=txtcalle]').fieldValue(); 
	var txtcolonia   = $('input[name=txtcolonia]').fieldValue(); 
	var txtlocalidad = $('input[name=txtlocalidad]').fieldValue(); 
	var idcalle      = $('input[name=idcalle]').fieldValue(); 
	var idcolonia    = $('input[name=idcolonia]').fieldValue(); 
	var idlocalidad  = $('input[name=idlocalidad]').fieldValue(); 
	
	var q = "";

	if (parseInt(idcalle[0])     <=0 ){q="Falta la Calle.";  }
		else if (parseInt(idcolonia[0])   <=0 ){q="Falta la Colonia.";  }
		else if (parseInt(idlocalidad[0]) <=0 ){q="Falta la Localidad.";  }
			else if (!txtcalle[0]) {q="Falta la Calle";  }
			else if (!txtcolonia[0]){q="Falta la Colonia";  }
				else if (!txtlocalidad[0]){q="Falta la Localidad";  }
				else if (!app_rs[0]){q="Falta el Ap Paterno";  }
				else if (!apm_rs[0]){q="Falta el Ap Materno";  }
				else if (!nombre_rs[0]){q="Falta el Nombre";  }
  
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
				     var id = $("#datoc").val();
				     $("#form-find-data-cli > fieldset > input[name=datoc]" ).val(id);

					$("#form-find-data-cli").submit();
						//$(this).clearForm();
						//$(this).resetForm();
					$( this ).dialog( "close" );
			},
			"Cerrar": function() {
				$(this).clearForm();
				$(this).resetForm();
				$( this ).dialog( "close" );

			}
		}
	});
}



function agregarDomFis(id,title){
	
	agregadoen = 10;
	
	$( "#form-find-data-add-dom label" ).text(id);
	$( "#form-find-data-add-dom input[name='datofis']" ).attr({"placeholder":title,"title":title});
	$( "#form-find-data-add-dom input[name='iddomfis']" ).val(id);
	
	$( "#dialog-form-add-dom").dialog({
		resizable: false,
		height:250,
		width:200,
		title:title,
		modal: true,
		buttons: {
			"Aceptar": function() {
					$("#form-find-data-add-dom").submit();
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

function agregarDomFis2(id,title,campo){
	
	agregadoen = 11;
	
	$( "#form-find-data-add-dom label" ).text(id);
	$( "#form-find-data-add-dom input[name='datofis']" ).attr({"title":title});
	$( "#form-find-data-add-dom input[name='iddomfis']" ).val(id);
	$( "#form-find-data-add-dom input[name='namecolumn']" ).val(campo);
	
	
	$( "#dialog-form-add-dom").dialog({
		resizable: false,
		height:300,
		width:460,
		title:title,
		modal: true,
		buttons: {
			"Aceptar": function() {
					$("#form-find-data-add-dom").submit();
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

<!--<iframe src="http://www.ustream.tv/embed/13056447" width="616" height="356" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>-->


//Agrega un dato fiscal a la DB
function invocarFormularioDomFis(form){
	var queryString = $(form).formSerialize(); 
	
	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, c:queryString, t:agregadoen, p:1 },
 	function(json){
		var q = json[0].msg;
		sayMessage(json[0].msg,"Ocurrió un "+q,$("#msgResponse"),"Dato agregado con éxito");
		$(form).clearForm();
		$(form).resetForm();
		return false;
 	}, "json");
}

function getCategorias(){
	var lbl;
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:3, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$.each(json, function(i, item) {
				$('select[name="idcategoria"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
	}, "json");

}


getCategorias();

getPag2(idcli,"clientes","idcli", oPag,4,-1,20);
tablaDeElementos();

stream.on("servidor", jsNewReg);   


$.post(obj.getValue(0)+"getEC/", { o:-1, t:0, p:0,c:iduser },
	function(json){
		if (json.length>0) {
			var iduseri = parseInt(json[0]);
			var iddep   = parseInt(json[1]);
			$('#delItem').hide();
			$('#cmdSave').hide();
			if (iddep == 4 || iddep == 8 || iddep == 9 || iddep == 19 || iddep == 20 || 
			    iddep == 22 || iddep == 23 || iddep == 36 || iddep == 40 ){
				$('#delItem').show();
				$('#cmdSave').show();
			}
			//Para NOLAN y MHERNANDEZ
			if (iduseri == 54 || iduseri == 92){
				$('#cmdSave').show();
			}
			//Para Birene
			/*
			if (iduseri == 54 || iduseri == 92){
				$('#cmdSave').show();
			}
			*/
			
		}
 }, "json");


</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

<div id="dialog-form-cli" title="Buscar nombre" style="display:none;">

	<form id="form-find-data-cli">
	<br/><br/>
	<fieldset>
		<label for="datoc" class="findNameComplete">Dato</label>
		<input type="text" name="datoc" id="datoc" title="Buscar dato con: " maxlength="60" required min="4" 
			   placeholder="Escriba algunas palabras" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="opciones" >Buscar por</label>
		<select name="opciones" id="opciones" size=1  value="" >
			<option value="nombrec" selected >Nombre Completo</option>
			<option value="email"             >E-Mail</option>
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

<div id="dialog-form-add-dom" style="display:none;">

	<form id="form-find-data-add-dom">
	<br/><br/>
	<fieldset>
		<label class="findNameComplete"></label>
		<input type="text" maxlength="160" required min="4" 
			   value="" name="datofis" id="datofis" class="text ui-widget-content ui-corner-all" />
		<input type="hidden" name="iddomfis" id="iddomfis" />	   
		<input type="hidden" name="namecolumn" id="namecolumn" />	   
	</fieldset>
	</form>
</div>




