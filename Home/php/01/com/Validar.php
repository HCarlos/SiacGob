
<div id="msgResponse"></div>

<form id="formContract" class="form fieldset2 heightTit" >
	<fieldset id="itemContract">
	   	<label for="folio">Fecha </label>
        	<input type="date" name="fecha" id="fecha" class=" ui-widget-content ui-corner-all" placeholder="dd/mm/aaaa" value="<?php echo date('Y-m-d'); ?>" required/>
		
          <input type="submit" value="Consultar" />

    </fieldset>
	
	<fieldset>
		<input type="hidden" name="iduser" id="iduser" value="0" />
	</fieldset>
    
</form>


<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="saveItem">Guardar</button>
	<button id="printReceipt">Imprimir</button>
	<span id="spanTitle">Validar Publicidad</span>
</div>

<div id="users-contain" class="form ui-widget-content" >
	<table id="tableList" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="guia">Guia</th>
				<th class="contrato">Contr</th>
				<th class="contratodetalle">Id Det</th>
				<th class="scriptpub">Param</th>
				<th class="opt"></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<style>
#users-contain{position:relative; width:96.7%; padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}

#tableList{ display:inline-table; width:100%;}
#tableList .item{width:100px; padding-top:5px;}
#tableList{display:inline; position:relative;}
.opItem{width:30px; margin-top:3px; background-color:#09F;}
#tableList .contrato{width:50px;}
#tableList .contratodetalle{width:50px;}
#tableList .guia{width:450px;}
#tableList .opt, #tableList .scriptpub{ width:100px;}

#toolbar, #formContract{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
</style>


<script type="text/javascript"> 

	var tipo          = 0;
	var currentItem   = 0;
	var index         = -1;
	var proc          = 2;
	var arrItems      = new Array();
	var arOrderBy     = [" idcontratodetalles asc "," idcontratodetalles desc "];
	var urlSearch     = obj.getValue(0)+"getSR/?o=";
	var orderBy       = arOrderBy[1];
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:20};
	
	
	$("#iduser").val(sessionStorage.Id);
	
	$("#users-contain").css("min-height",function(){
		var initHeight = $(window).height()-obj.height;
		return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
	});
	
	$('#divBotonesDerechos').hide();
	
		
	$("#saveItem").on('click',function(event){
		event.preventDefault();
		sendData();
	});
	
	$("#printReceipt").on('click',function(event){
		event.preventDefault();
		getPrintReceipt();
	});
	

	$("#toolbar form #radio > h1").text("Tabla de "+obj.cat[obj.index].Catalogo); 

<!--	$("#formBody > #h3 > #tituloForm").text(obj.cat[obj.index].Catalogo); 
-->	
	$("#radio").buttonset();

	// Operaciones con el Formulario 
	$('#formContract').submit(function() { 
    		$(this).ajaxSubmit({  success: tablaDeElementos }); 
     	return false; 
	});


	$( "#saveItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
	$( "#printReceipt" ).button({text: true,icons: {primary: "ui-icon-print"}});
	

function sayPintaPaginacion(oPag){
	$("#oPagination").html("");
	for (var i=0;i<oPag.totalPaginas;i++){
		var j = i+1;
		var clasebase = i==0?'oPagBold':'';
		$("#oPagination").append("<a id='oPA-"+i+"' class='oPag "+ clasebase +"'>"+j+"</a>");
	}
	$(".oPag").on("click",function(event){
		var id = event.currentTarget.id;
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
	oPag.currentPage = 0;

	$('#fecha').focus();
}


//Listado Registros Completos
function tablaDeElementos(responseText, statusText, xhr, $form){
	//event.preventDefault();
	$("#tableList > tbody").html(getPreloader());	
	
	var fecha = $("#formContract > fieldset > input[name='fecha']").val();
	var q  = $form.formSerialize();
	//alert(q);
	oBy= orderBy!=""?" Order By ":"";
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:17, p:4,c:q+"|"+oBy+orderBy,from:oPag.currentPage, cantidad:oPag.CantidadPagina },
		function(json){
			//alert(json.length);
			if (json.length<=0) { return false;}
			cargarRegistrosLeidos(json);
 	}, "json");
}

function cargarRegistrosLeidos(json){
	//event.preventDefault();
	var isnulo,isdelitem,isscriptpub,isDisabled;
	var str = "";
	
	$("#tableList tbody").html("");
	$.each(json, function(i, item) {

		var id=item.idcontratoesqval;
		var var1;
		var var2 = "";

		arrItems[i] = {idcontratoesqval:item.idcontratoesqval,idcontratodetalles:item.idcontratodetalles, idcontrato:item.idcontrato, 
					idproducto:item.idproducto,producto:item.producto, idmedida:item.idmedida, 
					medida:item.medida, idprodgpo:item.idprodgpo,tipo_publicacion:item.tipo_publicacion, finicio:item.finicio, 
					ffin:item.ffin, guia:item.guia, script:item.script,
					esquemado:item.esquemado, esquemado_el:item.esquemado_el, validado:item.validado, validado_el:item.validado_el,
					description:item.description, scriptpub:item.scriptpub};
		
		isDisabled = " disabled ";	
		isnulo = item.validado==1?" checked disabled ":"";	
		isdelitem = item.validado==1?'<a id="delCurrentItem-'+i+'" class="delCurrentItem delCurrentItemSpan"> Eliminar</a>':"";	
		isscriptpub = item.scriptpub;//!=null?item.scriptpub:var2;	
		//alert(isnulo);	
		str = "";
		str +='<tr id="tr-'+i+'" class="idsel">';	
		str +='<td><input type="checkbox" id="i-'+i+'" name="checkbox" class="opItem" '+isnulo+' />'+id+'</td>';
		str +='<td><span>'+item.producto+" - "+item.guia+'</span></td>'; 
		str +='<td><span>'+item.idcontrato+'</span></td>'; 
		str +='<td><span>'+item.idcontratodetalles+'</span></td>'; 
		str +='<td><input id="scriptpub-'+i+'" type="text" value="'+isscriptpub+'" '+isDisabled+'/></td>';
		str +='<td><span>'+isdelitem+'</span></th>';
		str +="</tr>";
		$("#tableList > tbody").append(str);	

	});
		

	$(".delCurrentItem").on('click',function(event){
			event.preventDefault();
			var id = event.currentTarget.id;
			var item0 = id.split("-");
			var ind = arrItems[parseInt(item0[1])].idcontratoesqval;
			var iduser = $("#formContract > fieldset > input[name='iduser']").val();
			//alert(ind+obj.sep+iduser);
			$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:2, p:2, c:ind+obj.sep+iduser },
 				function(json){
					alert(json[0].msg);
				     if (json[0].msg=="OK"){
						sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Dato desmarcado con éxito",1000);
 						$("#tr-"+parseInt(item0[1])).remove();		
					}else{
						sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),json[0].msg,2000);
					}
			}, "json");
			 return false;			
	});
		



	$("#tableList tr").on('click',function(event){
		event.preventDefault();
		var i = this.id.split("-");
		index = i[1];
			if ($('#i-'+index).is(':checked') ){
				if ($('#i-'+index).is(':disabled')==false ){
			  		$('#i-'+index).prop('checked', false);
				}
			}else{
			   $('#i-'+index).prop('checked', true);
			}
				
			//	return false;
	})
	index = -1;
}


/* ****************************************************************** */

function validateForm(formData, jqForm, options) { 
	var fecha = $("#formContract > fieldset > input[name='fecha']").val();

	var q = "";
	
	if (!fecha[0] ){q="Seleccione una fecha";  }
  
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}else{
		return true;
	}
}

function sendData(){
	//alert(1);
	var fecha = $("#formContract > fieldset > input[name='fecha']").val();
	var iduser = $("#formContract > fieldset > input[name='iduser']").val();

	var items1 = "";	
	var items2 = "";
	var items3 = "";
	var item0, idcontratoesqval, idcontratodetalles, scriptpub;

	$('#tableList > tbody > tr > td > input[type="checkbox"]:checked').each(function() {
		if ( !$(this).attr('disabled') == true ){
			item0 = this.id.split("-");
			idcontratoesqval   = arrItems[parseInt(item0[1])].idcontratoesqval;
			idcontratodetalles = arrItems[parseInt(item0[1])].idcontratodetalles;
			script = arrItems[parseInt(item0[1])].script;
			scriptpub = $('#tableList > tbody > tr > td > input[id="scriptpub-'+item0[1]+'"]').val();
			idcontratoesqval   = idcontratoesqval==null?0:idcontratoesqval;
			idcontratodetalles = idcontratodetalles==null?0:idcontratodetalles;
			scriptpub = scriptpub==""?"{}":scriptpub;
			if (items1.length==0) {
				items1+=idcontratoesqval.toString();
				items2+=idcontratodetalles.toString();
				items3+=scriptpub;
			}else{
				items1+="|"+idcontratoesqval.toString();
				items2+="|"+idcontratodetalles.toString();
				items3+="___"+scriptpub;
			}
		}
   
	});	
	
	// alert(items1+'.'+items2+'.'+items3+'.'+fecha+'.'+iduser);

	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:0, p:2, c:items1+obj.sep+items2+obj.sep+items3+obj.sep+fecha+obj.sep+iduser },
 		function(json){
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito",1000);
			$('#formContract').submit();
	}, "json");

}

function getPrintReceipt(){
	//printReceipt
	var fec   = $('input[name=fecha]').fieldValue(); 
	var ley = 'VALIDADOS'; 
	//$.post(obj.getValue(0)+"php/01/fe/view_corte_caja1.php", { fecha:fec }, "json");
	//window.location.href = obj.getValue(0)+"php/01/fe/view_corte_caja1.php?fecha="+fec;

	var PARAMS = {fecha:fec,label:ley};  
	var url = obj.getValue(0)+"php/01/docs/list-esq1.php";

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

</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

