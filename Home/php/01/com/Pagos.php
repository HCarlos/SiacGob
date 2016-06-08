
<div id="msgResponse"></div>

<form id="formContract" class="form fieldset2" >
	<fieldset id="itemContract">
	   	<label for="folio">Folio Factura </label>
        	<input type="text" name="folio" id="folio" class="shrt text ui-widget-content ui-corner-all "  autofocus />
	   	
		<label for="idfactura" class="fieldset-margin-left">ID Factura </label>
        	<input type="text" name="idfactura" id="idfactura" class="shrt text ui-widget-content ui-corner-all" />

		<label for="idcli" class="fieldset-margin-left">ID Cliente </label>
        	<input type="text" name="idcli" id="idcli" class="shrt text ui-widget-content ui-corner-all" />

          <input type="submit" value="Consultar" />

	   	<label class="fieldset-margin-left">::: </label>
	   	<label> | </label>
	   	<label id="totalFactura" class="leyend">Total Factura: <span class="moneyBg money"></span></label>
	   	<label> | </label>
	   	<label id="totalPagoFactura" class="leyend">Total Pago Factura: <span class="moneyBg money"></span></label>
	   	<label> | </label>
	   	<label id="saldoCliente" class="leyend">Saldo Cliente: <span class="moneyBg money"></span> </label>
	   	<label> | </label>
	   	<label id="anticiposCliente" class="leyend">Anticipo Cliente: <span class="moneyBg money"></span> </label>
	   	<label> | </label>
	   	<label id="lblFolFac" class="leyend"> </label>
	   	<label> | </label>
	   	<label id="lblCli" class="leyend"> </label>

    
    </fieldset>
    
</form>

<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all" >
	<span class="ui-icon ui-icon-contact" > </span>
	<span id="tituloForm" > ... </span>
</div>
	<fieldset>
	   	<label for="tipo">Tipo de Pago </label>
		<Select name="tipo" id="tipo" size=1 > 
			<OPTION VALUE="0" selected >Seleccione un pago</OPTION>
		</select>
	     
		<label for="fecha" class="fieldset-margin-left">Fecha</label>
        	<input type="date" name="fecha" id="fecha" class=" ui-widget-content ui-corner-all" placeholder="dd/mm/aaaa" value="<?php echo date('Y-m-d'); ?>" required/>
	
	   	<label for="importe" class="fieldset-margin-left">Importe </label>
        	<input type="importe" name="importe" id="importe"  class=" ui-widget-content ui-corner-all"  />

	</fieldset>	

    <fieldset>
	   	<label for="referencia">Referencia </label>
        	<input type="text" name="referencia" id="referencia" class=" ui-widget-content ui-corner-all referencia"   />
		
		<label for="incluirencorte" class="fieldset-margin-left" >Incluir en corte: </label>
		<Select name="incluirencorte"  id="incluirencorte" size=1 > 
			<OPTION VALUE="1" selected >Si</OPTION>
			<OPTION VALUE="0"  >No</OPTION>
		</select>

	</fieldset>

	<fieldset>
		<input type="hidden" name="iduser" id="iduser" value="0" />
		<input type="hidden" id="idfactura" name="idfactura" value="0" />
		<input type="hidden" id="idcli" name="idcli" value="0" />
		<input type="hidden" id="idcontrato" name="idcontrato" value="0" />
		<input type="hidden" id="idingreso" name="idingreso" value="0" />
		<input type="hidden" id="status" name="status" value="1" />
        <input type="submit" value="Enviar" />
	</fieldset>
	
</form>

<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="addItem">Nuevo</button>
	<button id="delItem">Quitar</button>
	<button id="refreshTable">Actualizar</button>
	<button id="printReceipt" target="_blank">Corte de Caja</button>
	<button id="printReceiptPaymentCash" target="_blank">Reimprimir recibo</button>
	<span id="spanTitle">Pagos y Corte de Caja</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="folio">Folio</th>
				<th class="fecha">Fecha</th>
				<th class="cargo">Cargo</th>
				<th class="abono">Abono</th>
				<th class="dtipo">Tipo</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr class="ui-widget-header borderBottom">
				<td></td>
				<td><span>TOTAL</span></td>
				<td></td>
				<td><span class="money " id="sumaTotalCargo"></span></td>
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
#tableList .importe,#tableList .folio,#tableList .fecha{width:100px;}
#tableList .dtipo{width:400px;}
#tableList .referencia{width:400px;}
#tableList .money{ text-align:right; margin-right:1em !important;}
.money, .header1{ text-align:right; display:block; margin-right:1em !important; }

#toolbar, #formContract{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
#referencia{width:400px;}
.ui-autocomplete-loading { background: white url('../../images/img-web/ui-anim_basic_16x16.gif') right center no-repeat; }
.shrt{ width:50px !important} 
.leyend span{ display:inline-block;}
</style>


<script type="text/javascript"> 

	var tipo          = 0;
	var currentItem   = 0;
	var index         = -1;
	var proc          = 2;
	var arrItems      = new Array();
	var arOrderBy     = [" idmovto asc "," idmovto desc "];
	var urlSearch     = obj.getValue(0)+"getSR/?o=";
	var folio         = "";
	var idfactura     = 0;
	var idcli         = 0;
	var idcontrato    = 0;
	var indiceTabla   = 0;
	var saldoCliente  = 0;
	var anticiposCliente = 0; 
	var saldoFactura  = 0;
	var orderBy       = arOrderBy[1];
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:20};
	
	
	$("#iduser").val(sessionStorage.Id);
	
	$("#users-contain").css("min-height",function(){
		var initHeight = $(window).height()-obj.height;
		return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
	});
	
	$('#divBotonesDerechos').hide();
	$("#printReceiptPaymentCash").hide();
		
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
	
	

	$("#printReceipt").on('click',function(event){
		event.preventDefault();
		getPrintReceipt();
	});
	
	$("#printReceiptPaymentCash").on('click',function(event){
		event.preventDefault();
	    printReceiptPaymentCash(-1);
	});
	

	$("#toolbar form #radio > h1").text("Tabla de "+obj.cat[obj.index].Catalogo); 
	$("#formBody > #h3 > #tituloForm").text(obj.cat[obj.index].Catalogo); 
	$("#radio").buttonset();

	// Operaciones con el Formulario 
	$('#formContract').submit(function() { 
    		$(this).ajaxSubmit({  success: buscarFactura }); 
     	return false; 
	});

	// Operaciones con el Formulario 
	$('#formBody').submit(function() { 
    		$(this).ajaxSubmit({ beforeSubmit: validateForm, success: invocarFormulario }); 
     	return false; 
	});


	$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
	$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}});
	$( "#printReceipt" ).button({text: true,icons: {primary: "ui-icon-print"}});
	$( "#printReceiptPaymentCash" ).button({text: true,icons: {primary: "ui-icon-print"}});
	
	getTipoPagos();

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
	idfactura        = 0;
	idcli            = 0;
	idcontrato       = 0;
	saldoCliente     = 0;
	anticiposCliente = 0;
	saldoFactura     = 0;
	idingreso        = 0;
	folio            = "";
	oPag.currentPage = 0;
	$("#printReceiptPaymentCash").hide();

	refreshLabel();
	
	$('#importe').focus();
}
function jsNewReg(datosServer){
	if (datosServer.mensaje=="p7"){
		tablaDeElementos();
	}
}

function buscarFactura(responseText, statusText, xhr, $form){
	$("#tableList > tbody").html(getPreloader());
	sayMsgPreloading($("#msgResponse"),1);
	$("#formBody").clearForm();
	$("#formBody").resetForm();
	
	var queryString = $form.formSerialize(); 
	
	refreshLabel();
	//var idfa = $("#formContract > fieldset > input[name='idfactura']").val();
	
	//alert(queryString);

	if (queryString.indexOf('NaN')!=-1) {
		alert("-Hay un error en esta operación. Imprime la Pantalla y envísale a Carlos Hidalgo \n\n"+queryString);
		return false;
	}
	
	
     var err1 = "Dato no encontrado";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:14, p:4,c:queryString },
		function(json){
			//alert(json.length);
			if (json[0].idcontrato<=0 && json[0].idcli<=0 ) {
				sayMessage("",json[0].referencia,$("#msgResponse"),"");  
				clearObjects();
				return false;
			}else{
				   idcli = parseInt(json[0].idcli);
				   idfactura = parseInt(json[0].idfactura);
				   idcontrato = json[0].idcontrato!=null?parseInt(json[0].idcontrato):0;
				   idingreso = parseInt(json[0].idingreso);
				   
				  //alert(idcontrato); 
				   
				   $("#formBody > fieldset > input[name='idcli']").val(idcli);
				   $("#formBody > fieldset > input[name='idfactura']").val(idfactura);
				   $("#formBody > fieldset > input[name='idcontrato']").val(idcontrato);
				   $("#formBody > fieldset > input[name='idingreso']").val(idingreso);
				   
				   $("#formContract > fieldset > input[name='idfactura']").focus();
				   $("#msgResponse").hide();
				   
				   getPaginacion(idfactura,"_viMovimientos","idfactura", oPag);
				   
				  // alert("A");
				     tablaDeElementos();
				    
			}
			$(form).clearForm();
			$(form).resetForm();
			//clearObjects();
 	}, "json");
}


function invocarFormulario(responseText, statusText, xhr, $form){
	//event.preventDefault();
 //alert($form); 
	//   return false;	
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $form.formSerialize(); 
	
	if (queryString.indexOf('NaN')!=-1) {
		alert("Hay un error en esta operación. Imprime la Pantalla y envísale a Carlos Hidalgo \n\n"+queryString);
		return false;
	}
	
	//alert(queryString);
	
	// alert(obj.index);
	
	// return false;
	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			
			//alert(json[0].msg);
			
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			var sms = json[0].msg.split('.');
			if (sms[0]=="OK"){
				$form.clearForm();
				$form.resetForm();
				clearObjects();
				//tablaDeElementos();
				
				stream.emit("cliente", {mensaje: "p7"});
				
				//alert(sms[1]);
				
				if (tipo==0){
					printReceiptPaymentCash(parseInt(sms[1]));
				}
				
				if (tipo == 0 || tipo == 2){
				   getPaginacion(folio,"facturas_encab","folio", oPag);
				    $("#formContract").submit();
				}
				
			}
 		}, "json"
	);
}


//Listado Registros Completos
function tablaDeElementos(){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	

	var folio = $("#formContract > fieldset > input[name='folio']").val();
	var idfactura = $("#formContract > fieldset > input[name='idfactura']").val();
	var idcli = $("#formContract > fieldset > input[name='idcli']").val();



	var q = "";
     if (folio != ""){
		q = " where folio = '"+folio+"' ";
	}else if(idfactura!=""){
		q = " where idfactura = "+idfactura;
	}else{
		q = " where idcli = "+idcli;
	}
	
	//alert(q);
	
	oBy= orderBy!=""?" Order By ":"";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:15, p:4,c:q+" "+oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina },
		function(json){
			//alert(json.length);
			if (json.length<=0) { return false;}
			cargarRegistrosLeidos(json);
 	}, "json");
}

function cargarRegistrosLeidos(json){
	//event.preventDefault();
	var str = "";
	var suma = 0;
	var sumac = 0;
	var facPag;
	$("#tableList tbody").html("");
	refreshLabel();	
	$.each(json, function(i, item) {

		var id=item.idingreso;
          //alert(id);
		idcontratox = item.idcontrato!=null?parseInt(item.idcontrato):0;
		arrItems[i] = {idmovto:item.idmovto, idcli:item.idcli, idfactura:item.idfactura, idingreso:item.idingreso, fecha:item.fecha, 
					dfecha:item.dfecha, cargo:item.cargo, abono:item.abono, tipo:item.tipo, id:item.id, tipoi:item.tipoi, 
					referencia:item.referencia, razon_social:item.razon_social, saldo:item.saldo, total:item.total, 
					total_abono:item.total_abono, fecha_total_pagado:item.fecha_total_pagado, dfecha_abono:item.dfecha_abono, 
					tipo_pago:item.tipo_pago, idcontrato:idcontratox, referfac:item.referfac, anticipos:item.anticipos,
					status:item.status,incluirencorte:item.incluirencorte, i_status:item.i_status};


					//alert(item.status);
		facPag = 	(parseInt(item.status)==1)?'facPag':'';	
		//alert(facPag);	
		str = "";
		str +='<tr id="tr-'+i+'" class="idsel '+ facPag + '">';	
		if (item.cargo>0) {
			str +='<td></td>';
		}else{
			str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opItem" />'+id+'</td>';
		}
		str +='<td><span>'+item.folio+'</span></td>'; 
		str +='<td><span>'+item.dfecha+'</span></td>'; 
		str +='<td><span class="money">'+item.cargo+'</span></td>'; 
		str +='<td><span class="money">'+item.abono+'</span></td>'; 
		if (item.cargo>0){
			str +='<td><span >'+item.referfac+'</span></td>'; 
		}else{
			str +='<td><span >'+item.tipo_pago+' '+item.referencia+'</span></td>'; 
		}
		str +="</tr>";
		//alert (str);
		$("#tableList > tbody").append(str);	
		suma  += parseFloat(item.abono);
		sumac += parseFloat(item.cargo);
		saldoCliente = item.saldo*-1;
		anticiposCliente = item.anticipos;//*-1;
		saldoFactura = parseFloat(item.total_factura) - parseFloat(item.total_abono);
     if (folio != "" || idfactura!=""){
		$("#totalFactura span").html(item.total_factura);
		$("#totalPagoFactura span").html(item.total_abono);
		$("#saldoCliente span").html(saldoCliente);
	}else{
		$("#totalFactura span").html("");
		$("#totalPagoFactura span").html("");
		$("#saldoCliente span").html("");
	}
		$("#anticiposCliente span").html(anticiposCliente);
		$("#lblFolFac").html(idfactura);
		$("#lblCli").html(idcli);
		
	});
	index = -1;
	
	
	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
		if (arrItems[index].cargo<=0){
			$('td input[name="radio"]',this).attr("checked", true);
			editarRegistroActual();
		}else{
			alert("Elemento no editable");
		}
	})
	
	$("#sumaTotal").html(suma);
	$("#sumaTotalCargo").html(sumac);


	$(".money").formatCurrency({symbol:''});
	
}

function editarRegistroActual(){
	//event.preventDefault();
	
	tipo = 1;
	idcli = parseInt(arrItems[index].idcli);
	idfactura = parseInt(arrItems[index].idfactura);
	idcontrato = parseInt(arrItems[index].idcontrato);
	idingreso = parseInt(arrItems[index].idingreso);
	istatus = parseInt(arrItems[index].i_status);
				   
	$("#formBody > fieldset > input[name='idcli']").val(idcli);
	$("#formBody > fieldset > input[name='idfactura']").val(idfactura);
	$("#formBody > fieldset > input[name='idcontrato']").val(idcontrato);
	$("#formBody > fieldset > input[name='idingreso']").val(idingreso);
	$("#formBody > fieldset > input[name='status']").val(istatus);

	$("#importe").val(parseFloat(arrItems[index].abono).toFixed(2));
	$("#tipo").val(parseInt(arrItems[index].tipoi));
	$("#referencia").val(arrItems[index].referencia);
	$("#fecha").val(getFecha(arrItems[index].fecha,$("#fecha")));
	
	
	$("select[name=incluirencorte]").val(arrItems[index].incluirencorte);
	
	$("#printReceiptPaymentCash").show();
				   
	$("#formContract > fieldset > input[name='idfactura']").focus();
	
	//alert(idcontrato);

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
					$("#formBody > fieldset > input[name='status']").val(99);

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

function validateForm(formData, jqForm, options) { 
	var importe  = parseFloat($('input[name=importe]').fieldValue()).toFixed(2); 
	var tipop = $('select[name=tipo]').fieldValue(); 
	var idcontrato = $('select[name=idcontrato]').fieldValue(); 
	var idfactura = $('select[name=idfactura]').fieldValue(); 
	var idingreso = $('select[name=idingreso]').fieldValue(); 

	var folio = $("#formContract > fieldset > input[name='folio']").val();
	var idfactura = $("#formContract > fieldset > input[name='idfactura']").val();
	var idcli = $("#formContract > fieldset > input[name='idcli']").val();




	var q = "";
	
	/*
	alert(parseInt(tipop[0]));
	alert(importe);
	alert(anticiposCliente);
	alert(tipo);
	//return false; 
	*/
	
	if (importe<=0 && tipo == 0){q="Falta el Importe";  }
	else if (parseInt(tipop[0])     <=0 ){q="Seleccione el Tipo de Pago";  }
	else if (parseInt(idcli[0])>0 && !folio[0] && !idfactura[0] && parseInt(tipop[0])!=6 ){q="Seleccione Tipo de Pago Anticipo";  }
	else if (parseInt(tipop[0])!=7 && parseInt(tipop[0])!=6 && importe>saldoFactura && tipo == 0 ){q="No puede abonar una cantidad superior al saldo de la factura("+saldoFactura+") o menor o igual a cero";  }
	else if (parseInt(tipop[0])==7 && anticiposCliente>0 && importe>parseFloat(anticiposCliente) && tipo == 0 ){q="No puede abonar una cantidad superior a la del cliente no menor o igual que cero";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}else{
		return true;
	}
}

function getTipoPagos(){
	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:0, p:0, c:'' },
 		function(json){
			if (json.length<=0) { return false;}
			$("select[name='tipo']").html('<OPTION VALUE="0" selected >Seleccione un Tipo de Pago</OPTION>');	
			$.each(json, function(i, item) {
				$('select[name="tipo"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
		});
		//getProdCont();
	}, "json");

}

function getPrintReceipt(){
	//printReceipt
	var fec  = $('input[name=fecha]').fieldValue(); 
	//$.post(obj.getValue(0)+"php/01/fe/view_corte_caja1.php", { fecha:fec }, "json");
	//window.location.href = obj.getValue(0)+"php/01/fe/view_corte_caja1.php?fecha="+fec;

	var PARAMS = {fecha:fec};  
	var url = obj.getValue(0)+"php/01/fe/view_corte_caja1.php";

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


function printReceiptPaymentCash(piding){

	var fec    = $('input[name=fecha]').fieldValue(); 
	var piding = $('input[name=idingreso]').fieldValue(); 

	var PARAMS = {iding:piding,fecha:fec};  
	
	var url = obj.getValue(0)+"php/01/fe/receipt_payment_cash.php";

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

function refreshLabel(){
	
	$("#totalFactura span").html("");
	$("#totalPagoFactura span").html("");
	$("#saldoCliente span").html("");
	$("#anticiposCliente span").html("");
	$("#lblFolFac").html("");
	$("#lblCli").html("");
}

stream.on("servidor", jsNewReg);  

</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

