
<div id="msgResponse"></div>
<form id="formBody" class="form ui-widget-content" >
<div id="h3" class="ui-widget-header ui-corner-all">
	<span class="ui-icon ui-icon-contact"></span>
	<span id="tituloForm">Titulo de Prueba</span>
</div>
       
    <fieldset>
		<label for="username">Username</label>
        	<input type="text" name="username" id="username" title="Nombre de Usuario" maxlength="60" placeholder="Username" autofocus required/>
		
		<input type="password" name="password" id="password" title="Password" maxlength="14" min="4" 
			   placeholder="Password" value="" class="text ui-widget-content ui-corner-all" />

    </fieldset>
    <fieldset>
	     
		<label for="idper" >ID Personal: </label>
		<select name="idper" id="idper" size=1  value="0" > 
	   	</select>
		
	     <label for="idprodgpo" class="fieldset-margin-left" >Dependencia: </label>
		<select name="idprodgpo" id="idprodgpo" size=1  value="0" > 
	   	</select>
		
    
    </fieldset>
        
    <fieldset>
		<input type="hidden" name="iduser" id="iduser" value="0" />
          <input type="submit" value="Enviar" />
    </fieldset>
</form>


<div id="toolbar" class="ui-widget-header ui-corner-all">
	<button id="addItem">Nuevo</button>
	<button id="delItem">Quitar</button>
	<button id="changePass">Cambiar password</button>
	<button id="refreshTable">Actualizar</button>
</div>



<div id="users-contain" class="form ui-widget-content" >
	<table id="tblUsers" class="table_base" >
		<thead>
			<tr class="ui-widget-header">
			     <th class="item">Item</th>
				<th class="username">Username</th>
				<th class="idper">Nombre Completo</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<style>
#tblUsers{display:inline; position:relative;}
#tblUsers .item{width:100px; padding-top:5px;}
.opIduser{width:30px; margin-top:3px; background-color:#09F;}
#tblUsers .username{width:200px;}
#tblUsers .idper{width:400px;}
/*
#toolbar{margin-top:1em; text-align:left; width:96% !important; margin-left:1.4em; margin-bottom:2em; padding: 1em 0.4em; }
#toolbar form #radio > h1{ display:inline; text-align:right; margin:0px; padding:0px; border:0; margin-left:10em;}
*/
#toolbar{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formBody, #users-contain { width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden; height:52% !important; text-align:left; }
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
</style>


<script type="text/javascript"> 
	var currentItem   = 0;
	var proc          = 2;
	var tipo      = 0;
	var index     = -1;
	var arrUsers  = new Array();
	var arOrderBy = [" iduser asc "," iduser desc "," username asc "," username desc "," nombre_completo asc "," nombre_completo desc "];
	var arrItems      = new Array();
	var objInAuto     = ["_viDemanda"];
	var objInAutoId   = ["iddenuncia"];
	var objInAutoTerm = ["iddenuncia"];
	var orderBy       = arOrderBy[1];
	var urlSearch     = obj.getValue(0)+"getSR/?o=";
	var oPag          = {totalPaginas:0,currentPage:0,CantidadPagina:5};
	var query         = "";
	var indice        = 0;
	
	
	
	
	$("#iduser").val(sessionStorage.Id);


	$("#tblUsers > tbody").html(getPreloader());	

	//Listado del Combo de Personas
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:200, p:0 },
		function(json){
			if (json.length<=0) { return false;}
				$("select[name='idper']").html('<OPTION VALUE="0" selected >Seleccione una opción</OPTION>');	
				$.each(json, function(i, item) {
					$('select[name="idper"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
				});
 		}, "json"
	);

	//Listado del Combo de Grupos
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:201, p:0 },
		function(json){
			if (json.length<=0) { return false;}
				$("select[name='idprodgpo']").html('<OPTION VALUE="0" selected >Seleccione una opción</OPTION>');	
				$.each(json, function(i, item) {
					$('select[name="idprodgpo"]').append('<option value="'+item.data+'">'+item.label+'</option>');	
				});
 		}, "json"
	);


	
	$("#addItem").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		$('#formBody').clearForm();
		$('#formBody').resetForm();
		$('select[name="idper"] option:first-child').attr("selected",true);
		$("#iduser").val(0);
		$('td input[name="radio"]').each(function () {$(this).attr("checked",false);index = -1;});		
		$("#formBody > fieldset > #password").css("visibility","visible");
		orderBy=arOrderBy[0];
		$('#username').focus();
	});
	
	
	$("#delItem").on('click',function(event){
		event.preventDefault();
		tipo = 2;
		eliminarRegistroActual();
		
	});
	
	$("#changePass").on('click',function(event){
		event.preventDefault();
		cambiarPassword();
		
	});

	$("#refreshTable").on('click',function(event){
		event.preventDefault();
		tipo = 0;
		tablaDeUsuarios();
		
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
	$('#form-change-pass').submit(function() { 
    		$(this).ajaxSubmit({ beforeSubmit: validateChangePass, success: invocarFormularioCambiarPassword }); 
     	return false; 
	});
	
	// Por Cadenas de Markov
	$(".item").on("click",function(){
		orderBy = orderBy == arOrderBy[0] ? arOrderBy[1]:arOrderBy[0];
		tablaDeUsuarios();
	});
	$(".username").on("click",function(){
		orderBy = orderBy == arOrderBy[2] ? arOrderBy[3]:arOrderBy[2];
		tablaDeUsuarios();
	});
	
	$(".idper").on("click",function(){
		orderBy = orderBy == arOrderBy[4] ? arOrderBy[5]:arOrderBy[4];
		tablaDeUsuarios();
	});

	tablaDeUsuarios();
	

function invocarFormulario(responseText, statusText, xhr, $form){
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $form.formSerialize(); 
	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			if (json[0].msg=="OK"){
				$form.clearForm();
				$form.resetForm();
				tablaDeUsuarios();
			}
					
 		}, "json"
	);
}


//Listado Grupos de Usuarios
function tablaDeUsuarios(){

	$("#tblUsers > tbody").html(getPreloader());	
	oBy= orderBy!=""?" Order By ":"";
	//alert(orderBy);
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:0, p:3,c:oBy+orderBy },
		function(json){
			if (json.length<=0) { return false;alert("Error.");}
		     $("#tblUsers tbody").html("");
			$.each(json, function(i, item) {
				var id=item.iduser+"-"+item.idper;
				arrUsers[i] = {iduser:item.iduser, username:item.username, password:item.password, idper:item.idper, idprodgpo:item.idprodgpo};
				var str = "";
				str +='<tr id="tr-'+i+'" class="idsel">';	
				str +='<td><input type="radio" id="i-'+id+'" name="radio" class="opIduser" />'+item.iduser+'</td>';
				str +='<td><span>'+item.username+'</span></td>'; 
				str +='<td>'+item.nombre_completo+'</td>';
				str +="</tr>";
				$("#tblUsers > tbody").append(str);	
			});
			index = -1;
			$("#tblUsers tr").on('click',function(event){
				event.preventDefault();
				var i = this.id.split("-");
				index = i[1];
				$('td input[name="radio"]',this).attr("checked", true);
				$("#formBody > fieldset > #password").css("visibility","hidden");
				editarRegistroActual();
			})
 	}, "json");
}



function editarRegistroActual(){
	tipo = 1;
	$("#username").val(arrUsers[index].username);
	$("#iduser").val(parseInt(arrUsers[index].iduser));
	$("#iduser2").val(parseInt(arrUsers[index].iduser));
	$('select[name=idper]').val(parseInt(arrUsers[index].idper));
	$('select[name=idprodgpo]').val(parseInt(arrUsers[index].idprodgpo));
	

}

function eliminarRegistroActual(){
	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:180,
		modal: true,
		buttons: {
			"Eliminar registro": function() {
					tipo = 2;
					invocarFormulario();
					$( this ).dialog( "close" );
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
}


function invocarFormularioCambiarPassword(){
	sayMsgPreloading($("#msgResponse"),-1)
	var queryString = $('#form-change-pass').formSerialize();
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:tipo, p:2,c:queryString },
		function(json){
			sayMessage(json[0].msg,json[0].msg,$("#msgResponse"),"Datos guardados con éxito");
			if (json[0].msg=="OK"){
				$('#form-change-pass').clearForm();
				$('#form-change-pass').resetForm();
				$('#dialog-form').dialog( "close" );
			}
					
 		}, "json"
	);
}

function cambiarPassword(){
	$( "#dialog-form" ).dialog({
		resizable: false,
		height:250,
		width:300,
		modal: true,
		buttons: {
			"Aceptar": function() {
					tipo = 3;
					$("#form-change-pass").submit();
			},
			Cancel: function() {
				$(this).clearForm();
				$(this).resetForm();
				$( this ).dialog( "close" );

			}
		}
	});
}

function validateForm(formData, jqForm, options) { 
	var idper    = $('select[name=idper]').fieldValue(); 
	var dep    = $('select[name=idprodgpo]').fieldValue(); 
	var username = $('input[name=username]').fieldValue(); 
	var password;
	if (tipo==0){
		password = $('input[name=password]').fieldValue(); 
	}
	var iduser   = $('input[name=iduser]').fieldValue(); 
	var q = "";

	if (!username[0]){q="Proporcione un nombre de Usario";  }
		else if (parseInt(idper[0]) <= 0){q="Seleccione un Id Personal";  }
			else if (parseInt(dep[0]) <= 0){q="Selecciones una dependencia";  }
				else if (tipo == 0 && !password[0]){q="Proporcione un password";  }
  //alert(q);
	if (q!=""){
		sayMessage(q,q,$("#msgResponse"),q);
		return false;
	}
}

function validateChangePass(formData, jqForm, options) { 
	   var password  = $('#form-change-pass > fieldset > input[name=password1]').fieldValue(); 
	   var password2 = $('#form-change-pass > fieldset > input[name=password2]').fieldValue(); 
	var iduser2   =    $('#form-change-pass > fieldset > input[name=iduser2]').fieldValue(); 
	var q = "";
	
	if (parseInt(iduser2[0])<=0){q="Seleccione un registro";  }
		else if ( !password[0]){q="Escriba un password";  }
			else if ( !password2[0]){q="Confirme su password";  }
				else if ( password2[0]!=password[0]){q="No coinciden los passwords";  }
  
	if (q!=""){
		sayMessage(q,q,$(".validateTips"),q);
		return false;
	}
}


$( "#addItem" ).button({text: true,icons: {primary: "ui-icon-plusthick"}});
$( "#delItem" ).button({text: true,icons: {primary: "ui-icon-minusthick"}});
$( "#changePass" ).button({text: true,icons: {primary: "ui-icon-key"}})
$( "#refreshTable" ).button({text: true,icons: {primary: "ui-icon-refresh"}})
	   
</script> 	

<div id="dialog-confirm" title="Genesis 3.0" style="display:none;">
	<p><span class="ui-icon ui-icon-help" style="float:left; margin:0 7px 20px 0;"></span>Desea eliminar el elemento seleccionado?</p>
</div>

<div id="dialog-form" title="Cambiar Password" style="display:none;">
	<p class="validateTips"></p>

	<form id="form-change-pass">
	<fieldset>
		<label for="password1" class="xxxx">Password</label>
		<input type="password" name="password1" id="password1" title="Password" maxlength="14" required min="4" 
			   placeholder="Password" value="" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="password2" class="xxxx">Re-Password</label>
		<input type="password" name="password2" id="password2" title="Re-Password" maxlength="14" 
			   placeholder="Re-Password" value="" class="text ui-widget-content ui-corner-all" required min="4" />

		<input type="hidden" name="iduser2" id="iduser2" value="0" />
			   
	</fieldset>
	</form>
</div>

<!--
------------------------------------------
PANEL DE CONTROL DE PERMISOS
------------------------------------------


<div id="dialog-form-security-user" title="Permiso a Usuarios" style="display:none;">
	<p class="validateTips"></p>

	<form id="form-security-user">
	<fieldset>
		<label for="password1" class="xxxx">Password</label>
		<input type="password" name="password1" id="password1" title="Password" maxlength="14" required min="4" 
			   placeholder="Password" value="" class="text ui-widget-content ui-corner-all" /><br/><br/>
		<label for="password2" class="xxxx">Re-Password</label>
		<input type="password" name="password2" id="password2" title="Re-Password" maxlength="14" 
			   placeholder="Re-Password" value="" class="text ui-widget-content ui-corner-all" required min="4" />

		<input type="hidden" name="iduser2" id="iduser2" value="0" />
			   
	</fieldset>
	</form>
</div>
-->


