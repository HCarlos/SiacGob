//

var servidor = require("socket.io").listen(6969);

servidor.sockets.on("connection",inicio);

function inicio(socket){
	socket.on("nuevoUsuario",emitir);
}

function emitir(nomnomnom){
	servidor.sockets.emit("saludar",nomnomnom);
}
