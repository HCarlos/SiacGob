<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SIAC | Centro 2013 - 2015</title>
<link rel="stylesheet" type="text/css" href="../../../css/01/class_gen.css"/>
</head>

<body>

<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Mexico_City');
set_include_path(get_include_path() . PATH_SEPARATOR . '../PHPExcel/Classes/');
set_time_limit(600);

require_once("../PHPExcel/Classes/PHPExcel.php");
require_once("../PHPExcel/Classes/PHPExcel/Reader/Excel2007.php");
require_once('../vo/voConn.php');
require_once("../oFunctions.php");

$arg = $_POST["data"];
$v = $_POST["v"];
$opt = intval($v);
parse_str($arg);
if (!isset($dependencia)){
	$dependencia=$iddep;
}
if (!isset($area)){
	$area=$idareadep;
}

$F = oFunctions::getInstance();
$Conn = voConn::getInstance();
$mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
mysql_select_db($Conn->db);
mysql_query("SET NAMES UTF8");

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(false);


switch($opt){
	case 0:
		$objPHPExcel = $objReader->load("templates/_rep-1.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
		$fileout= "--rep-1.xlsx";
		//$query = "Select count(idprodgpo) as sumid, idprodgpo,abrdep as grupo, grupo as dependencia from _viDemanda where (fecha between '$fi' and '$ff')  group by idprodgpo";
		$query = "Select count(s.idprodgpo) as sumid, s.idprodgpo,s.abrdep as grupo, s.grupo as dependencia, s.tel1, s.cel1, s.email,
    						(Select count(idprod) from _viDemanda  Where idprodgpo = s.idprodgpo and idstatus = 1 and (fecha between '$fi' and '$ff')  Group By idprodgpo) as tramite,  
    						(Select count(idprod) from _viDemanda  Where idprodgpo = s.idprodgpo and idstatus = 2 and (fecha between '$fi' and '$ff')  Group By idprodgpo) as atendidos,  
    						(Select count(idprod) from _viDemanda  Where idprodgpo = s.idprodgpo and idstatus = 3 and (fecha between '$fi' and '$ff')  Group By idprodgpo) as no_procede,  
    						(Select count(idprod) from _viDemanda  Where idprodgpo = s.idprodgpo and idstatus = 4 and (fecha between '$fi' and '$ff')  Group By idprodgpo) as otrasdep,  
    						(Select count(idprod) from _viDemanda  Where idprodgpo = s.idprodgpo and idstatus = 11 and (fecha between '$fi' and '$ff')  Group By idprodgpo) as verificado,  
    						(Select count(idprod) from _viDemanda  Where idprodgpo = s.idprodgpo and idstatus = 12 and (fecha between '$fi' and '$ff')  Group By idprodgpo) as resuelto  
				from _viDemanda s 
				where (s.fecha between '$fi' and '$ff') and s.idprod>0  group by s.idprodgpo";
		break;
	case 1:
		$objPHPExcel = $objReader->load("templates/_rep-3.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
		$fileout= "--rep-3.xlsx";
		switch($filterBlank){
			case 0:
				if (intval($dependencia)>0 && intval($area)>0){
		    			$query = "Select * from _viDemanda where iddependencia = $dependencia and idareadep = $area and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)>0 && intval($area)<=0){
		    				$query = "Select * from _viDemanda where iddependencia = $dependencia and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)<=0 && intval($area)>0){
		    				$query = "Select * from _viDemanda where idareadep = $area and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)<=0 && intval($area)<=0){
		    				$query = "Select * from _viDemanda where (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}
				break;
			case 1:
				if (intval($dependencia)>0 && intval($area)>0){
		    			$query = "Select * from _viDemanda where idprodgpo = $dependencia and idareadep = $area and idprod > 0 and idareadep > 0 and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)>0 && intval($area)<=0){
		    				$query = "Select * from _viDemanda where idprodgpo = $dependencia and idprod > 0 and idareadep > 0 and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)<=0 && intval($area)>0){
		    				$query = "Select * from _viDemanda where idareadep = $area and idprod > 0 and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)<=0 && intval($area)<=0){
		    				$query = "Select * from _viDemanda where idprodgpo > 0 and idprod > 0 and idareadep > 0 and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}
				break;
			case 2:
				if (intval($dependencia)>0 && intval($area)>0){
		    			$query = "Select * from _viDemanda where idprodgpo = $dependencia and idareadep = $area and idprod <= 0 and idareadep <= 0 and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)>0 && intval($area)<=0){
		    				$query = "Select * from _viDemanda where idprodgpo = $dependencia and (idprod <= 0 or idareadep <= 0) and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)<=0 && intval($area)>0){
		    				$query = "Select * from _viDemanda where idareadep = $area and idprod <= 0 and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}else if (intval($dependencia)<=0 && intval($area)<=0){
		    				$query = "Select * from _viDemanda where (idprodgpo <= 0 or idprod <= 0 or idareadep <= 0) and (fecha between '$fi' and '$ff') order by iddenuncia desc";
				}
				break;
		}
		break;
	case 2:
		$objPHPExcel = $objReader->load("templates/_rep-3.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
		$fileout= "--rep-3.xlsx";
		if (intval($dependencia)>0 && intval($status)>0){
		    $query = "Select * from _viDemanda where idprodgpo = $dependencia and idstatus = $status and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)>0 && intval($status)<=0){
		    $query = "Select * from _viDemanda where idprodgpo = $dependencia and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)<=0 && intval($status)>0){
		    $query = "Select * from _viDemanda where idstatus = $status and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)<=0 && intval($status)<=0){
		    $query = "Select * from _viDemanda where (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}
		break;
	case 3:
		$objPHPExcel = $objReader->load("templates/_rep-3.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
		$fileout= "--rep-3.xlsx";
		if (intval($dependencia)>0 && intval($origen)>0){
		    $query = "Select * from _viDemanda where idprodgpo = $dependencia and idorigen = $origen and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)>0 && intval($origen)<=0){
		    $query = "Select * from _viDemanda where idprodgpo = $dependencia and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)<=0 && intval($origen)>0){
		    $query = "Select * from _viDemanda where idorigen = $origen and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)<=0 && intval($origen)<=0){
		    $query = "Select * from _viDemanda where (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}
		break;
	case 4:
		$objPHPExcel = $objReader->load("templates/_rep-3.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
		$fileout= "--rep-3.xlsx";
		if (intval($dependencia)>0 && intval($prioridad)>0){
		    $query = "Select * from _viDemanda where idprodgpo = $dependencia and idprioridad = $prioridad and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)>0 && intval($prioridad)<=0){
		    $query = "Select * from _viDemanda where idprodgpo = $dependencia and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)<=0 && intval($prioridad)>0){
		    $query = "Select * from _viDemanda where idprioridad = $prioridad and (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}else if (intval($dependencia)<=0 && intval($prioridad)<=0){
		    $query = "Select * from _viDemanda where (fecha between '$fi' and '$ff') order by iddenuncia desc";
		}
		break;
	case 5:
		$objPHPExcel = $objReader->load("templates/cat-dep-prod-1.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
		$fileout= "cat-dep-prod-1.xlsx";
		if (intval($dependencia)>0){
			$query = "Select distinct idprod, producto, grupo, idprodgpo from _viProductos where idprodgpo = $dependencia order by producto asc";
		}else{
			$query = "Select distinct idprod, producto, grupo, idprodgpo from _viProductos order by grupo asc, producto asc";
		}
		break;
	case 6:
	
		if (intval($dependencia)>0){
			$objPHPExcel = $objReader->load("templates/_rep-4.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
			$fileout= "--rep-4.xlsx";
			$query = "Select  count(s.idprod) as cantidad,s.grupo,s.iddependencia, s.idareadep, s.areadep, s.producto, s.idprod, 
        						(Select count(idprod) from _viDemanda  Where iddependencia = $dependencia and idprod = s.idprod and idstatus = 1 and (fecha between '$fi' and '$ff')  Group By idprod) as tramite,  
        						(Select count(idprod) from _viDemanda  Where iddependencia = $dependencia and idprod = s.idprod and idstatus = 2 and (fecha between '$fi' and '$ff')  Group By idprod) as atendidos,  
       						(Select count(idprod) from _viDemanda  Where iddependencia = $dependencia and idprod = s.idprod and idstatus = 3 and (fecha between '$fi' and '$ff')  Group By idprod) as no_procede,  
       						(Select count(idprod) from _viDemanda  Where iddependencia = $dependencia and idprod = s.idprod and idstatus = 4 and (fecha between '$fi' and '$ff')  Group By idprod) as otrasdep,  
       						(Select count(idprod) from _viDemanda  Where iddependencia = $dependencia and idprod = s.idprod and idstatus = 11 and (fecha between '$fi' and '$ff')  Group By idprod) as verificado,  
       						(Select count(idprod) from _viDemanda  Where iddependencia = $dependencia and idprod = s.idprod and idstatus = 12 and (fecha between '$fi' and '$ff')  Group By idprod) as resuelto  
					from _viDemanda s 
					Where iddependencia = $dependencia and  (s.fecha between '$fi' and '$ff') and s.idprod>0 
					Group By idprod 
					Order by s.idareadep, cantidad desc";
		}else{
			$objPHPExcel = $objReader->load("templates/_rep-4.xlsx"); //cargamos el archivo excel (extensión *.xlsx)
			$fileout= "--rep-4b.xlsx";
			
			$query = "Select  count(s.idprod) as cantidad,s.grupo,s.iddependencia, s.idareadep, s.areadep, s.producto, s.idprod, 
        						(Select count(idprod) from _viDemanda  Where idprod = s.idprod and idstatus = 1 and (fecha between '$fi' and '$ff')  Group By idprod) as tramite,  
        						(Select count(idprod) from _viDemanda  Where idprod = s.idprod and idstatus = 2 and (fecha between '$fi' and '$ff')  Group By idprod) as atendidos,  
        						(Select count(idprod) from _viDemanda  Where idprod = s.idprod and idstatus = 3 and (fecha between '$fi' and '$ff')  Group By idprod) as no_procede,  
        						(Select count(idprod) from _viDemanda  Where idprod = s.idprod and idstatus = 4 and (fecha between '$fi' and '$ff')  Group By idprod) as otrasdep,  
        						(Select count(idprod) from _viDemanda  Where idprod = s.idprod and idstatus = 11 and (fecha between '$fi' and '$ff')  Group By idprod) as verificado,  
       						(Select count(idprod) from _viDemanda  Where idprod = s.idprod and idstatus = 12 and (fecha between '$fi' and '$ff')  Group By idprod) as resuelto  
					from _viDemanda s 
					Where  (s.fecha between '$fi' and '$ff') and s.idprod>0
					Group By idprod 
					Order by s.iddependencia, s.idareadep,cantidad desc";			
		}
		break;
			
}

$qrw = mysql_query($query);

if (mysql_fetch_row($qrw)>0){
	if ( in_array(intval($opt),array(1,2,3,4)) ){
		$areadep   = $area      == 0 ?"TODAS LAS ÁREAS":mysql_result($qrw, 0,"areadep");
		$status    = $status    == 0 ?"TODAS LOS STATUS":mysql_result($qrw, 0,"status");
		$origen    = $origen    == 0 ?"TODOS LOS MEDIOS":mysql_result($qrw, 0,"origen");
		$prioridad = $prioridad == 0 ? "":mysql_result($qrw, 0,"prioridad");
	}
	
	mysql_free_result($qrw);

	$result = mysql_query($query);

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //objeto de PHPExcel, para escribir en el excel
	$objWriter->setIncludeCharts(TRUE);
	include("rep2php.php");

	switch(intval($opt)){
		case 0:
			get_rep_1($objPHPExcel,$result,$fi, $ff,$F);
			break;
		case 1:
			get_rep_esp($objPHPExcel,$result,$fi, $ff,$F,$dependencia,$areadep);
			break;
		case 2:
			get_rep_esp($objPHPExcel,$result,$fi, $ff,$F,$dependencia,$status);
			break;
		case 3:
			get_rep_esp($objPHPExcel,$result,$fi, $ff,$F,$dependencia,$origen);
			break;
		case 4:
			get_rep_esp($objPHPExcel,$result,$fi, $ff,$F,$dependencia,$prioridad);
			break;
		case 5:
			cat_dep_prod_1($objPHPExcel,$result,$F,$dependencia);
			break;
		case 6:
			get_rep_esp2($objPHPExcel,$result,$fi, $ff,$F,$dependencia);
			break;
	}
            
	//$objWriter->save($fileout);//guardamos el archivo excel  
	$objWriter->save($fileout);//guardamos el archivo excel  

	switch($opt){
		case 0:
			include("-rep-1b.php");
			break;
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
			include("-rep-2.php");
			break;
	}

}else{
	include("-rep-empty-msg.php");
}


?>

</body>
</html>


