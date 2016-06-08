
<div id="msgResponse"> </div>

<form id="formContract" class="form fieldset2" >
	<fieldset id="itemContract">
	   	<label for="idcontrato">Contrato </label>
        	<input type="number" name="idcontrato" id="idcontrato" class="text ui-widget-content ui-corner-all" title="Núm Contrato"  placeholder="Núm Contrato"required autofocus />
          <input type="submit" value="Consultar" />
	   	<label id="guiaContrato" class="fieldset-margin-left">::: </label>
	   	<label> | </label>
	   	<label id="txtCliente">::: </label>
	   	<label> | </label>
	   	<label id="txtAgente">::: </label>
	   	<label> | </label>
	   	<label id="txtTotalVenta" class="moneyBg">::: </label>
	   	<label> | </label>
	   	<label id="txtTotalCortesia" class="moneyBg">::: </label>
	   	<label> | </label>
	   	<label id="txtTotalConvenio" class="moneyBg">::: </label>
	   	<label> | </label>
	   	<label id="txtTotalInterno" class="moneyBg">::: </label>
    </fieldset>
    
</form>

<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all" >
	<span class="ui-icon ui-icon-contact" > </span>
	<span id="tituloForm" > ... </span>
</div>
	<fieldset>
	   	<label for="idcontrato">Contrato </label>
        	<input type="number" name="idcontrato" id="idcontrato" class="shrt ui-widget-content ui-corner-all" title="Num Contrato"  placeholder="Num Contrato" readonly  required />
	   	<label for="txt_viProductos" class="fieldset-margin-left">Producto </label>
        	<input type="text" name="txt_viProductos" id="txt_viProductos" class="text ui-widget-content ui-corner-all" title="Producto"  placeholder="Producto" required />
		
		<label class="fieldset-margin-left"> :: </label>            
		
		<input type = "radio" name = "tipo_publicacion" id = "depago" value = "0" checked />
          <label for = "depago">Normal</label>

		<input type = "radio" name = "tipo_publicacion" id = "decortesia" value = "1"/>
          <label for = "decortesia">Cortesia</label>
          
		<input type = "radio" name = "tipo_publicacion" id = "deconvenio" value = "2"/>
          <label for = "deconvenio">Convenio</label>
          
		<input type = "radio" name = "tipo_publicacion" id = "deinterno" value = "3"/> 
          <label for = "deinterno">Interno</label>
          
	</fieldset>	

    <fieldset>
	   	<label for="precio_unitario">P Venta </label>
        	<input type="text" name="precio_unitario" id="precio_unitario" class="shrt text ui-widget-content ui-corner-all" pattern='^\d+\.\d{2}$' required  /> 
	   
	   	<label for="cantidad">Cantidad </label>
        	<input type="text" name="cantidad" id="cantidad" class="shrt text ui-widget-content ui-corner-all"  pattern='^\d+$(\.\d+)?' required  />

	   	<label for="importe">Importe </label>
        	<input type="text" name="importe" id="importe" class="shrt text ui-widget-content ui-corner-all" pattern='^\d+\.\d{2}$' required  />

        	<label for="esquemado_el" class="fieldset-margin-left">Desde</label>
        	<input type="date" name="esquemado_el" id="esquemado_el" class=" ui-widget-content ui-corner-all" title="Fecha de Aplicación" placeholder="dd/mm/aaaa" value="<?php echo date('Y-m-d'); ?>" required/>
		
        	<label for="ffin" class="fieldset-margin-left">Hasta</label>
        	<input type="date" name="ffin" id="ffin" class=" ui-widget-content ui-corner-all" title="Hasta" placeholder="dd/mm/aaaa" readonly/>

	</fieldset>

    <fieldset>
	   	<label for="guia">Guía </label>
        	<input type="text" name="guia" id="guia" class=" text ui-widget-content ui-corner-all" 
				title="Guía"  placeholder="Guía" maxlength="250" required  />
	   	<label for="script" class="fieldset-margin-left">Script </label>
        	<input type="text" name="script" id="script" class=" text ui-widget-content ui-corner-all" 
				title="Script" maxlength="250" placeholder="{pos:[x,y], dim:[width,height], target:my_file.indd, image:my_image.jpg}" value="{pos:[0,0], dim:[0,0], target:miarchivo.indd, image:miimagen.jpg}"  />
	</fieldset>
		   

	<fieldset>
		<input type="hidden" id="idprod" name="idprod" value="0" />
		<input type="hidden" id="idcontratodetalles" name="idcontratodetalles" value="0" />
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
	<span id="spanTitle">Detalles del Contrato</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="producto">Producto</th>
				<th class="precio_unitario">P Venta</th>
				<th class="cantidad">Cantidad</th>
				<th class="importe">Importe</th>
				<th class="esquemado_el">Fecha</th>
				<th class="medida">Medida</th>
				<th class="grupo">Grupo</th>
				<th class="tipopub">Tipo</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr class="ui-widget-header borderBottom">
				<td></td>
				<td><span>TOTAL</span></td>
				<td></td>
				<td></td>
				<td><span class="money" id="sumaTotal"></span></td>
				<td colspan="4" >Pagina: <span id="oPagination"> </span> </td>
			</tr>
		</tfoot>
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
#toolbar, #formContract{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
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
	var arOrderBy     = [" idcontratodetalles asc "," idcontratodetalles desc "," producto asc "," producto desc "," precio_unitario asc "," precio_unitario desc "," cantidad asc "," cantidad desc "," importe asc "," importe desc "," medida asc "," medida desc "," grupo asc "," grupo desc "," esquemado_el asc "," esquemado_el desc "," tipopub asc "," tipopub desc "];
	var objInAuto     = ["_viProductos"];
	var objInAutoId   = ["idprod"];
	var objInAutoTerm = ["producto"];
	var orderBy       = arOrderBy[1];
	var urlSearch     = obj.getValue(0)+"getSR/?o=";
	var idcontrato    = 0;
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:5};
	$("#tableList > tbody").html(getPreloader());
	
	$("#iduser").val(sessionStorage.Id);
	
	$("#users-contain").css("min-height",function(){
		var initHeight = $(window).height()-obj.height;
		return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
	});
	
	$("#addItem").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		proc = 2;
		$('#formBody').clearForm();
		$('#formBody').resetForm();
		//$("#idcontrato").val(0);
		$('#formBody > fieldset > input[name="idcontrato"]').val(idcontrato);
		$('#formBody > fieldset > input[name="guia"]').val($("#guiaContrato").text());
		
		$('td input[name="radio"]').each(function () {$(this).attr("checked",false);index = -1;});		
		orderBy          = arOrderBy[1];
		oPag.currentPage = 0;
		$('#txt_viProductos').focus();
	});
	
	
	$("#delItem").on('click',function(event){
		event.preventDefault();
		proc = 2;
		eliminarRegistroActual();
		
	});
	
	$("#refreshTable").on('click',function(event){
		event.preventDefault();
		//oPag.currentPage=0;
		tablaDeElementos();
	});
	
	$("#toolbar form #radio > h1").text("Tabla de "+obj.cat[obj.index].Catalogo); 
	$("#formBody > #h3 > #tituloForm").text(obj.cat[obj.index].Catalogo); 
	$("#radio").buttonset();

	// Operaciones con el Formulario 
	$('#formContract').submit(function() { 
    		$(this).ajaxSubmit({  success: buscarContrato }); 
     	return false; 
	});

	// Operaciones con el Formulario 
	$('#formBody').submit(function() { 
    		$(this).ajaxSubmit({ beforeSubmit: validateForm, success: invocarFormulario }); 
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
	$(".precio_unitario").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});

	$(".cantidad").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});
	$(".importe").on("click",function(){
		orderBy = orderBy == arOrderBy[8] ? arOrderBy[9]:arOrderBy[8];
		tablaDeElementos();
	});

	$(".medida").on("click",function(){
		orderBy = orderBy == arOrderBy[10] ? arOrderBy[11]:arOrderBy[10];
		tablaDeElementos();
	});
	$(".grupo").on("click",function(){
		orderBy = orderBy == arOrderBy[12] ? arOrderBy[13]:arOrderBy[12];
		tablaDeElementos();
	});
	$(".esquemado_el").on("click",function(){
		orderBy = orderBy == arOrderBy[14] ? arOrderBy[15]:arOrderBy[14];
		tablaDeElementos();
	});
	$(".tipopub").on("click",function(){
		orderBy = orderBy == arOrderBy[16] ? arOrderBy[17]:arOrderBy[16];
		tablaDeElementos();
	});

	$.each(objInAuto, function(i, item) {
			var val  = item;
			var vals = item+"|"+objInAutoId[i]+"|"+objInAutoTerm[i];
			$("#txt"+val).autocomplete({source: urlSearch+i+"&s="+vals+"&t=2",minLength: 2,autoFocus:true,
				select:function(event,ui) {asignaDatosProducto(i, ui.item);},
				change:function(event,ui) {asignaDatosProducto(i, ui.item);}
			});
			$("#txt"+val).on("change",function(){
				//$("#"+objInAutoId[i]).val(0);
			})
	});
	
	function asignaDatosProducto(i, item){
		    $("#"+objInAutoId[i]).val(item.id);
		     $("#formBody > fieldset > input[name='idprod']").val(item.id);
		    //alert( $("#formBody > fieldset > input[name='idprod']").val() );
		    $("#precio_unitario").val(item.p_venta);
		    $("#cantidad").focus();
	}
	
	$("#cantidad").on("change",function(event){calculate();})
	$("#precio_unitario").on("change",function(event){calculate();})
	$("#importe").on("change",function(event){calculate();})
	
	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})

	
	tablaDeElementos();
	
	stream.on("servidor", jsNewReg);  
	

	
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

function calculate(){
	var cant = parseFloat($("#cantidad").val()).toFixed(2);
	var pv   = parseFloat($("#precio_unitario").val()).toFixed(2);
	var imp  = parseFloat(pv*cant).toFixed(2);
	$("#importe").val(imp);
}

function jsNewReg(datosServer){
	if (datosServer.mensaje=="p5"){
		tablaDeElementos();
	}
}

function buscarContrato(responseText, statusText, xhr, $form){
	sayMsgPreloading($("#msgResponse"),1);
	$("#formBody").clearForm();
	$("#formBody").resetForm();
	
	var queryString = $form.formSerialize(); 
	
	//alert(queryString);
     var err1 = "Núm de Contrato no encontrado";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:9, p:4,c:queryString },
		function(json){
			if (json.length==0) {
				sayMessage("",err1,$("#msgResponse"),"");  
				idcontrato = 0;
				return false;}
			else{
				if (parseInt(json[0].idcontrato)>0){
				   idcontrato = parseInt(json[0].idcontrato);
				   $("#formBody > fieldset > input[name='idcontrato']").val(idcontrato);
				   $('#formBody > fieldset > input[name="guia"]').val(json[0].guia);
				   $("#guiaContrato").text(json[0].guia);
				   $("#txtCliente").text(json[0].cliente);
				   $("#txtAgente").text(json[0].agente);
				   $("#txtTotalVenta").text(json[0].total_venta);
				   
				   $("#txt_viProductos").focus();
				   $("#msgResponse").hide();
				   
				   getPaginacion(idcontrato,"contratos_detalles","idcontrato", oPag);

				   tablaDeElementos();

				}else{
				     idcontrato = 0;
					sayMessage("",err1,$("#msgResponse"),"");
					return false;
				}
			}
			$(form).clearForm();
			$(form).resetForm();
 	}, "json");
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
			
			//alert(json[0].msg);
			
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			
			if (json[0].msg=="OK"){
				$form.clearForm();
				$form.resetForm();
				tablaDeElementos();
				stream.emit("cliente", {mensaje: "p5"});
				if (tipo == 0 || tipo == 2){
				   getPaginacion(idcontrato,"contratos_detalles","idcontrato", oPag);
				}
				$('#formBody > fieldset > input[name="idcontrato"]').val(idcontrato);
				$('#formBody > fieldset > input[name="guia"]').val($("#guiaContrato").text());

			}
 		}, "json"
	);
}

//Listado Registros Completos
function tablaDeElementos(){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	//alert("idcontrato = "+idcontrato+" "+oBy+orderBy);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:10, p:3,c:" where idcontrato = "+idcontrato+" "+oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina },
		function(json){
			if (json.length<=0) { return false;}
			cargarRegistrosLeidos(json);
 	}, "json");
}

function cargarRegistrosLeidos(json){
	//event.preventDefault();
	var str = "";
	var suma = 0;
	
	$("#tableList tbody").html("");
	$.each(json, function(i, item) {

		var id=item.idcontratodetalles;

		arrItems[i] = {idcontratodetalles:item.idcontratodetalles,idcontrato:item.idcontrato, idproducto:item.idproducto, 
					precio_unitario:item.precio_unitario,producto:item.producto, cantidad:item.cantidad, 
					importe:item.importe, medida:item.medida,grupo:item.grupo, esquemado_el:item.esquemado_el, 
					esquemado_fecha:item.esquemado_fecha, validado_el:item.validado_el, tipo_publicacion:item.tipo_publicacion,
					tipopub:item.tipopub, finicio:item.inicio, ffin:item.ffin, guia:item.guia, script:item.script
					};
					
		str = "";
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		str +='<td><span>'+item.producto+'</span></td>'; 
		str +='<td><span class="money">'+item.precio_unitario+'</span></td>'; 
		str +='<td><span class="money">'+item.cantidad+'</span></td>'; 
		str +='<td><span class="money">'+item.importe+'</span></td>'; 
		str +='<td><span>'+item.esquemado_fecha+'</span></td>'; 
		str +='<td><span>'+item.medida+'</span></td>'; 
		str +='<td><span>'+item.grupo+'</span></td>'; 
		str +='<td><span>'+item.tipopub+'</span></td>'; 
		str +="</tr>";
		$("#tableList > tbody").append(str);	
		suma += parseFloat(item.importe);
	});
	index = -1;
	
	obtenerMontoDeConsumoDelContrato(idcontrato,$("#txtTotalVenta"),$("#txtTotalCortesia"),$("#txtTotalConvenio"),$("#txtTotalInterno"));
	
	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
		$('td input[name="radio"]',this).attr("checked", true);
		editarRegistroActual();
	})
	
	$("#sumaTotal").html(suma);


	$(".money").formatCurrency({symbol:''});
	
}


function editarRegistroActual(){
	//event.preventDefault();
	
	tipo = 1;
	$("#formContract > fieldset > input[name='idcontrato']").val(parseInt(arrItems[index].idcontrato));

	$("#formBody > fieldset > input[name='idcontrato']").prop("readonly",false);
	$("#formBody > fieldset > input[name='idcontrato']").val(parseInt(arrItems[index].idcontrato));
	$("#formBody > fieldset > input[name='idcontrato']").prop("readonly",true);

	$('#idcontratodetalles').val(parseInt(arrItems[index].idcontratodetalles));
	$('#idprod').val(parseInt(arrItems[index].idproducto));
	$("#txt_viProductos").val(arrItems[index].producto);
	$("#precio_unitario").val(parseFloat(arrItems[index].precio_unitario).toFixed(2));
	$("#cantidad").val(parseFloat(arrItems[index].cantidad).toFixed(2));
	$("#importe").val(parseFloat(arrItems[index].importe).toFixed(2));
	
	$("#esquemado_el").val(getFecha(arrItems[index].esquemado_el,0));
	$("#ffin").val(getFecha(arrItems[index].ffin,0));

	$('#formBody input[name="tipo_publicacion"]').each(function () {
		if ($(this).val()==arrItems[index].tipo_publicacion){$(this).attr("checked","checked");};
	});		
	
	$("#guia").val(arrItems[index].guia);
	$("#script").val(arrItems[index].script);

	idcontrato = arrItems[index].idcontrato;

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
	var idcontratodetalles = $('input[name=idcontratodetalles]').fieldValue(); 
	var idcontrato = $('input[name=idcontrato]').fieldValue(); 
	var idprod     = $('input[name=idprod]').fieldValue(); 
	var p_venta    = $('input[name=precio_unitario]').fieldValue(); 
	var cantidad   = $('input[name=cantidad]').fieldValue(); 
	var importe    = $('input[name=importe]').fieldValue(); 

	var q = "";
	if (parseInt(idcontrato[0])      <=0 ){q="No hay Contrato.";  }
	else if (parseInt(idprod[0])     <=0 ){q="Seleccione un producto";  }
	else if (parseFloat(p_venta[0])  <=0 ){q="Falta el Precio de Venta";  }
	else if (parseFloat(cantidad[0]) <=0 ){q="Falta la cantidad";  }
	else if (parseFloat(importe[0])  <=0 ){q="Falta el Total";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}else{
		return true;
	}
}


</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

