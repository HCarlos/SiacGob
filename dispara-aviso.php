<?php
$mod = $_GET["mod"];
$idL = $_GET["idL"];
$ret = $_GET["ret"];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
 
<script>
var stream = io.connect('http://187.157.37.204:8080');
stream.emit("cliente", {mensaje: "MOD.<?php echo $mod; ?>.<?php echo $idL; ?>"});
</script>
<?php 
$ret = array();
header("application/json; charset=utf-8");  
header("Cache-Control: no-cache"); 
$m = json_encode($ret[0]->msg=$ret);
echo $m;

 ?>

</body>
</html>