<?php
class voConn
{
	
		private static $instancia;
		public static $server;
		public static $user;
		public static $pass;
		public static $db;

		// Localmente
		/*
		private function __construct(){ 
			   $this->server = "localhost:3306";
			   $this->user = "root";
			   $this->pass = "root";//"LbeiEG7cZmSP";
			   // LbeiEG7cZmSP
			   $this->db = "dbG2";
		}
		*/

		// Remote
		
/*		private function __construct(){ 
			   $this->server = "localhost:3306";
			   $this->user = "diariop_root";
			   $this->pass = "IofcOqTT5oIE";//"LbeiEG7cZmSP";
			   // LbeiEG7cZmSP
			   $this->db = "diariop_dbG2";
		}
*/	     

		private function __construct(){ 
			   $this->server = "localhost:3306";
			   $this->user = "tabascow_userdc";
			   $this->pass = "2VRVpXkw6Ezc";//"LbeiEG7cZmSP";
			   // LbeiEG7cZmSP    ---
			   $this->db = "tabascow_dcdb";
		}


	     public static function getInstance(){
				    if (  !self::$instancia instanceof self){
					    self::$instancia = new self;
				     }
					return self::$instancia;
	     }
   
}

?>