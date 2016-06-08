<?php

require_once('vo/voConn.php');
//require_once('vo/voUser.php');
require_once('vo/voCombo.php');

class saveData {
	 
	 private static $instancia;
	 
	 private function __construct(){  }

	 public static function getInstance(){
				if (  !self::$instancia instanceof self){
					  self::$instancia = new self;
				}
				return self::$instancia;
	 }
	 

	public function setUser($ar,$tipo=0){
		  
		  $val = $ar;
		  
		  $vRet = "";
		  $Conn = voConn::getInstance();
		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  mysql_select_db($Conn->db);
		  
            switch ($tipo) {
			     case 0:
				      $pass = md5($ar[1]);
				      $query="Insert Into usuarios(username,password)Values('$ar[0]','$pass')";
					 
			           $result = mysql_query($query);
					 $vRet = $result!=1?"Error":$pass.'|'.$ar[0].'|'.$ar[1];													   
					 break;
		  }
		  mysql_close($mysql);
	       return $vRet;
		   
	}
 }  


?>
