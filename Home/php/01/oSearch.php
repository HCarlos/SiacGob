<?php
require_once('vo/voConn.php');
require_once('vo/voSearch.php');

class oSearch {
	 
	 private static $instancia;
	 
	 private function __construct(){ }

	 public static function getInstance(){
				if (  !self::$instancia instanceof self){
					  self::$instancia = new self;
				}
				return self::$instancia;
	 }

     public function getData($index=0,$cad="", $obj="",$type=0){
		  $arr = array('voSearch');
		  $ret = array();
		  
		  switch($type){
			  case 0:
		  			$query = "select $obj as value, id".$obj." as id from _dom_".$obj." where $obj like ('%$cad%')";
			  		break;
			  case 1:
			          $var = explode("|",$obj);
		  			$query = "select $var[2] as value, $var[1] as id from $var[0] where $var[2] like ('%$cad%')";
			  		break;
			  case 2:
			          $var = explode("|",$obj);
		  			$query = "select $var[2] as value, $var[1] as id, p_venta from $var[0] where $var[2] like ('%$cad%')";
			  		break;
			  case 3:  // Decimal
					$obj = (get_magic_quotes_gpc()) ? stripslashes($obj) : $obj; 
					$var = explode("|",$obj);
		  			$query = "select $var[2] as value, $var[1] as id from $var[0] where $var[1] = $cad";
			  		break;
			  case 4:  // Decimal
					$obj = (get_magic_quotes_gpc()) ? stripslashes($obj) : $obj; 
					$var = explode("|",$obj);
					if (intval($var[4])==20){
		  				$query = "select $var[2] as value, $var[1] as id from $var[0] ";
					}else{
		  				$query = "select $var[2] as value, $var[1] as id from $var[0] group by iddependencia HAVING iddependencia = $var[4]";
					}
			  		break;
			  case 5:  // Decimal
					$obj = (get_magic_quotes_gpc()) ? stripslashes($obj) : $obj; 
					$var = explode("|",$obj);
					if (intval($var[4])==20){
		  				$query = "select $var[2] as value, $var[1] as id from $var[0] ";
					}else{
		  				$query = "select count(idprod) as value, idprodgpo as id from productos group by idprodgpo HAVING idprodgpo = $var[4]";
					}
			  		break;
			  case 6:  // Decimal
					$obj = (get_magic_quotes_gpc()) ? stripslashes($obj) : $obj; 
					$var = explode("|",$obj);
					if (intval($var[4])==20){
		  				$query = "select $var[2] as value, $var[1] as id from $var[0] ";
					}else{
		  				$query = "select count(idprod) as value, idprodgpo as id from productos group by idprodgpo HAVING idprodgpo = $var[4]";
					}
			  		break;
		  }

		  
		  $Conn = voConn::getInstance();
		   
		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  
		  mysql_select_db($Conn->db);
		  mysql_query("SET NAMES UTF8");
		  
		  $result = mysql_query($query);
		  
		  while ($obj = mysql_fetch_object($result, $arr[0])) {
			   	 $ret[] = $obj;
		  }
		  
	       mysql_close($mysql);
		 
		  return  $ret;
	}



 }  


?>