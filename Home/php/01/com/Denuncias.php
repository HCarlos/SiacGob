
<div id="msgResponse"></div>

<form id="formContract" class="form2 ui-corner-all" >
	<fieldset id="itemContract">
	   	<label for="idclif"># Per </label>
        	<input type="number" name="idclif" id="idclif" class="text ui-widget-content ui-corner-all" required autofocus />
          <input type="submit" value="Consultar" />
          <!--<input class="fieldset-margin-left" type="button" id="findCli" value="Buscar" />-->
		<span id="expand" class="expand minus"></span>
    </fieldset>
    
</form>

<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all" >
	<span class="ui-icon ui-icon-contact" > </span>
	<span id="tituloForm" > ... </span>
</div>
	<fieldset>
	   	
		<label for="nombrec" >Cliente </label>
        	<input type="text"  name="nombrec" id="nombrec" class="shrt text ui-widget-content ui-corner-all" readonly/>
	     <input type="text"  name="domc" id="domc" class="shrt text ui-widget-content ui-corner-all" readonly/>
	</fieldset>
	<fieldset>
		<label for="dependencia" >Dep.: </label>
		<Select name="dependencia" id="dependencia" required > 
		</select>
		<label for="area" >Area: </label> 
		<Select name="area" id="area" required > 
		</select>
	   	<label for="cantidad" class="fieldset-margin-left">Cant: </label>
        	<input type="number" name="cantidad" id="cantidad" value="1" class="text ui-widget-content ui-corner-all"/>
		
	</fieldset>
	<fieldset>
		<label for="producto" >Servicio: </label> 
		<Select name="producto" id="producto" required > 
		</select>
	</fieldset>	


	<fieldset>

	   	<label for="calle">Calle: </label>
        	<input type="text" name="calle" id="calle" class="text ui-widget-content ui-corner-all" required />
	   	
		<label for="colonia" class="fieldset-margin-left">Colonia: </label>
        	<input type="text" name="colonia" id="colonia" class="text ui-widget-content ui-corner-all" required />
	
		<label for="ciudad" class="fieldset-margin-left">Ciudad: </label>
        	<input type="text" name="ciudad" id="ciudad" class="text ui-widget-content ui-corner-all" required />

		<label for="latitud" class="fieldset-margin-left">Latitud: </label>
        	<input type="text" name="latitud" id="latitud" class="text ui-widget-content ui-corner-all"  />

		<label for="longitud" class="fieldset-margin-left">Longitud: </label>
        	<input type="text" name="longitud" id="longitud" class="text ui-widget-content ui-corner-all"  />

	</fieldset>

	<fieldset>

		<label for="descripcion" >Descripción: </label>
        	<textarea type="text"  name="descripcion" id="descripcion" class="shrt text ui-widget-content ui-corner-all"> </textarea>
	
	</fieldset>

	<fieldset>

		<label for="origen" >Captada: </label>
		<Select name="origen" id="origen" required > 
		</select><span id="spn-origenes-origen" class="btnPlusIcon" title="Agregar otro dato"> </span>

		<label for="prioridad" class="fieldset-margin-left" >Proridad: </label>
		<Select name="prioridad" id="prioridad" required > 
		</select><span id="spn-prioridades-prioridad" class="btnPlusIcon" title="Agregar otro dato"> </span>

		<label for="fecha" class="fieldset-margin-left">Fecha: </label>
        	<input type="date" name="fecha" id="fecha" class=" ui-widget-content ui-corner-all" placeholder="aaaa/mm/dd" value="<?php echo date('Y-m-d'); ?>" required/>

		<label for="fecha_limite" class="fieldset-margin-left" >Respuesta: </label>
        	<input type="date" name="fecha_limite" id="fecha_limite" class=" ui-widget-content ui-corner-all" placeholder="aaaa/mm/dd" value="<?php echo date('Y-m-d'); ?>" required/>

	</fieldset>	



	<fieldset id="buttom1D">
        	<input type="hidden" name="noficio" id="noficio" />
		<input type="hidden" name="iduser" id="iduser" value="0" />
		<input type="hidden" id="iddenuncia" name="iddenuncia" value="0" />
		<input type="hidden" id="idcli" name="idcli" value="0" />
		<input type="hidden" id="idproducto" name="idproducto" value="0" />
		<input type="hidden" id="idareadep" name="idareadep" value="0" />
		<input type="hidden" id="iddep" name="iddep" value="0" />
        <input type="submit" id="cmdSave" name="cmdSave" value="Guardar" /><span id="capor"></span>
	</fieldset>
	
</form>

<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="addItem">Nuevo</button>
	<button id="delItem">Quitar</button>
	<button id="refreshTable">Actualizar</button>
	<button id="find">Buscar</button>
	<button id="viewInfo">Imprimir</button>
	<button id="viewInfo2">Acuse de Recibo</button>
	<button id="response">Responder</button>
	<button id="viewResponse">Ver Respuestas</button>
	<span id="spanTitle">Solicitud de Servicios</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="fecha">Fecha</th>
				<th class="descripcionc">Descripción</th>
				<th class="dependenciac">Dependencia</th>
				<th class="statusc">Status</th>
				<th class="fecha_dep">Fecha Programada</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr class="ui-widget-header borderBottom">
				<td colspan="8" > <span id="oPagination"></span> </td>
			</tr>
		</tfoot>
		
	</table>
</div>

<style>
#tableList .item{width:120px; padding-top:5px;}
#tableList{display:inline; position:relative;}
.opItem{width:30px; margin-top:3px; background-color:#09F;}
#tableList .cliente,#tableList .agente{width:200px;}
#tableList .total{width:100px;}
#tableList .fecha{width:100px;}
#tableList .descripcionc{width:400px;}

#tableList .dependencia{width:400px;}
#tableList .status{width:100px;}
#tableList .fecha_dep{width:100px; text-align:right !important;}
#tableList .money{ text-align:right; margin-right:1em !important;}

#tblfindCli .item{width:100px; padding-top:5px;}
#tblfindCli .nombrec{widt:200px;}
#tblfindCli .domc{widt:200px;}
.money, .header1{ text-align:right; display:block; margin-right:1em !important; }

#toolbar, #formContract{width:99%; position: relative !important; margin:0em 0px 0.2em 0px; text-align:left; }
/*#formBody, #users-contain {position:relative; width:96.7%;}*/
#users-contain{position:relative; width:96.7%; padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}

#formBody > fieldset > #nombrec{ width:25% !important;}
#formBody > fieldset > #domc{ width:50% !important;}
#formBody > fieldset > #descripcion{ width:50% !important;}
#formBody > fieldset > #respuesta{ width:50% !important;}
#formBody > fieldset > #noficio{ width:25% !important;}
#formBody > fieldset > #cantidad{width:40px !important;}
#formBody > fieldset > #descripcion{width:100% !important; height:5em !important;}

.ui-autocomplete-loading { background: white url('../../images/img-web/ui-anim_basic_16x16.gif') right center no-repeat; }
.shrt{ width:50px !important} 
.btnPlusIcon{ background:url(../../images/img-web/plus-icon.png) top left no-repeat !important; margin-left:0.3em; width:16px; height:20px; line-height:18px; display:inline-block; cursor:pointer; }
input[name='datofis']{width:90% !important;}

.findNameComplete{ margin-bottom:0.2em !important;}
#users-contain{ overflow-y:scroll;}
</style>


<script type="text/javascript">

	var tipo          = 0;
	var currentItem   = 0;
	var index         = -1;
	var proc          = 2;
	var arrItems      = new Array();
	var arrDet        = new Array();
	var arOrderBy     = [" iddenuncia asc "," iddenuncia desc "," fecha asc "," fecha desc "," descripcion asc "," descripcion desc "," grupo asc "," grupo desc "," status asc "," status desc "," fecha_dep asc "," fecha_dep desc "];
	var objInAuto     = ["_viDemanda"];
	var objInAutoId   = ["iddenuncia"];
	var objInAutoTerm = ["iddenuncia"];
	var orderBy       = arOrderBy[1];
	var urlSearch     = obj.getValue(0)+"getSR/?o=";
	var iddenuncia    = 0;
	var iddep         = 0;
	var idproducto    = 0;
	var idareade      = 0;
	var idcli         = 0;
	var indiceTabla   = 0;
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:20};
	var query         = "";
	var indice        = 0;

	
	//var xc = obj.getMinHeight()-($("#formContract").height()+$("#formBody").height()+$("#toolbar").height()+100);
	//$("#users-contain").height(xc);
	
	//$("#viewResponse").hide();
	
	$("#iduser").val(sessionStorage.Id);
	var iduser = sessionStorage.Id;
	
	$("#viewResponse").hide();
	
	if (!obj.getUser(13)){
		$("#delItem").hide();
	}	

	if (!obj.getUser(14) || !obj.getUser(15)){
		$("#cmdSave").hide();
		$("#addItem").hide();
	}	

	//if (!obj.getUser(16)){
		$("#response").show();
	//}	

	
	$("#addItem").on('click',function(event){
		event.preventDefault();
		clearObjects();
	});

	
	
	$("#delItem").on('click',function(event){
		event.preventDefault();
		proc = 2;
		eliminarRegistroActual();
		
	});
	$("#refreshTable").on('click',function(event){
		event.preventDefault();
		//oPag.currentPage=0;
		//query=""
		tipo = 0;
		index = -1;
		tablaDeElementos();
	});


	$("#toolbar form #radio > h1").text("Tabla de "+obj.cat[obj.index].Catalogo); 
	$("#formBody > #h3 > #tituloForm").text(obj.cat[obj.index].Catalogo); 
	$("#radio").buttonset();

	// Operaciones con el Formulario 
	$('#formContract').submit(function() { 
    		$(this).ajaxSubmit({  success: buscarCliente }); 
     	return false; 
	});

	// Operaciones con el Formulario 
	$('#formBody').submit(function() { 
    		$(this).ajaxSubmit({ beforeSubmit: validateForm, success: invocarFormulario }); 
     	return false; 
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


	// Por Cadenas de Markov
	$(".item").on("click",function(){
		orderBy = orderBy == arOrderBy[0] ? arOrderBy[1]:arOrderBy[0];
		tablaDeElementos();
	});
	$(".fecha").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeElementos();
	});
	$(".descipcionc").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});
	$(".dependenciac").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});
	$(".statusc").on("click",function(){
		orderBy = orderBy == arOrderBy[8] ? arOrderBy[9]:arOrderBy[8];
		tablaDeElementos();
	});
	$(".prioridadc").on("click",function(){
		orderBy = orderBy == arOrderBy[10] ? arOrderBy[11]:arOrderBy[10];
		tablaDeElementos();
	});

	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}});
	$( "#viewInfo" ).button({text: true,icons: {primary: "ui-icon-print"}})
	$( "#viewInfo2" ).button({text: true,icons: {primary: "ui-icon-print"}})
	$( "#response" ).button({text: true,icons: {primary: "ui-icon-comment"}})
	$( "#viewResponse" ).button({text: true,icons: {primary: "ui-icon-note"}})
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


function clearObjects(){
	tipo = 0;
	proc = 2;
	$('#formBody > fieldset > input[name="idcli"]').val(0);
	$('#formBody > fieldset > input[name="idproducto"]').val(0);
	$('#formBody > fieldset > input[name="idareadep"]').val(idareadep); /* 0 */
	$('#formBody > fieldset > input[name="iddep"]').val(iddep);/* 0 */
	$('#formContract > fieldset > input[name="idclif"]').val(0);
	idcli            = 0;
	idproducto       = 0;
	//idareadep        = 0;
	//iddep            = 0;
	orderBy          = arOrderBy[1];
	oPag.currentPage = 0;
	indiceTabla      = 0;
	query            = ""
	$('#idclif').focus();
}
//alert("test");


function jsNewReg(datosServer){
	if (datosServer.mensaje=="D6" || datosServer.mensaje=="RW" || datosServer.mensaje=="D20"){
		if (index<0){
			//alert(index);
		   tablaDeElementos();
		}
	}
}



function buscarCliente(responseText, statusText, xhr, $form){
	$("#tableList > tbody").html(getPreloader());
	sayMsgPreloading($("#msgResponse"),1);
	
	var queryString = $form.formSerialize(); 
	
	
     var err1 = "Núm de Demanda no encontrado";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:19, p:5,c:queryString },
		function(json){
			if (json.length==0) {
				sayMessage("",err1,$("#msgResponse"),"");  
				idcli       = 0;
				idproducto  = 0;
				idareadep   = 0;
				return false;
			}else{
				   $("#msgResponse").hide();
				   idcli = parseInt(json[0].idcli);
				   $("#formBody > fieldset > input[name='idcli']").val(idcli);
				   $("#formBody > fieldset > input[name='nombrec']").val(json[0].nombrec);
				   $("#formBody > fieldset > input[name='domc']").val(json[0].domc);
				   query = " and idcli = "+idcli+ " ";
				   tablaDeElementos();
				   
					
			}
 	}, "json");
}


function invocarFormulario(responseText, statusText, xhr, $form){
//function invocarFormulario($form){
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $form.formSerialize(); 
	//alert(queryString);

	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			//alert(json[0].msg);
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			var jsn = json[0].msg.split(".");
			if (jsn[0]=="OK"){
				stream.emit("cliente", {mensaje: "D6"});
				if (tipo == 0){
					printFolio(0,0);
				}
				if (tipo == 0 || tipo == 2){
				   getPag2(iddep,"_viDemanda","iddependencia", oPag,4,iduser,iddep);
				}
				clearObjects();
				tablaDeElementos();

			}
 		}, "json"
	);
}

//Listado Registros Completos
function tablaDeElementos(){
	//event.preventDefault();
	var queryString = $("#formBody").formSerialize(); 
	$("#tableList > tbody").html(getPreloader());
	//alert(queryString);	
	oBy= orderBy!=""?" Order By ":"";
	//alert(" "+query+" "+oBy+orderBy);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:12, p:3,c:" "+query+" "+oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina,s:queryString },
		function(json){
			if (json.length<=0) { return false;}
			//alert(2);
			cargarRegistrosLeidos(json);
			
 	}, "json");
}

function cargarRegistrosLeidos(json){
	//event.preventDefault();
	var str = "";
	var suma = 0;
	var id  = 0;
	
	$("#tableList tbody").html("");
	//alert(1);
	$.each(json, function(i, item) {
          id = item.iddenuncia;
		var clsss;
		switch(parseInt(item.idstatus)){
			case 2:
				clsss = "verdeAtendido";
				break;
			case 3:
				clsss = "rojoNoProcede";
				break;
			case 4:
				clsss = "azulOtraDep";
				break;
			default:	
			     if (item.idorigen==4){
					clsss = "violetaIE";
				}else{
					clsss = "";
				}
				break;
		}
		arrItems[i] = {iddenuncia:item.iddenuncia,fecha:item.fecha, idcli:item.idcli, 
					idprod:item.idprod,idmedida:item.idmedida, descripcion:item.descripcion, 
					oficio_envio:item.oficio_envio, iddependencia:item.iddependencia,idorigen:item.idorigen, 
					respuesta_dep:item.respuesta_dep, fecha_dep:item.fecha_dep,fecha_limite:item.fecha_limite,
					idstatus:item.idstatus, idprioridad:item.idprioridad, nombrec:item.nombrec,domc:item.domc,
					producto:item.producto,observaciones:item.observaciones,fecha_ejecucion:item.fexecdep,
					medida:item.medida,idareadep:item.idareadep,
					idprodgpo:item.idprodgpo, grupo:item.grupo, origen:item.origen,
					status:item.status,cantidad:item.cantidad,
					prioridad:item.prioridad,cfolio:item.cfolio,fecha_normal:item.fecha_normal, 
					fecha_programada:item.fecha_programada,depuser:item.depuser,user_internet:item.user_internet,
					calle:item.calle2, colonia:item.colonia2, ciudad:item.ciudad2, latitud:item.latitud, longitud:item.longitud
					};

		str = "";
		str +='<tr id="tr-'+i+'" class="idsel '+clsss+'">';	
		str +='<td class="'+clsss+'"><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+item.cfolio+'</td>';
		str +='<td class="'+clsss+'"><span>'+item.fecha_normal+'</span></td>'; 
		str +='<td class="'+clsss+'"><span>'+item.descripcion+'</span></td>'; 
		str +='<td class="'+clsss+'"><span>'+item.grupo+'</span></td>'; 
		str +='<td class="'+clsss+'"><span>'+item.status+'</span></td>'; 
		str +='<td class="fecha_dep '+clsss+'">'+item.fecha_programada+'</td>'; 
		str +="</tr>";
		$("#tableList > tbody").append(str);	
	});
	index = -1;
	indice = 0;
	
	
	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
		$('td input[name="radio"]',this).attr("checked", true);
		editarRegistroActual();
		//alert(index);
	})
	
}

function editarRegistroActual(){
	//event.preventDefault();
	
	tipo = 1;
	
	// alert(index);
	indice = index;
	
	iddenuncia = parseInt(arrItems[index].iddenuncia);
	
	$('#formContract > fieldset > input[name=idclif]').val(arrItems[index].idcli);
	
	$("#formBody > fieldset > input[name='iddenuncia']").val(parseInt(arrItems[index].iddenuncia));
	$("#formBody > fieldset > input[name='idcli']").val(parseInt(arrItems[index].idcli));
	$("#formBody > fieldset > input[name='idproducto']").val(parseInt(arrItems[index].idproducto));
	$("#formBody > fieldset > input[name='idareadep']").val(parseInt(arrItems[index].idareadep));
	$("#formBody > fieldset > input[name='iddep']").val(parseInt(arrItems[index].iddependencia));

	$("#formBody > fieldset > input[name='nombrec']").val(arrItems[index].nombrec);
	$("#formBody > fieldset > input[name='domc']").val(arrItems[index].domc);

	$('#formBody > fieldset > select[name=dependencia]').val(arrItems[index].iddependencia);

	getProdSel(arrItems[index].iddependencia);
	getAreaSel(arrItems[index].iddependencia);
	
	$("#cantidad").val(arrItems[index].cantidad);
	$("#descripcion").val(arrItems[index].descripcion);
	$("#noficio").val(arrItems[index].oficio_envio);

	$("#calle").val(arrItems[index].calle);
	$("#colonia").val(arrItems[index].colonia);
	$("#ciudad").val(arrItems[index].ciudad);
	$("#latitud").val(arrItems[index].latitud);
	$("#longitud").val(arrItems[index].longitud);


	$('select[name=origen]').val(arrItems[index].idorigen);
	$('select[name=prioridad]').val(arrItems[index].idprioridad);

	$("#fecha").val(arrItems[index].fecha);
	$("#fecha_limite").val(arrItems[index].fecha_limite);
	$("#capor").html("Por: <strong>"+arrItems[index].depuser+"</strong>");
	
	if (parseInt(arrItems[index].idorigen)==4){
 		$("#formBody > fieldset > input[name='domc']").val(arrItems[index].user_internet);
 	}
 	
 	if (iduser == 1 || iduser == 56 || iduser == 2  || iduser == 47 || iduser == 9){
		$("#viewResponse").show();
	}else{
		$("#viewResponse").hide();
	}


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
	var idcli  = $('input[name=idcli]').fieldValue(); 
	var idprod  = parseInt($('input[name=idproducto]').fieldValue()); 
	//var forma_pago  = $('select[name=forma_pago]').fieldValue(); 
	var origen         = $('select[name=origen]').fieldValue(); 
	var prioridad   = $('select[name=prioridad]').fieldValue(); 
	var dependencia   = $('select[name=dependencia]').fieldValue(); 
	var producto   = parseInt($('select[name=producto]').fieldValue()); 

	//else if (parseInt(forma_pago[0])     <=0 ){q="Seleccione una Forma de Pago";  }


	var q = "";
	if (parseInt(idcli[0])      <=0 ){q="No hay Persona.";  }
	else if (idprod <=0 ){q="Seleccione un Producto";  }
	else if (producto <=0 ){q="Seleccione un Producto";  }
	else if (parseInt(origen[0])  <=0 ){q="Seleccione una Origen";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}else{
		return true;
	}
}




function getDependencia(){
	$("select[name='dependencia']").html('');	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:0, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='dependencia']").html('<OPTION VALUE="0" selected >Seleccione una Dependencia</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="dependencia"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
		//getProdCont();
	}, "json");

}

$('select[name="dependencia"]').on('change',function(event){
	$('input[name="iddep"]').val(parseInt(event.currentTarget.value));
	getProdSel(event.currentTarget.value);
	getAreaSel(event.currentTarget.value);
});

function getProdSel(id){
	$("select[name='producto']").html('');	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:1, p:0, c:' idprodgpo = '+id },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='producto']").html('<OPTION VALUE="0" selected >Seleccione un Elemento</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="producto"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
			});
			if (tipo==1){
				$('select[name=producto]').val(arrItems[index].idprod);
				$("#formBody > fieldset > input[name=idproducto]").val(arrItems[index].idprod);
			}
	}, "json");

}

function getAreaSel(id){
	$("select[name=area]").html('');	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:-1, p:0, c:' idprodgpo = '+id },
 		function(json){
			if (json.length>0) { 
				$("select[name=area]").html('<OPTION VALUE="0" selected >Select Area</OPTION>');	
				$.each(json, function(i, item) {
					$('select[name=area]').append('<option value="'+item.data+'">'+item.label+'</option>');	
				});
				if (tipo==1){
					$('select[name=area]').val(arrItems[index].idareadep);
					$("#formBody > fieldset > input[name=idareadep]").val(arrItems[index].idareadep);
				}
			}else{
				$("select[name=area]").html('<OPTION VALUE="0" selected >Sin Area</OPTION>');	
				$("#formBody > fieldset > input[name=idareadep]").val(0);
				return false;
			}
	}, "json");

}

//alert("En Mantenimiento 643");


$('select[name="producto"]').on('change',function(event){
	$("#formBody > fieldset > input[name=idproducto]").val(event.currentTarget.value);
});

$('select[name="area"]').on('change',function(event){
	$("#formBody > fieldset > input[name=idareadep]").val(event.currentTarget.value);
});

function getOrigen(){
	var lbl;
	$("select[name='origen']").html('');	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:2, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='origen']").html('<OPTION VALUE="0" selected >Seleccione un Elemento</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="origen"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
	}, "json");

}

function getPrioridad(){
	var lbl;
	$('select[name="prioridad"]').html('');	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:4, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$.each(json, function(i, item) {
				$('select[name="prioridad"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
	}, "json");

}





$("#findCli").on('click',function(event){
	event.preventDefault();
	$( "#dialog-form_findCli" ).dialog({
		resizable: false,
		height:460,
		width:640,
		modal: true,
		buttons: {
			"Buscar": function() {
					$("#tblfindCli > tbody").html("");
					$("#form_findCli").submit();
			},
			"Cerrar": function() {
				$(this).clearForm();
				$(this).resetForm();
				$( this ).dialog( "close" );

			}
		}
	});

});


$('#form_findCli').submit(function() {
    	$(this).ajaxSubmit({ beforeSubmit: validateFormFindCli, success: findCli(this)}); 
     return false; 
});


function findCli(responseText, statusText, xhr, $form) {
	var arr1 = new Array();
	var id;
	
	$("#tblfindCli > tbody").html("");	
	
	var queryString = $form.formSerialize();
	
	//alert(queryString);
	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:18, p:5, c:queryString },
 		function(json){
			$("#form_findCli > fieldset > input[name='findnombrec']").val("");
			if (json.length<=0) { 
			    alert("Ninguna coincidencia...");
				return false;
			}
			$.each(json, function(i, item) {
				
			   	arr1[i] = {idcli:item.idcli, nombrec:item.nombrec, domc:item.domc};
				id = item.idcli;

				str = "";
				str +='<tr id="tr-'+i+'" class="idsel">';	
				str +='<td><input type="radio" id="ii-'+id+'" name="radio" class="opItem" />'+id+'</td>';
				str +='<td><span>'+item.nombrec+'</span></td>'; 
				str +='<td><span>'+item.domc+'</span></td>'; 
				str +="</tr>";
				$("#tblfindCli > tbody").append(str);	
				
			});


			$("#tblfindCli tr").on('click',function(event){
				event.preventDefault();
				var i = this.id.split("-");
				ele = i[1];
				$('td input[name="radio"]',this).attr("checked", true);
				//$('#idclif').val(arr1[ele].idcli);
				$('#formContract > fieldset > input[name=idclif]').val(arr1[ele].idcli);
				$('#formContract').submit();
			})

			$form.clearForm();
			$form.resetForm();
			
		
	}, "json");

}

function validateFormFindCli(formData, jqForm, options) { 
	var nombrec   = $('#form_findCli > fieldset > input[name=findnombrec]').fieldValue();//$('#findnombrec').val(); 
	var q = "";
	//alert(nombrec[0]);
	if (!nombrec[0] ){q="No hay dato de búsqueda.";  }
  
	if (q!=""){
		alert(q);
		return false;
	}else{
		return true;
	}
}

$("#viewInfo").on('click',function(event){
	printFolio(index,0);
});

$("#viewInfo2").on('click',function(event){
	printFolio(index,1);
});


function printFolio(i,format){	
     
	if (i < 0) {i = 0;}
	//alert(arrItems[i].fecha);
	var PARAMS = {cfolio:arrItems[i].cfolio,nombrec:arrItems[i].nombrec,producto:arrItems[i].producto,fecha:arrItems[i].fecha,idcli:arrItems[i].idcli};  
	var file = format==0?"fmt-02.php":"fmt-03.php";
	var url = obj.getValue(0)+"php/01/docs/"+file;

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

};

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
			"Guardar": function() {
					$("#form-find-data-add-dom").submit();
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


//Agrega un dato fiscal a la DB
function invocarFormularioDomFis(form){
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

getDependencia();
getOrigen();
getPrioridad();

$.post(obj.getValue(0)+"getEC/", { o:-1, t:0, p:0,c:iduser },
	function(json){
		if (json.length==0) {
			     iduser=0;
				return false;
		}else{
			iduser = parseInt(json[0]);
			iddep  = parseInt(json[1]);

			
			getPag2(iddep,"_viDemanda","iddependencia", oPag,4,iduser,iddep);
			if (iddep!=20){
				$('#formBody > fieldset > select[name=dependencia]').val(iddep);
				$('#formBody > fieldset > input[name=iddep]').val(iddep);
				$('#formBody > fieldset > select[name=dependencia]').prop('disabled', true);
				getProdSel(iddep);
				getAreaSel(iddep);
			}
			tablaDeElementos();

		}
 }, "json");


$("#response").on('click',function(event){

	var url = obj.getValue(0)+"responseWindow/";
	var PARAMS = {idden2:arrItems[index].iddenuncia};  
	var temp=document.createElement("form");
	temp.action=url;
	temp.method="POST";
	temp.target="_blank";
	temp.style.display="none";
	temp.width = 640;
	temp.height = 460;
	for(var x in PARAMS) {
		var opt=document.createElement("textarea");
		opt.name=x;
		opt.value=PARAMS[x];
		temp.appendChild(opt);
	}
	document.body.appendChild(temp);
	temp.submit();
	return temp;
	
});

$("#viewResponse").on('click',function(event){
    //alert("Módulo en Construcción"); 
    //return false;
	var url = obj.getValue(0)+"viewResponseWindow/";
	var PARAMS = {idden2:arrItems[index].iddenuncia};  
	var temp=document.createElement("form");
	temp.action=url;
	temp.method="POST";
	temp.target="_blank";
	temp.style.display="none";
	temp.width = 640;
	temp.height = 460;
	for(var x in PARAMS) {
		var opt=document.createElement("textarea");
		opt.name=x;
		opt.value=PARAMS[x];
		temp.appendChild(opt);
	}
	document.body.appendChild(temp);
	temp.submit();
	return temp;
});

$("#find").on('click',function(event){
	$( "#form-find-demanda > fieldset >  input[name=iddep3]" ).val(iddep);
	$( "#dialog-form-demanda").dialog({
		resizable: false,
		height:260,
		width:360,
		title:"Buscar dato",
		modal: true,
		buttons: {
			"Consultar": function() {
					tipo = 5;
					$("#form-find-demanda").submit();
					$( this ).dialog( "close" );
			},
			"Cerrar": function() {
				$(this).clearForm();
				$(this).resetForm();
				$( this ).dialog( "close" );

			}
		}
	});
});

$('#form-find-demanda').submit(function() {
	$(this).ajaxSubmit({ success: invocarFormFind }); 
     return false; 
});

function invocarFormFind(responseText, statusText, xhr, $form){
	var queryString = $form.formSerialize(); 
	$("#tableList > tbody").html(getPreloader());
	oBy= orderBy!=""?" Order By ":"";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:13, p:3,c:oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina,s:queryString },
		function(json){
			if (json.length<=0) { return false;}
			//getPag3(parseInt(json[0].registros));   
			cargarRegistrosLeidos(json);
			$("#oPagination").html("");

 	}, "json");

}

$("#expand").on("click",function(event){
	HideAndShow($("#formBody"),this);
})

stream.on("servidor", jsNewReg);


</script>

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

<div id="dialog-form-demanda" title="Buscar nombre" style="display:none;">

	<form id="form-find-demanda">
	<br/><br/>
	<fieldset>
		<label for="findDem" class="findNameComplete">Dato</label>
		<input type="text" name="findDem" id="findDem" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="optFindDem" >Buscar por</label>
		<select name="optFindDem" id="optFindDem" size=1  value="" >
			<option value="0" selected >ID del Folio</option>
			<option value="1">Id Ciudadano</option>
			<option value="2">Nombre Completo</option>
			<option value="3">Descripci&oacute;n</option>
			<option value="4">Ubicación</option>
	   	</select>
	<input type="hidden" id="iddep3" name="iddep3" value="0" />
			   
	</fieldset>
	</form>
</div>



<div id="dialog-form_findCli"  title="Buscar Cliente" style="display:none;">

	<form id="form_findCli">
	<br/><br/>
	<fieldset>
	   	<label for="findnombrec">Nombre Completo </label>
		<input type="text" id="findnombrec" name="findnombrec" />
	</fieldset>
	<fieldset>
	
	<table id="tblfindCli" class="table_base" height="100" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
			     <th class="nombrec">Nombre Completo</th>
			     <th class="domc">Domicilio</th>
			</tr>
		</thead>
		<tbody>
		</tbody>	
	</tr>
	</table>
			   
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
