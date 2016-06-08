				<h2>title</h2>
				<div id="desdeCat" class="desdeCat">
					<label for="listDesde" class="lblH2">Opciones Disponibles</label>
					<select class="listDesde" name="listDesde" multiple="multiple">
    					
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
   		<script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/01/asigCatToGpo.js"></script>
		<script type="text/javascript"> 
		
			getCat(); $(".asignaciones1 h2").html(obj.cat[obj.index].Catalogo); 
			
			$(".asignaciones1").css("height", function() { return obj.getMinHeight();});
		
		
		</script> 		
