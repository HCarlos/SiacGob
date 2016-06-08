				<h2>title</h2>
				<div id="desdeCat" class="desdeCat">
				
	   				<div style="">
					<div id="msgResponse"></div>
					<form id="formFindFac" class="form formSearchMini" >
					<label for="folio">Folio Factura </label>
        				<input type="text" name="folio" id="folio" class="shrt text ui-widget-content ui-corner-all "  autofocus />
					 <input type="submit" value="Buscar" />
					 </form>
					</div>
					<div class="div1em"> </div>
					<label for="listDesde" class="lblH2">Opciones Disponibles</label>
					<select class="listDesde" name="listDesde" multiple="multiple" style="height:25%;">
    					
  					</select>
					<button class="btnOpen" >Abrir</button>
				</div>
				
				<div class="desdeCat">
					<form id="formMiscRep" class="form ui-widget-content" >
					
					<fieldset class=".formContract">
						<label for="fi" class="fieldset-margin-left">Desde:</label>
        					<input type="date" name="fi" id="fi" class=" ui-widget-content ui-corner-all"  placeholder="dd/mm/aaaa" value="<?php echo date('Y-m-d'); ?>" required/>

						<label for="ff" class="fieldset-margin-left">Hasta:</label>
        					<input type="date" name="ff" id="ff" class=" ui-widget-content ui-corner-all"  placeholder="dd/mm/aaaa" value="<?php echo date('Y-m-d'); ?>" required/>
					</fieldset>				
	
					<fieldset class=".formContract">
						<label for="prodgpo" class="fieldset-margin-left" >Serie: </label>
						<Select name="prodgpo" size=1  > 
							<OPTION VALUE="T" selected >Todas</OPTION>
							<OPTION VALUE="A"  >A</OPTION>
							<OPTION VALUE="B"  >B</OPTION>
							<OPTION VALUE="C"  >C</OPTION>
						</select>
					</fieldset>				

					<fieldset class=".formContract">
	   					<label for="formato" class="fieldset-margin-left">Formato </label>
						<Select name="formato" id="formato" size=1 > 
							<OPTION VALUE="rep-fac-1.php" selected >Listado de Facturas a Excel</OPTION>
						</select>
					</fieldset>				
					
					<fieldset class=".formContract">
						 <input type="submit" value="Consultar" />
					</fieldset>				
					
					</form>
				     
				</div>
<style>
.formContract{width:99%; position: relative !important; margin:1em 0px; text-align:left; padding:0.4em 0em 0.5em 0.4em; }
#formMiscRep > fieldset >  input[type=submit]{margin:2em 1.5em; }
</style>				
				
<script type="text/javascript"> 

//prodgpo();

$(".asignaciones1 h2").html(obj.cat[obj.index].Catalogo); 
			
$(".asignaciones1").css("height", function() { return $(window).height()-obj.height;});

		
$("#iduser").val(sessionStorage.Id);
	
$("#users-contain").css("min-height",function(){
	var initHeight = $(window).height()-obj.height;
	return initHeight - ($("#msgResponse").height()+$("#formBody").height()+$("#toolbar").height()+20);
});
	

$('#formFindFac').submit(function() { 
    	$(this).ajaxSubmit({  success: getFactory }); 
     return false; 
});
		
	
function getFactory(event){
		$("#msgResponse").html(getPreloader());
		var x = $('#folio').val();
		$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:0, p:0, c:" cfolio = '"+x+"' " },
 			function(json){
				if (json.length<=0) { return false;}
				$(".listDesde").html('');	
					$.each(json, function(i, item) {
						//alert(item.label);
						$(".listDesde").append('<option value="'+item.data+'">'+item.label+'</option>');	
				});
				$("#msgResponse").html("");
 			},
			"json"
		);

		getCatFac(); $(".asignaciones1 h2").html(obj.cat[obj.index].Catalogo); 
			
		$(".asignaciones1").css("height", function() { return $(window).height()-obj.height;});
		
		
}

// Operaciones con el Formulario de reportes Varios 
$('#formMiscRep').submit(function() { 
    	$(this).ajaxSubmit({ beforeSubmit: validFormMiscRep, success: invocarFormulario }); 
     return false; 
});


function validFormMiscRep(formData, jqForm, options) {
	var startDt=document.getElementById("fi").value;
	var endDt=document.getElementById("ff").value;

	if( (new Date(startDt).getTime() > new Date(endDt).getTime())){
		alert("La fecha inicial no puede ser mayor a la fecha final");
		return false;
	}

}

function invocarFormulario(formData, jqForm, options) { 

	var queryString = $('#formMiscRep').formSerialize();  
	//alert(queryString);
	var PARAMS = {data:queryString};  
	var url = obj.getValue(0)+"php/01/docs/rep-fac-1.php";

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

function prodgpo(){	
	$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:0, p:0 },
 		function(json){
			if (json.length<=0) { return false;}
			$("#prodgpo").html('');	
			$.each(json, function(i, item) {
				//alert(item.label);
				$("select[name=prodgpo]").append('<option value="'+item.data+'">'+item.label+'</option>');	
			});
 		},
		"json"
	);
}

	
		
</script> 		
