
<!--<div id="dialog" title="">
<form id="catProp" method="post"> 
    Name: <input type="text" name="name" /> 
    Comment: <textarea name="comment"></textarea> 
    <input type="submit" value="Submit Comment" /> 
</form>
</div>
-->
<form id="formBody" class="form ui-widget-content" >
<h3 class="ui-icon-circle-arrow-e">Titulo de Prueba</h3>
       
    <fieldset>
        <label for="app">Ap. Paterno</label>
        <input type="text" name="app" id="app" title="Apellido Paterno" maxlength="60" placeholder="Apellido Paterno" autofocus required/>
        <label for="apm" class="fieldset-margin-left">Ap. Materno</label>
        <input type="text" name="apm" id="apm" title="Apellido Materno" maxlength="60" placeholder="Apellido Materno" required/>
        <label for="nombre" class="fieldset-margin-left">Nombre</label>
        <input type="text" name="nombre" id="nombre" title="Nombre" maxlength="60" placeholder="Nombre" required/>
    </fieldset>
        
    <fieldset>
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" title="Correo electrónico" maxlength="40" placeholder="Correo electrónico" required/>
    </fieldset>
        
    <fieldset>
        <label for="url">Sitio Web</label>
        <input type="url" name="sitioweb" id="sitioweb" title="Sitio Web" maxlength="40" placeholder="http://" required/>
    </fieldset>
        
    <fieldset>
        <label for="telefono">Teléfono (opcional)</label>
        <input type="tel" name="telefono" id="telefono" title="Teléfono" maxlength="20" placeholder="(999)999-9999" required pattern="[\(]\d{3}[\)]\d{3}[\-]\d{4}"/>
    </fieldset>
        
    <fieldset>
        <label for="comentario">Comentario (max 100)</label>
        <textarea name="comentario" id="comentario" title="Comentario" cols="30" rows="5" maxlength="100" placeholder="Comentario..." required>
        </textarea>
    </fieldset>
        
    <fieldset>
        <input type="submit" value="Enviar" />
    </fieldset>
</form>

   		<script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>/js/01/catProp.js"></script>
<!--<script src="/js/api/jquery.html5form-1.5-min.js"></script>-->
<script src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>/js/api/jquery.form.js"></script>
		
		<script type="text/javascript"> 
/*		
		if ($("#dialog1" ).dialog("isOpen")){	
			$( "#dialog1" ).dialog({
				modal:false,
				title:obj.cat[obj.index].Catalogo,
				show: "blind",
				hide: "explode",
				position:[520,100]
			
			
			});
			//$("#dialog1").attr("position","relative");
			//$("#dialog1").attr("title",(obj.cat[obj.index].Catalogo)); 
			
		}
		//$("#dialog1").addClass('ui-dialog ui-widget-content');	


$('#formBody').ajaxForm(function() { 
                alert("Thank you for your comment!"); 
            }); 

*/

$('#formBody').submit(function() { 
    // submit the form 
    $(this).ajaxSubmit(function() { 
                alert("Thank you for your comment!"); 
            }); 
    // return false to prevent normal browser submit and page navigation 
    return false; 
});

$("form > h3").text(obj.cat[obj.index].Catalogo); 

		</script> 		
