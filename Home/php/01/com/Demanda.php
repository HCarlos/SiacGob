
<div id="msgResponse"></div>

<form id="formContract" class="form fieldset2" >
	<fieldset id="itemContract">
	   	<label for="idclif">Cliente </label>
        	<input type="number" name="idclif" id="idclif" class="text ui-widget-content ui-corner-all" title="Id Cliente"  placeholder="Núm Cliente" required autofocus />
          <input type="submit" value="Consultar" />
          <input type="search" value="buscar" />
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
	   	
		<label for="rfc" class="fieldset-margin-left" >RFC: </label>
		<Select name="rfc" id="rfc" size=1 required > 
		</select>

		<label for="serie"  class="shrt text ui-widget-content ui-corner-all fieldset-margin-left">Serie: </label>
		<Select name="serie"  id="serie" size=1 > 
			<OPTION VALUE="A" selected >A</OPTION>
			<OPTION VALUE="B"  >B</OPTION>
			<OPTION VALUE="C"  >C</OPTION>
		</select>
		
	   	<label for="folio" class="fieldset-margin-left">Folio </label>
        	<input type="text"  name="folio" id="folio" class="shrt text ui-widget-content ui-corner-all" title="Folio"  placeholder="Folio" maxlength="10" readonly required  />

		<label class="fieldset-margin-left">Calcular IVA  :  </label>            
		<input type = "radio" name = "calcular_iva" id = "civaNo" value = "0" />
          <label for = "civaNo">No</label>
		<input type = "radio" name = "calcular_iva" id = "civaSi" value = "1" checked />
          <label for = "civaSi">Si</label>

		<label class="fieldset-margin-left">Retener ISR  :  </label>            
		<input type = "radio" name = "retener_isr" id = "retisrNo" value = "0" checked/>
          <label for = "retisrNo">No</label>
		<input type = "radio" name = "retener_isr" id = "retisrSi" value = "1"  />
          <label for = "retisrSi">Si</label>

		<label class="fieldset-margin-left">Retener IVA  :  </label>            
		<input type = "radio" name = "retener_iva" id = "retivaNo" value = "0" checked/>
          <label for = "retivaNo">No</label>
		<input type = "radio" name = "retener_iva" id = "retivaSi" value = "1"  />
          <label for = "retivaSi">Si</label>

	</fieldset>	

    <fieldset>
          
	   	<label for="forma_pago">Forma de Pago </label>
		<Select name="forma_pago" id="forma_pago" size=1 > 
			<OPTION VALUE="0" selected >Pago en una sola exhibición</OPTION>
			<OPTION VALUE="1" >Parcialidades</OPTION>
		</select>

	   	<label for="metodo_pago" class="fieldset-margin-left">Método de Pago </label>
		<Select name="metodo_pago" id="metodo_pago" size=1 > 
			<OPTION VALUE="0" selected >Seleccione una opción</OPTION>
			<OPTION VALUE="1"  >Cheque</OPTION>
			<OPTION VALUE="2"  >Tarjeta de Crédito</OPTION>
			<OPTION VALUE="3"  >Tarjeta de Débito</OPTION>
			<OPTION VALUE="4"  >Transferencia Bancaria</OPTION>
			<OPTION VALUE="5"  >No Identificado</OPTION>
			<OPTION VALUE="6"  >Efectivo</OPTION>
			<OPTION VALUE="7"  >Transferencia Electrónica</OPTION>
			<OPTION VALUE="8"  >Transferencia de Fondos</OPTION>
			<OPTION VALUE="9"  >Transferencia Electrónica de Fondos</OPTION>
			<OPTION VALUE="10"  >Cheque nominativo</OPTION>
			<OPTION VALUE="11"  >Transferencias Electrónicas de Fondos</OPTION>
			<OPTION VALUE="12"  >No identificado</OPTION>
		</select>
	     
		<label for="fecha" class="fieldset-margin-left">Fecha</label>
        	<input type="date" name="fecha" id="fecha" class=" ui-widget-content ui-corner-all" title="Fecha de Aplicación" placeholder="dd/mm/aaaa" value="<?php echo date('Y-m-d'); ?>" required/>
	

	</fieldset>	

    <fieldset>
	   	<label for="referencia">Referencia </label>
        	<input type="text" name="referencia" id="referencia" class=" ui-widget-content ui-corner-all"  title="Referencia"  placeholder="Referencia"   />
	   
	   	<label for="email" class="fieldset-margin-left">E-Mail </label>
        	<input type="email" name="email" id="email"  title="E-Mail"  class=" ui-widget-content ui-corner-all"  />

		<label for="idcontpaq" class="fieldset-margin-left" >ContPAQi: </label>
		<Select name="idcontpaq" size=1 required > 
		</select>

	</fieldset>

    <fieldset>

<table class="detFac" >
	<CAPTION>DETALLE DE LA FACTURA</CAPTION>
	<thead>
		<tr>
			<th scope="col" id="th0" width="50">ID</th>
			<th scope="col" id="th1" width="200">Producto</th>
			<th scope="col" id="th2" width="100">Medida</th>
			<th scope="col" id="th3" width="50"><span class="header1">Cant</span></th>
			<th scope="col" id="th4" width="80"><span class="header1">Precio</span></th>
			<th scope="col" id="th5" width="80"><span class="header1">Importe</span></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5" >TOTAL<span id="seekFac"></span></td>
			<td  width="80" ><span class="money" id="tdetFac" >0.00</span></td>
		</tr>
	
	</tfoot>
</table>
<div id="divBotonesDerechos">
        <a class="cmdButton " id="cmdAddFac" ><span class="btnPlusIcon"></span> Agregar</a>
        <a class="cmdButton " id="cmdDelFac" ><span class="btnMinusIcon"></span> Quitar</a>
</div>    

	</fieldset>
		   

	<fieldset>
		<input type="hidden" name="iduser" id="iduser" value="0" />
		<input type="hidden" id="idfactura" name="idfactura" value="0" />
		<input type="hidden" id="tipo_cfdi" name="tipo_cfdi" value="ingreso" />
        <input type="submit" value="Enviar" />
	</fieldset>
	
</form>

<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="addItem">Nuevo</button>
	<button id="delItem">Quitar</button>
	<button id="refreshTable">Actualizar</button>
	<button id="viewInvoice" target="_blank">Visualizar Factura</button>
	<button id="printInvoiceXML1" target="_blank">Timbrar Factura</button>
	<button id="invoicesReport" target="_blank">Listado de Facturas</button>
	<span id="spanTitle">Facturación</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="folio">Folio</th>
				<th class="fecha">Fecha</th>
				<th class="importe">Importe</th>
				<th class="descuento">Descuento</th>
				<th class="iva">IVA</th>
				<th class="total">Total</th>
				<th class="email">E-mail</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr class="ui-widget-header borderBottom">
				<td></td>
				<td><span>TOTAL</span></td>
				<td></td>
				<td><span class="money " id="sumaTotal"></span></td>
				<td colspan="3" >Pagina: <span id="oPagination"></span> </td>
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
#tableList .email{width:400px;}
#tableList .money{ text-align:right; margin-right:1em !important;}
.money, .header1{ text-align:right; display:block; margin-right:1em !important; }

/*
#toolbar{margin-top:1em; text-align:left; width:96% !important; margin-left:1.4em; margin-bottom:2em; padding: 1em 0.4em; }
#toolbar form #radio > h1{ display:inline; text-align:right; margin:0px; padding:0px; border:0; margin-left:10em;}
*/
#toolbar, #formContract{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
.ui-autocomplete-loading { background: white url('images/img-web/ui-anim_basic_16x16.gif') right center no-repeat; }
.shrt{ width:50px !important} 
</style>


<script type="text/javascript"> 

	var tipo          = 0;
	var currentItem   = 0;
	var index         = -1;
	var proc          = 2;
	var arrItems      = new Array();
	var arrDet        = new Array();
	var arOrderBy     = [" idfactura asc "," idfactura desc "," fecha asc "," fecha desc "," importe asc "," importe desc "," email asc "," email desc "];
	var objInAuto     = ["_viFacturasEncab"];
	var objInAutoId   = ["idcontrato"];
	var objInAutoTerm = ["idcontrato"];
	var orderBy       = arOrderBy[1];
	var urlSearch     = obj.getValue(0)+"php/01/getSearch.php?o=";
	var idcontrato    = 0;
	var idfactura     = 0;
	var indiceTabla   = 0;
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:5};
	
	
	$("#iduser").val(sessionStorage.Id);
	
	$("#users-contain").css("min-height",function(){
		var initHeight = $(window).height()-obj.height;
		return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
	});
	
	$('.detFac').hide();
	$('#divBotonesDerechos').hide();
	$('#cmdDelFac').hide();
	
		
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
		oPag.currentPage=0;
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
	$(".fecha").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeElementos();
	});
	$(".importe").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeElementos();
	});
	$(".email").on("click",function(){
		orderBy = orderBy == arOrderBy[6] ? arOrderBy[7]:arOrderBy[6];
		tablaDeElementos();
	});

	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})
	$( "#viewInvoice" ).button({text: true,icons: {primary: "ui-icon-view"}})
	$( "#printInvoiceXML1" ).button({text: true,icons: {primary: "ui-icon-print"}})
	$( "#invoicesReport" ).button({text: true,icons: {primary: "ui-icon-view"}})


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
	$('#formBody').clearForm();
	$('#formBody').resetForm();
	$('#formBody > fieldset > input[name="idcontrato"]').val(idcontrato);
	$(".detFac tbody" ).html("");
	$("#tdetFac").text("0.00");
	idfactura =      0;
	orderBy          = arOrderBy[1];
	oPag.currentPage = 0;
	indiceTabla   = 0;
	$('#rfc').focus();
}

function jsNewReg(datosServer){
	if (datosServer.mensaje=="p6"){
		tablaDeElementos();
	}
}

function buscarContrato(responseText, statusText, xhr, $form){
	$("#tableList > tbody").html(getPreloader());
	sayMsgPreloading($("#msgResponse"),1);
	$("#formBody").clearForm();
	$("#formBody").resetForm();
	
	var queryString = $form.formSerialize(); 
	
	//alert(queryString);
	$(".detFac").hide();
	$("#divBotonesDerechos").hide();
	
     var err1 = "Núm de Contrato no encontrado";
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:9, p:4,c:queryString },
		function(json){
			if (json.length==0) {
				sayMessage("",err1,$("#msgResponse"),"");  
				idcontrato = 0;
				idcli      = 0;
				idfactura  = 0;
				if ($(".detFac").is(":visible")){
					$('.detFac').hide();
					$('#divBotonesDerechos').hide();
					$('#cmdAddFac').hide();
					$('#cmdDelFac').hide();
	     			$('#formBody input[type="submit"]').hide();
				}
				return false;
			}else{
				if (parseInt(json[0].idcontrato)>0){
				   idcontrato = parseInt(json[0].idcontrato);
				   idcli = parseInt(json[0].idcli);
				   $("#formBody > fieldset > input[name='idcontrato']").val(idcontrato);
				   $("#formBody > fieldset > input[name='idcli']").val(idcli);
				   
				   $("#rfc").focus();
				   $("#msgResponse").hide();
				   
				   getPaginacion(idcontrato,"_viFacturasEncab","idcontrato", oPag);
				   
					getRFC(idcli);
					getContPAQi(idcli);
					getProdCont();
				     tablaDeElementos();
					
	     			$('#formBody input[type="submit"]').show();
				    
				     if ($(".detFac").is(':hidden')){
						$('.detFac').show();
						$('#divBotonesDerechos').show();
						$('#cmdAddFac').show();
					}

				}else{
				     idcontrato = 0;
					idcli      = 0;
					idfactura  = 0;
					sayMessage("",err1,$("#msgResponse"),"");
					return false;
				}
			}
			$(form).clearForm();
			$(form).resetForm();
 	}, "json");
}


function invocarFormulario(responseText, statusText, xhr, $form){
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $form.formSerialize(); 
	
	
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			
			if (json[0].msg=="OK"){
				$form.clearForm();
				$form.resetForm();
				clearObjects();
				tablaDeElementos();
				stream.emit("cliente", {mensaje: "p6"});
				if (tipo == 0 || tipo == 2){
				   getPaginacion(idcontrato,"_viFacturasEncab","idcontrato", oPag);
				}
			}
 		}, "json"
	);
}


//Listado Registros Completos
function tablaDeElementos(){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:12, p:3,c:" where idcontrato = "+idcontrato+" "+oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina },
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
	//alert(1);
	$.each(json, function(i, item) {

		var id=item.idfactura;
		var isfe=0;
		var fl = "";
		
		isfe = parseInt(item.isfe);

		var _folio = isfe==1?item.folio:"";
		var attach = 	obj.getValue(0)+'php/01/fe/files/'+item.xml+","+obj.getValue(0)+'php/01/fe/files/'+item.pdf;	
		var emailx = item.email.length>0?'<a href="mailto:'+item.email+'?attachment='+attach+'&subject=Factura '+_folio+'">'+item.email+'</a>':'';
			
		arrItems[i] = {idfactura:item.idfactura,idcontrato:item.idcontrato, idclireg:item.idclireg, 
					serie:item.serie,folio:_folio, fecha:item.fecha, 
					forma_pago:item.forma_pago, metodo_pago:item.metodo_pago,referencia:item.referencia, 
					calcular_iva:item.calcular_iva, 
					retener_isr:item.retener_isr, retener_iva:item.retener_iva, importe:item.importe,
					iva:item.iva,
					total:item.total,
					email:item.email_cli, idcontpaq:item.idcontpaq, idrecibo:item.idrecibo,
					total_abono:item.total_abono,
					status:item.status,
					fecha_total_pagado:item.fecha_total_pagado, 
					isfe:item.isfe, UUID:item.UUID, pdf:item.pdf,
					xml:item.xml,idcli:item.idcli
					};
		
		

		fl = isfe==1?item.serie+zeroPadl(item.folio,7):"";			
					
		str = "";
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		str +='<td><span>'+fl+'</span></td>'; 
		str +='<td><span>'+item.fecha+'</span></td>'; 
		str +='<td><span class="money">'+item.importe+'</span></td>'; 
		str +='<td><span class="money">'+item.descuento+'</span></td>'; 
		str +='<td><span class="money">'+item.iva+'</span></td>'; 
		str +='<td><span class="money">'+item.total+'</span></td>'; 
		str +='<td><span class="email">'+emailx+'</span></td>'; 
		str +="</tr>";
		$("#tableList > tbody").append(str);	
		suma += parseFloat(item.importe);
	});
	index = -1;
	
	//obtenerMontoDeConsumoDelContrato(idcontrato,$("#txtTotalVenta"),$("#txtTotalCortesia"),$("#txtTotalConvenio"),$("#txtTotalInterno"));
	
	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
		$('td input[name="radio"]',this).attr("checked", true);
		editarRegistroActual();
		//alert(index);
	})
	
	$("#sumaTotal").html(suma);


	$(".money").formatCurrency({symbol:''});
	
}

function editarRegistroActual(){
	//event.preventDefault();
	
	tipo = 1;
	
	// alert(index);
	
	$("#formContract > fieldset > input[name='idcontrato']").val(parseInt(arrItems[index].idcontrato));

	$("#formBody > fieldset > input[name='idcontrato']").prop("readonly",false);
	$("#formBody > fieldset > input[name='idcontrato']").val(parseInt(arrItems[index].idcontrato));
	$("#formBody > fieldset > input[name='idcontrato']").prop("readonly",true);

	$('select[name=rfc]').val(arrItems[index].idclireg);
	$('select[name=serie]').val(arrItems[index].serie);
	$("#folio").val(arrItems[index].folio);
	$("select[name=forma_pago]").val(arrItems[index].forma_pago);
	$("select[name=metodo_pago]").val(arrItems[index].metodo_pago);
	$("#referencia").val(arrItems[index].referencia);
	$("#email").val(arrItems[index].email);
	$("#fecha").val(arrItems[index].fecha);
	$('select[name=idcontpaq]').val(arrItems[index].idcontpaq);


	idcontrato = arrItems[index].idcontrato;
	idfactura  = arrItems[index].idfactura;
	
	if (arrItems[index].isfe==0){
		buscarFactura(idfactura);
	     $('#formBody input[type="submit"]').show();
		$("#printInvoiceXML1").show();	
		$("#delItem").show();	
		
	}else{
		 $(".detFac tbody").html("");
	      $('#formBody input[type="submit"]').hide();	
		 $("#printInvoiceXML1").hide();
		 $("#delItem").hide();	
	}

	$('input[name=idfactura]').val(arrItems[index].idfactura);

	$('#formBody input[name="calcular_iva"]').each(function () {
		if ($(this).val()==arrItems[index].calcular_iva){$(this).attr("checked","checked");};
	});		
	$('#formBody input[name="retener_iva"]').each(function () {
		if ($(this).val()==arrItems[index].retener_iva){$(this).attr("checked","checked");};
	});		
	$('#formBody input[name="retener_isr"]').each(function () {
		if ($(this).val()==arrItems[index].retener_isr){$(this).attr("checked","checked");};
	});		

// alert(index);

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


/* ****************************************************************** */

$("#cmdAddFac").on("click",function(event){
	var k;
	if ($(".detFac tbody tr").length<7){
		index++;
		$(".detFac").append(getItemFac(indiceTabla)).find('select[id="row.'+indiceTabla+'"]').each( function(){
			k = $(this);
			k.append('<option value="'+0+'.'+0+'">Seleccione una Opción</option>');	
			$.each(arrDet, function(i, item) {
				k.append('<option value="'+item.idcontratodetalles+'.'+i+'">'+item.producto+'</option>');	
			});
			$(".detFac .fcant").on('change',function(event){getImporte(this);});
			$(".detFac .fpu").on('change',function(event){getImporte(this);});

			$('.detFac input').on('click',function(event){currentItem = this.id.split('.')[1];$('#cmdDelFac').show();})
			$('#cmdDelFac').hide();
			AgregaItemNuevo();
			currentItem=-1;
			indiceTabla++;
		});
	}
});

$("#cmdDelFac").on("click",function(event){
	if(currentItem>-1){
		$(".detFac").find('#tr'+currentItem).each(function(){
			var prod      = $(".detFac input[id='producto."+currentItem+"']").val();
			var med       = $(".detFac input[id='med."+currentItem+"']").val();
			var idfacdet  = $(".detFac input[id='idfacdet."+currentItem+"']").val();
			if (confirm("Deseas eliminar este elemento?\n\n"+prod+' '+med)){
				$(this).remove();
				currentItem=-1;
				getTotalFacDetalle();
				$('#cmdDelFac').hide();
				if (idfacdet>0){
					$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:3, p:2,c:idfacdet },
					function(json){
						alert("Eliminado con éxito");	
 					}, "json"
					);
				}

			}
		})
	}
});



function validateForm(formData, jqForm, options) { 
	var idcontrato  = $('input[name=idcontrato]').fieldValue(); 
	//var forma_pago  = $('select[name=forma_pago]').fieldValue(); 
	var metodo_pago = $('select[name=metodo_pago]').fieldValue(); 
	var rfc         = $('select[name=rfc]').fieldValue(); 
	var idcontpaq   = $('select[name=idcontpaq]').fieldValue(); 

	//else if (parseInt(forma_pago[0])     <=0 ){q="Seleccione una Forma de Pago";  }


	var q = "";
	if (parseInt(idcontrato[0])      <=0 ){q="No hay Contrato.";  }
	else if (parseInt(rfc[0])     <=0 ){q="Seleccione un RFC";  }
	else if (parseInt(metodo_pago[0])     <=0 ){q="Seleccione una Método de Pago";  }
	else if (parseInt(idcontpaq[0])     <=0 ){q="Seleccione una Cuenta";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}else{
		return true;
	}
}




function getRFC(idcli){
	
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:0, p:0, c:'idcliparent='+idcli },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='rfc']").html('<OPTION VALUE="0" selected >Seleccione un RFC</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="rfc"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
		//getProdCont();
	}, "json");

}

function getContPAQi(idcli){
	
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:1, p:0, c:'idcli='+idcli },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='idcontpaq']").html('<OPTION VALUE="0" selected >Seleccione un Cuenta</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="idcontpaq"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
		//getProdCont();
	}, "json");

}

function getProdCont(){
	var lbl;
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:100, p:0, c:'idcontrato='+idcontrato },
 		function(json){
			if (json.length<=0) { return false;}
			//$(".listaContratoDetalles").html('<OPTION VALUE="0" selected >Seleccione un RFC</OPTION>');	
			//$('.listaContratoDetalles').append('<option value="'+0+'.'+0+'">Seleccione una Opción</option>');	
			$.each(json, function(i, item) {
				lbl =item.label.split('|');
			   	arrDet[i] = {producto:lbl[0],idmedida:parseInt(lbl[1]),medida:lbl[2],
						   cantidad:parseFloat(lbl[3]).toFixed(2),precio_unitario:parseFloat(lbl[4]).toFixed(2),
						   importe:parseFloat(lbl[5]).toFixed(2),iva:parseFloat(lbl[6]).toFixed(2),
						   total:parseFloat(lbl[7]).toFixed(2),idcontratodetalles:item.data,
						   idproducto:parseInt(lbl[8]),idfacdet:0};
			});
			//alert(json.length);
		
	}, "json");

}

function AgregaItemNuevo(){
	$(".listaContratoDetalles").on("change",function(event){
		var ele = event.currentTarget.id.split(".");
		var ind = parseInt(ele[1]);
	
		ele = $(this).val().split('.');

		$("input[id='idcontratodetalles."+ind+"']").val(parseInt(arrDet[ele[1]].idcontratodetalles));
		$("input[id='idproducto."+ind+"']").val(parseInt(arrDet[ele[1]].idproducto));
		$("input[id='idfactura."+ind+"']").val(parseInt(arrDet[ele[1]].idfactura));
		$("input[id='med."+ind+"']").val(arrDet[ele[1]].medida);
		$("input[id='producto."+ind+"']").val(arrDet[ele[1]].producto);
		$("input[id='cantidad."+ind+"']").val(parseFloat(arrDet[ele[1]].cantidad).toFixed(2));
		$("input[id='cantidad."+ind+"']").attr("alt",parseFloat(arrDet[ele[1]].cantidad).toFixed(2));
		$("input[id='precio_unitario."+ind+"']").val(parseFloat(arrDet[ele[1]].precio_unitario).toFixed(2));
		$("input[id='precio_unitario."+ind+"']").attr("alt",parseFloat(arrDet[ele[1]].precio_unitario).toFixed(2));
		$("input[id='importe."+ind+"']").val(parseFloat(arrDet[ele[1]].importe).toFixed(2));
		$("input[id='importe."+ind+"']").attr("alt",parseFloat(arrDet[ele[1]].importe).toFixed(2));
          getTotalFacDetalle();
		$(".money").formatCurrency({symbol:''});
	 
	});
}

function getImporte(evento){
	var ind = evento.id.split('.')[1];

	var cant = parseFloat($("input[id='cantidad."+ind+"']").val().replace(",", "")).toFixed(2);
	var pu = parseFloat($("input[id='precio_unitario."+ind+"']").val().replace(",", "")).toFixed(2);

	var imp = parseFloat(cant * pu).toFixed(2);
	$("input[id='importe."+ind+"']").val(imp);
	$("input[id='importe."+ind+"']").attr("alt",imp);
	getTotalFacDetalle();
	
}

function getTotalFacDetalle(){
	var imp = 0;
	$(".detFac").find(".imp").each(function(){
		imp = imp + parseFloat(this.alt);
	});
	$(".detFac").find("#tdetFac").each(function(){
		$(this).text(parseFloat(imp).toFixed(2));
	});
	$(".money").formatCurrency({symbol:''});
}

function buscarFactura(idfactura){
	var lbl,idprd,ind, flag;
	$("#seekFac").html(getPreloader());
	indiceTabla=0;
	$.post(obj.getValue(0)+"php/01/getDataCat.php", { o:obj.index, t:13, p:3, c:' where idfactura='+idfactura },
 		function(json){
			
			if (json.length<=0) {$("#seekFac").html(""); return false;}
			
			$(".detFac tbody").html("");
			$.each(json, function(i, item) {
				flag = true;
				idprd = item.idproducto;
				ind = arrDet.length+1;
				$.each(arrDet,function(i,item){
					if (item.idproducto == idprd){
						ind = i;
						flag = false;
					}
				});

				if (flag){
			   			   arrDet[ind] = {producto:item.producto,idmedida:parseInt(item.idmedida),medida:item.medida,
						   			cantidad:parseFloat(item.cantidad).toFixed(2),precio_unitario:parseFloat(item.precio_venta).toFixed(2),
						   			importe:parseFloat(item.importe).toFixed(2),iva:parseFloat(item.iva).toFixed(2),
						   			total:parseFloat(item.total).toFixed(2),idcontratodetalles:item.idcontratodetalles,
						   			idproducto:parseInt(item.idproducto),idfactura:parseInt(item.idfactura),desc_prod:item.desc_prod,
						   			desc_medida:item.desc_medida,idfacdet:item.idfacdet};
				}
		index_=ind;
		$(".detFac").append(getCallItemFac(indiceTabla,item)).find('select[id="row.'+indiceTabla+'"]').each( function(){
			k = $(this);
			k.append('<option value="'+0+'.'+0+'">Seleccione una Opción</option>');	
			$.each(arrDet, function(i, item) {
				k.append('<option value="'+item.idcontratodetalles+'.'+i+'">'+item.producto+'</option>');	
			});
			
			$(".detFac .fcant").on('change',function(event){getImporte(this);});
			$(".detFac .fpu").on('change',function(event){getImporte(this);});

			$('.detFac input').on('click',function(event){currentItem = this.id.split('.')[1];$('#cmdDelFac').show();})
			$('#cmdDelFac').hide();
			//AgregaItemNuevo();
			$('select[id="row.'+indiceTabla+'"]').val(item.idcontratodetalles+'.'+index_);
			currentItem=-1;
			indiceTabla++;
		});

			});

          getTotalFacDetalle();
		$(".money").formatCurrency({symbol:''});
		$("#seekFac").html("");
		
	}, "json");

}


$("#viewInvoice").on('click',function(event){
	event.preventDefault();

	var queryString = $('#formBody').formSerialize();  
	var PARAMS = {data:queryString};  
	//alert(queryString);
	var url;
	var isfe;
	if ( isDefined(arrItems[index].isfe) ){
		isfe = parseInt(arrItems[index].isfe);
	}else{
		isfe = 0;
	}
	if (isfe==0  ){
	   url = obj.getValue(0)+"php/01/fe/viewInvoice1.php";
	}else{
	   	url = obj.getValue(0)+"php/01/fe/files/"+arrItems[index].pdf;
	}
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

});



$("#printInvoiceXML1").on('click',function(event){
	event.preventDefault();

	var queryString = $('#formBody').formSerialize();  
	var PARAMS = {data:queryString};  
	var url = obj.getValue(0)+"php/01/fe/printInvoiceTest1.php";

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


});


$("#invoicesReport").on('click',function(event){

	$( "#dialog-form-invoices-report" ).dialog({
		resizable: false,
		height:200,
		width:200,
		modal: true,
		buttons: {
			"Aceptar": function() {
					$("#form-invoices-report").submit();
					//$( this ).dialog( "close" );
			},
			Cancel: function() {
				$(this).clearForm();
				$(this).resetForm();
				$( this ).dialog( "close" );

			}
		}
	});



});

function view_invoces_report(formData, jqForm, options) { 
	//event.preventDefault();
     var xfecha = $("#fecha").val();
     var xopciones = $("#opciones").val();
	var PARAMS = {fecha:xfecha,order:xopciones};  
	var url = obj.getValue(0)+"php/01/docs/invoices-report.php";

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

// Show Invoices List
$('#form-invoices-report').submit(function() {
    	$(this).ajaxSubmit({success: view_invoces_report(this)}); 
     return false; 
});



stream.on("servidor", jsNewReg);  

</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

<div id="dialog-form-invoices-report"  title="Tipo de Orden" style="display:none;">

	<form id="form-invoices-report">
	<br/><br/>
	<fieldset>
		<select name="opciones" id="opciones" size=1  value="" >
			<option value="0" selected >Cronológico</option>
			<option value="1"             >Por Empresa</option>
			<option value="2"             >Solo Diario Presente</option>
			<option value="3"             >Solo El Sol del Sureste</option>
			<option value="4"             >Solo Radio F&oacute;rmula</option>
	   	</select>
			   
	</fieldset>
	</form>
</div>

