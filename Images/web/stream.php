<!DOCTYPE HTML>
<html>
<head>
<script src="http://187.157.37.204:8080/socket.io/socket.io.js" > </script>
<script>
var stream = io.connect('http://187.157.37.204:8080');

function dispatch(mod,idL){
	stream.emit("cliente", {mensaje: "MOD."+mod+"."+idL});
}
</script>

</head>

<body>
</body>
</html>