
<div id="msgResponse"></div>
<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all">
	<span class="ui-icon ui-icon-contact"></span>
	<span id="tituloForm">...</span>
</div>
	<fieldset>	
		<label for="producto">Producto</label>
        	<input type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all cssWidth250px" title="Producto" maxlength="150" min="4" placeholder="Nombre Comercial" autofocus required/>
	
		<label for="idmedida" class="fieldset-margin-left" >Unidades</label>
		<select name="idmedida" id="idmedida" size=1  value="0" > 
	   	</select><span id="spn-medidas-medida" class="btnPlusIcon" title="Otra U. de Medida"> </span>
	</fieldset>
	<fieldset>
		<label for="idprodgpo" class="fieldset-margin-left" >Dependencia</label>
		<select name="idprodgpo" id="idprodgpo" size=1  value="0"  > 
	   	</select><span id="spn-productos_grupo-prodgpo" class="btnPlusIcon" title="Agregar otra Dependencia"> </span>
	</fieldset>
        
    <fieldset>
        <input type="submit" value="Guardar" />
		<input type="hidden" name="idprod"       id="idprod" value="0" />
		<input type="hidden" name="iduser"      id="iduser" value="0" />
		<input type="hidden" name="iddep"      id="iddep" value="0" />
    </fieldset>
    
</form>

<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="addItem">Nuevo</button>
	<button id="delItem">Quitar</button>
	<button id="refreshTable">Actualizar</button>
	<button id="find">Buscar</button>
	<span id="spanTitle">Servicios</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="producto">Producto</th>
				<th class="medida">Medida</th>
				<th class="grupo">Grupo</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr class="ui-widget-header borderBottom">
				<td colspan="8"> <span id="oPagination"></span> </td>
			</tr>
		</tfoot>
		
	</table>
</div>

<style>
#tableList .item{width:100px; padding-top:5px;}
#tableList{display:inline; position:relative;}
.opItem{width:30px; margin-top:3px; background-color:#09F;}
#tableList .producto{width:200px;}
#tableList .medida{width:250px;}
#tableList .grupo{width:250px;}
.cssWidth250px{ width:250px !important;} 
#tableList .money{ text-align:right; display:block; margin-right:1em !important;}

#toolbar{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
.ui-autocomplete-loading { background: white url('../../images/img-web/ui-anim_basic_16x16.gif') right center no-repeat; }
.shrt{ width:50px !important} 
.btnPlusIcon{ background:url(../../images/img-web/plus-icon.png) top left no-repeat !important; margin-left:0.3em; width:16px; height:20px; line-height:18px; display:inline-block; cursor:pointer; }
input[name='datofis']{width:90% !important;}
.findNameComplete{ margin-bottom:0.2em !important;}
#users-contain{ overflow-y:scroll;}
</style>


<script type="text/javascript"> 

	var tipo      = 0;
	var index     = -1;
	var proc      = 2;
	var iduser    = 0;
	var arrItems  = new Array();
	var arOrderBy = [" idprod asc "," idprod desc "," producto asc "," producto desc "," medida asc "," medida desc "," grupo asc "," grupo desc "];
	//var objInAuto = ["producto","colonia","localidad","categoria"];
	var orderBy   = arOrderBy[1];
	var urlSearch = obj.getValue(0)+"getSR/?o=";
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:10};
	var idproducto = 0;

	$("#tableList > tbody").html(getPreloader());

	var xc = obj.getMinHeight()-($("#formBody").height()+$("#toolbar").height()+60);
	$("#users-contain").height(xc);
	
	$("#iduser").val(sessionStorage.Id);
	var iduser = sessionStorage.Id;
	
	if (!obj.getUser(12)){
		$("#delItem").hide();
	}	
	

	//Listado del Combo de Medidas
function getMedidas(){	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:200, p:0 },
		function(json){
			if (json.length<=0) { return false;}
				$("select[name='idmedida']").html('<OPTION VALUE="0" selected >Seleccione una opción</OPTION>');	
				$.each(json, function(i, item) {
					$('select[name="idmedida"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
				});
 		}, "json"
	);
}

	//Listado del Combo de Grupos
function getProductos(){	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:300, p:0 },
		function(json){
			if (json.length<=0) { return false;}
				$("select[name='idprodgpo']").html('<OPTION VALUE="0" selected >Seleccione una opción</OPTION>');	
				$.each(json, function(i, item) {
					$('select[name="idprodgpo"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
				});
				pintaData();
 		}, "json"
	);
}

$('select[name="idprodgpo"]').on('change',function(event){
	$('input[name=iddep]').val(parseInt(event.currentTarget.value));
});
	
	$("#users-contain").css("height",function(){
		var initHeight = $(window).height()-obj.height;
		return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
	});
		
	$("#addItem").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		proc = 2;
		idproducto = 0;
		$('#formBody').clearForm();
		$('#formBody').resetForm();
		$("#idprod").val(0);
		$('td input[name="radio"]').each(function () {$(this).attr("checked",false);index = -1;});		
		orderBy   = arOrderBy[1];
		$('#producto').focus();
	});
	
	
	$("#delItem").on('click',function(event){
		event.preventDefault();
		proc = 2;
		eliminarRegistroActual();
		
	});
	
	$("#refreshTable").on('click',function(event){
		event.preventDefault();
		oPag.currentPage=0;
		tablaDeElementos();
		
	});
	

     $(".btnPlusIcon").on("click",function(event){
		var id = event.currentTarget.id.split("-");
		agregarDomFis(id[1],event.currentTarget.title,id[2]);	
	});

	// Operaciones con el Formulario de Cambio de Password
	$('#form-find-data-add-dom').submit(function() {
    		$(this).ajaxSubmit({success: invocarFormularioDomFis(this)}); 
     	return false; 
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
	
	$('#form-find-data-prod').submit(function() {
    		$(this).ajaxSubmit({ success: tablaDeElementosFiltrados}); 
     	return false; 
	});

	
	// Por Cadenas de Markov
	$(".item").on("click",function(){
		orderBy = orderBy == arOrderBy[0] ? arOrderBy[1]:arOrderBy[0];
		tablaDeElementos();
	});
	$(".producto").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeElementos();
	});
	$(".medida").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});
	$(".grupo").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});

	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})
	$( "#find" ).button({text: true,icons: {primary: "ui-icon-search"}})


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
	if (datosServer.mensaje=="D3"){
		tablaDeElementos();
	}
}

function invocarFormulario(responseText, statusText, xhr, $form){
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $form.formSerialize(); 
	//alert(queryString);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			if (json[0].msg=="OK"){
				$form.clearForm();
				$form.resetForm();
				tablaDeElementos();
				stream.emit("cliente", {mensaje: "D3"});
				if (tipo == 0 || tipo == 2){
				   getPag2(idproducto,"productos","idprod", oPag,5,iduser,iddep);
				}
			}
 		}, "json"
	);
}

//Listado Registros Completos
function tablaDeElementos(){
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	//alert(oBy+orderBy);
	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:20, p:4,c:oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina  },
		function(json){
			if (json.length<=0) { return false;alert("Error.");}
			cargarRegistrosLeidos(json);
 	}, "json");
}

//Listado Registros Completos
function tablaDeElementosFiltrados(responseText, statusText, xhr, $form){
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	var queryString = $form.formSerialize(); 
	
	//alert(oBy+orderBy+"|"+queryString);
	
	//c:" "+oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:6, p:4,c:oBy+orderBy+"|"+queryString,from:oPag.currentPage, cantidad:oPag.CantidadPagina },
		function(json){
			if (json.length==0) {$("#tableList > tbody").html("");	return false;}
			$form.clearForm();
			$form.resetForm();
			cargarRegistrosLeidos(json);
 	}, "json");
}


function cargarRegistrosLeidos(json){
	//event.preventDefault();
	$("#tableList tbody").html("");
	$.each(json, function(i, item) {
		var id=item.idprod;

		arrItems[i] = {idprod:item.idprod, producto:item.producto, idmedida:item.idmedida, idprodgpo:item.idprodgpo, 
					medida:item.medida, grupo:item.grupo};
		var str = "";
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		str +='<td><span>'+item.producto+'</span></td>'; 
		str +='<td><span>'+item.medida+'</span></td>'; 
		str +='<td><span>'+item.grupo+'</span></td>'; 
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

	$("#idprod").val(parseInt(arrItems[index].idprod));
	$("#producto").val(arrItems[index].producto);
	$("#idmedida").val(parseInt(arrItems[index].idmedida));
	$("#idprodgpo").val(parseInt(arrItems[index].idprodgpo));
	
	idproducto = parseInt(arrItems[index].idprod);

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
	var producto  = $('input[name=producto]').fieldValue(); 
	var idmedida  = $('select[name="idmedida"]').fieldValue(); 
	var idprodgpo = $('select[name="idprodgpo"]').fieldValue(); 
	
	var q = "";

	if (!producto[0]){q="Proporcione el Producto";  }
		else if ( parseInt(idmedida[0])  <= 0 ){q="Falta la unidad de Medida del Producto";  }
		else if ( parseInt(idprodgpo[0]) <= 0 ){q="Seleccione un grupo";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}
}

function buscarNombreCompleto(){
	$( "#dialog-form-prod" ).dialog({
		resizable: false,
		height:250,
		width:300,
		modal: true,
		buttons: {
			"Aceptar": function() {
					$("#form-find-data-prod").submit();
					//tablaDeElementosFiltrados(this)
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


function agregarDomFis(id,title,campo){
	
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


//Agrega un dato fiscal a la DB
function invocarFormularioDomFis(form){
	var campo = $("#form-find-data-add-dom input[name='namecolumn']").val();
	var queryString = $(form).formSerialize(); 
	
	$.post(obj.getValue(0)+"getEC/", { o:0, c:queryString, t:11, p:1 },
 	function(json){
		var q = json[0].msg;
		sayMessage(json[0].msg,"Ocurrió un "+q,$("#msgResponse"),"Dato agregado con éxito");
		$(form).clearForm();
		$(form).resetForm();
          if (campo=="medida"){
			getMedidas();
		}else{
			getProductos();
		}
		
		return false;
 	}, "json");
}


function pintaData(){
	$.post(obj.getValue(0)+"getEC/", { o:-1, t:0, p:0,c:iduser },
		function(json){
			if (json.length==0) {
				     iduser=0;
					return false;
			}else{
				iduser = parseInt(json[0]);
				iddep  = parseInt(json[1]);
			
			getPag2(idproducto,"productos","idprod", oPag,5,iduser,iddep);
			if (iddep!=20){

				$('select[name=idprodgpo]').val(iddep);
				$('input[name=iddep]').val(iddep);
				$('select[name=idprodgpo]').prop("disabled","disabled");
			
			}
			tablaDeElementos();
			}
	 	}, "json"
	);
}



getMedidas();
getProductos();

stream.on("servidor", jsNewReg);   

</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

<div id="dialog-form-prod" title="Buscar nombre" style="display:none;">

	<form id="form-find-data-prod">
	<br/><br/>
	<fieldset>
		<label for="datoc" class="findNameComplete">Dato</label>
		<input type="text" name="datoc" id="datoc" title="Buscar dato con: " maxlength="60" required min="4" 
			   placeholder="Escriba algunas palabras" value="" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="opciones" >Buscar por</label>
		<select name="opciones" id="opciones" size=1  value="" >
			<option value="producto" selected >Producto</option>
			<option value="grupo"             >Grupo</option>
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
		<input type="text" name="datofis" id="datofis" class="text ui-widget-content ui-corner-all" pattern="^[A-ZÑ\s]*$" />
		<input type="hidden" name="iddomfis" id="iddomfis" />	   
		<input type="hidden" name="namecolumn" id="namecolumn" />	   
	</fieldset>
	</form>
</div>

