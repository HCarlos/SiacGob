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
					<select class="listDesde" name="listDesde" multiple="multiple" style="height:75%;">
    					
  					</select>
					
				</div>
				
				<div class="botonesAsignacion">
				     <div class="contentButtonAD">
					<button id="HolaClick" name="btnAsig" class="btnAsig" >Asignar</button><br/><br/>
					<button class="btnDel" >Quitar</button>
					</div>
					
				</div>
				<div id="hastaCat" class="hastaCat">
				<label for="selCombo" class="lblH2cmb">Grupos </label>
				<Select name="selCombo" size=1 onChange="javascript:getCatAsigGPO(this);"> 
				</select>
				<div class="div1em"></div>
				<label for="listHasta" class="lblH2">Asignaciones</label>
				<select class="listHasta" name="listHasta" multiple="multiple">
  				</select>
				</div>
   		<script  src="js/01/asigCatToGpo.js"></script>
		<script type="text/javascript"> 
		

	// Operaciones con el Formulario 
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
	
		
		</script> 		
