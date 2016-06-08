var nodo;
$(document).on("ready",inicio);


function inicio(){
		//alert("Hola Mundo");	
		$("#formulario").on("submit", guardar);
	delete localStorage.nombre;
		transicion();
}

function guardar(pony){
	pony.preventDefault();
	var n = $("#nombre").val();
	//alert("Tu nombre es "+n);
	//return false;
	//alert("1");
	localStorage.nombre = n;
	//alert("2");
	transicion();
}

function transicion(){
	if(localStorage.nombre){
		$("#nombre").hide();
		$('input[type="submit"]').hide();
		$("#historia").slideUp(1000);
		$("label[for='nombre']").text("Que novel "+localStorage.nombre);
		//conectar();
		geolocalizar();
	}

}
function geolocalizar()
{
	navigator.geolocation.getCurrentPosition(
		mostrarMapa,
		errorMapa
	);
}
function mostrarMapa(datos)
{
	var lat = datos.coords.latitude;
	var lon = datos.coords.longitude;
	$("#status").text("Te encontrÃ© en: " + lat + ","
		+ lon);
}
function errorMapa(errorsh)
{
	$("#status").text("Tarde o temprano Â¬_Â¬");
}
function conectar()
{
	nodo = io.connect("http://192.168.1.2:6969");
	nodo.emit("nuevoUsuario", localStorage.nombre);
	nodo.on("saludar", saludo);
}
function saludo(nyancat)
{
	$("#formulario label").text(nyancat + " sÃ­ es chingÃ³n!");
	$("#formulario label").fadeOut().fadeIn();
}






