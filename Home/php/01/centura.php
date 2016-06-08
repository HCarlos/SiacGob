<?php
require_once('vo/voConn.php');
require_once('vo/voCombo.php');
require_once('vo/voMxM.php');
require_once('vo/voNotaBody.php');
require_once('vo/voImages.php');
require_once('vo/voMedia.php');
require_once('vo/voNotaRel.php');
require_once('vo/voGI.php');
require_once('vo/voNotaSec.php');
require_once('vo/voNotaGraph.php');
require_once('vo/voNotaEncuesta.php');
require_once('vo/voComment.php');
require_once('vo/voGIDet.php');
require_once('vo/voColumnBody.php');
require_once('vo/voNotaImg.php');
require_once('vo/voDigitales.php');
require_once('vo/voDenuncia.php');
require_once('vo/voCobPub.php');
require_once('vo/voColumnExtend.php');
require_once('vo/voARO.php');
require_once('vo/voCobertura.php');
require_once('vo/voNBComplete.php');
require_once('vo/voEncDet.php');
require_once('vo/voMicrositios.php');
require_once('vo/voGrafico.php');
require_once('vo/voUser.php');
require_once('vo/voOD.php');

class oUltra {
	 
	 private static $instancia;
	 public $IdUser;
	 public $User;
	 public $Pass;
	 public $Nav;
	 public $URL;
	 public $defaultMail;
	 public $CID;
	 public $Mail;
	 public $Foto;
	 
	 private function __construct(){ 
	 		$this->Nav      = "Ninguno";
			$this->IdUser    = 0;
			$this->User     = "";
			$this->Pass     = "";
	 		$this->URL      = "http://www.diariopresente.com.mx/";
	 		$this->defaultMail = "gpmedicionweb@gmail.com";
	 		//$this->URL = "http://localhost/";
			$this->IsCookie();
	 }
	 
	 public function IsCookie(){
		   if (isset($_COOKIE['__chLib32'])){
				$x = explode('.',$_COOKIE['__chLib32']);
				$this->User = $x[0];
				$this->Pass = $x[1];
				$this->IdUser = (int)$x[2];
				$this->CID = (int)$x[3];
				$this->Mail = (int)$x[4];
				$this->Foto = (int)$x[5];
				return true;
		   }else{
			   return false;
		   }
	 }
	 
	 private function getStrQryTitulo($arg="",$field="") {
		  	$strIN="";
			
			try {
				
			$strIN=" ".$field." like '%".$arg."%' " ;
			
	 } catch (Exception $e) {
    				echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		  	}
			
		  	return $strIN;
	 }

	 public static function getInstance(){
				if (  !self::$instancia instanceof self){
					  self::$instancia = new self;
				}
				return self::$instancia;
	 }
	 
	public function getMxM($tipo=0,$cantidad=0,$type=0,$nStart=0) {
		  $arr = array('voMxM','voMxM','voMxM','voMxM','voMedia');
		  $index = 0;
		  $ret = array();
		  
		  try {

            switch ($tipo){
			    case 0:
			          switch($type){
						  case 0:
								$query = "SELECT n.idnota,n.titulo,n.fecha,n.hora,s.Desc_Sec as seccion 
										FROM noticias n, secciones s 
										Where n.idsec = s.idsec order by n.idnota desc limit $cantidad";
								break;
						  case 1:
								$query = "SELECT idgig as idnota,titulo,fecha,'00:00' as hora, titulo_corto as seccion 
										FROM galeria_definicion order by idgig desc limit $cantidad";
								break;
						  case 2:
								$query = "SELECT idcolumna as idnota,titulo_tema as titulo, fecha,'00:00' as hora,titulo_columna as seccion 
										FROM columnas
										ORDER BY idcolumna desc limit $cantidad";
								break;
					}
					break;
			    case 1:
			          switch($type){
						  case 0:
								$query = "SELECT n.idnota, n.titulo, n.fecha, n.hora, s.Desc_Sec as seccion, nl.count as leidas
										FROM leidas nl, noticias n, secciones s
										WHERE nl.tipo = 1 and 
										      nl.id = n.idnota AND 
											 n.idsec = s.idsec And
											(n.fecha BETWEEN (CURDATE() - INTERVAL 3 DAY) AND CURDATE())  
										ORDER BY nl.count DESC, 
												n.idnota DESC 
										LIMIT $cantidad ";
								break;
						  case 2:
								$query = "SELECT c.idcolumna as idnota, c.titulo_tema as titulo, c.fecha,'00:00' as hora,c.titulo_columna as seccion, nl.count as leidas 
										FROM leidas nl, columnas c
										WHERE nl.tipo = 2 and 
											 nl.id = c.idcolumna And 
											(c.fecha BETWEEN (CURDATE() - INTERVAL 3 DAY) AND CURDATE())  
										ORDER BY nl.count DESC, 
												c.idcolumna DESC 
										LIMIT $cantidad ";
								break;
						  case 10:
								$query = "SELECT gi.idgig as idnota, gi.titulo as titulo, gi.fecha,'00:00' as hora,gi.titulo_corto as seccion, nl.count as leidas 
										FROM leidas nl, galeria_definicion gi
										WHERE nl.tipo = 10 and 
											 nl.id = gi.idgig And 
											(gi.fecha BETWEEN (CURDATE() - INTERVAL 5 DAY) AND CURDATE())   
										ORDER BY nl.count DESC, 
											    gi.idgig DESC 
										LIMIT $cantidad ";
								break;
								
						  case 20:
								$query = "SELECT v.idmedia as idnota, v.titulom as titulo, v.fecha,'00:00' as hora,'Videos' as seccion, nl.count as leidas 
										FROM leidas nl, multimedia v
										WHERE nl.tipo = 20 and 
											 nl.id = v.idmedia And 
											(v.fecha BETWEEN (CURDATE() - INTERVAL 5 DAY) AND CURDATE())   
										ORDER BY nl.count DESC, 
											    v.idmedia DESC 
										LIMIT $cantidad ";
								break;
					}
					break;
			    case 2:
			          switch($type){
						  case 0:
								$query = "SELECT n.idnota,n.titulo,n.fecha,n.hora, s.Desc_Sec as seccion, c.count as comentadas
									FROM comentadas c, noticias n, secciones s 
									WHERE c.tipo = 1 and 
										 c.id = n.idnota AND 
										 n.idsec = s.idsec And 
										(n.fecha BETWEEN (CURDATE() - INTERVAL 5 DAY) AND CURDATE())  
									ORDER BY c.count desc, 
										    n.idnota desc
									LIMIT $cantidad";
								break;
						  case 2:
								$query = "SELECT c.idcolumna as idnota, c.titulo_tema as titulo, c.fecha,'00:00' as hora,c.titulo_columna as seccion, mc.count as comentadas
									FROM comentadas mc, columnas c
									WHERE mc.tipo = 2 and 
										 mc.id = c.idcolumna And 
										(c.fecha BETWEEN (CURDATE() - INTERVAL 10 DAY) AND CURDATE())  
									ORDER BY mc.count desc, 
										    c.idcolumna desc
									LIMIT $cantidad";
								break;
					}
					break;
			    case 3:
			          switch($type){
						  case 0:
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,s.Desc_Sec as seccion, s.idsec
										FROM noticias n, secciones s
										where n.ubipub = 1 and n.habilitada = 1 and n.idsec = s.idsec order by n.ispermanent desc, n.idnota desc limit $cantidad";
								break;
					}
					break;
			    case 4:
			          switch($type){
						  case 0:
								$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1
						 				FROM multimedia where habilitado = 1 order by idmedia desc limit $nStart, $cantidad";
								break;
					}
					break;
		  }
		  $Conn = voConn::getInstance();
		   
		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  
		  mysql_select_db($Conn->db);
		  mysql_query("SET NAMES UTF8");
		  
		  $result = mysql_query($query);
		  while ($obj = mysql_fetch_object($result, $arr[$tipo])) {
			   $ret[] = $obj;
		  }
		  mysql_free_result($result);
	       mysql_close($mysql);
		  
		  } catch (Exception $e) {
    			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		  }
		  
		  return  $ret;
	}

     public function getNota($idnota=0,$tipo=0,$cad=""){
		  $arr = array('voNotaBody','voNotaBody','voNotaBody','voMedia','voColumnBody','voARO',
		  			'voNotaBody','voNotaBody','voMedia','voNBComplete','voNBComplete',
					'voNBComplete','voDenuncia','voNBComplete');
		  $id = $idnota;
		  $index = 0;
		  
		  $ret = array();
		  
		  try{
		 
            switch ($tipo){
			    case 1:
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb 								  
						     FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where n.idnota = $idnota";
					$index = 0;				   
					break;
			    case 10:
		               $query = "SELECT titulo,titulo_corto as intronota, idgig as idnota 
							FROM galeria_definicion where idgig = $idnota and habilitado = 1 order by idgig desc";
					$index = 1;			   
					break;
			    case 11:
		               $query = "SELECT caption as titulo, caption as intronota, idgid as idnota 
							FROM galeria_coleccion where idgid = $idnota order by idgid desc";
					$index = 2;			   
					break;
			    case 20:
			    		$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1 
							FROM multimedia where idmedia = $id order by idmedia";
					$index = 3;
					break;
			    case 2:
			          $query = "SELECT c.idcolumna, c.nombrec_columnista, c.titulo_columna, c.breve_desc_columna, c.titulo_tema, c.contenido_columna,
								    c.imagen_columnista, c.fecha, r.foto, c.idaro, c.idreportero
							FROM columnas c, reporteros r 
							Where c.idcolumna = $id and c.habilitada = 1 and c.idreportero = r.idreportero and r.tipo = 1 ";
			    		$index = 4;
					break;
			    case 3:
			          $hoy = date("Y-m-d",time());
					$d = explode("-",$hoy); 
					$ano = $d[0];
					$mes = $d[1];
					$dia = $d[2];

			          $query = "Select r.idreportero, aro.idaro, c.idaro as idaroexist 
							From reporteros r left join asocia_rep_object aro on r.idreportero = aro.idreportero 
										   left join columnas c on aro.idreportero = c.idreportero and c.fecha = '$ano-$mes-$dia'
							Where r.habilitado = 1 and r.tipo = 1 order by idaroexist desc";
			    		$index = 5;
					break;
			    case 1001:
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb 								  
						     FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where n.idgrupo = $idnota order by idnota desc";
					$index = 6;				   
					break;
			    case 1002:
		               $query = "SELECT titulo,titulo_corto as intronota, idgig as idnota 
							FROM galeria_definicion where idcob = $idnota and habilitado = 1 order by idgig desc";
					$index = 7;			   
					break;
			    case  1003:
			    		$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1 
							FROM multimedia where idcob = $id order by idmedia desc";
					$index = 8;
					break;
			    case  1004:
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb,i.img1 as iphone, i.img4 as ipad, i.img2 as sldr,
								  IFNULL(i.img3,'core/fondoVacioThumb.png') as especial 								  
						     FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where n.idgrupo = $idnota and n.habilitada = 1 order by idnota desc";
					$index = 9;				   
					break;
			    case  1005:
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb,i.img1 as iphone, i.img4 as ipad, 
								  IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr, IFNULL(i.img3,'core/fondoVacioThumb.png') as especial																	    							FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where n.idgrupo = $idnota and i.img2 <> '' and n.habilitada = 1  order by idnota desc";
					$index = 10;				   
					break;
			    case  1006:
			          $ar = explode(".",$cad);
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb,i.img1 as iphone, i.img4 as ipad, 
								  IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr, IFNULL(i.img3,'core/fondoVacioThumb.png') as especial																	    							FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where n.idgrupo = $idnota and i.img1 <> '' and n.habilitada = 1  order by idnota desc";
					$index = 11;				   
					break;
			    case  50:
		               $query = "SELECT iddenuncia,id,tipo,usuario_den,mail_den,titulo_den,denuncia,iduser_ext,fecha,hora,isvalid
					FROM denuncias Where iddenuncia =  $idnota and isvalid = 1 order by iddenuncia desc limit 1";
					$index = 12;				   
					break;
			    	
			    case  1007:
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb,
								  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, 
								  IFNULL(i.img4,'core/fondoVacioThumb.png') as ipad, 
								  IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr, IFNULL(i.img3,'core/fondoVacioThumb.png') as especial																	    							FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where n.idgrupo = $idnota and i.img1 <> '' and n.tags like('%$cad%') and n.habilitada = 1  order by idnota desc limit 5";
					$index = 13;				   
					break;
		  }
		  
		  $Conn = voConn::getInstance();
		   
		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  
		  mysql_select_db($Conn->db);
		  mysql_query("SET NAMES UTF8");
		  
		  $result = mysql_query($query);
		  
		  while ($obj = mysql_fetch_object($result, $arr[$index])) {
			   $ret[] = $obj;
		  }
		  
		  //mysql_free_result($result);
		  if (in_array($tipo, array(1,2,10,11,20,50)) ){
		  	$result = mysql_query("SELECT id from leidas where id = $idnota and tipo = $tipo");
		  	if (mysql_num_rows($result) == 0) {
				$result = mysql_query("INSERT INTO leidas (id,count,tipo)values($idnota,1,$tipo)");
	       	} else {
				  $result = mysql_query("update leidas set count = count+1 where id = $idnota and tipo = $tipo");
		  	}
		  }
		  
		  //mysql_free_result($result);
	       mysql_close($mysql);
		  
		  } catch (Exception $e) {
    			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		  }
		  
		  return  $ret;
	}

     public function getObjByNews($idnota=0,$tipo=0,$type=0,$cad="",$nStart=0, $fecha="0000-00-00"){
		  $arr = array('voImages','voMedia','voNotaRel','voGI','voNotaSec','voNotaGraph','voNotaEncuesta','voComment',
					'voGIDet','voNotaRel','voMedia','voColumnBody','voNotaImg','voDigitales','voColumnBody','voDenuncia',
					'voCobertura','voCobPub','voColumnExtend','voCobPub','voImages','voEncDet','voMicrositios','voUser',
					'voCobertura','voCobertura','voGrafico','voOD');
					
		  $ret = array();
		  $Id = $idnota;
		  
		  try {

            switch ($tipo){
			    case 0:
		               $query = "SELECT idimg,idpub,idsec,idnota,IFNULL(root,'core/fondoVacioThumb.png') as root, 
								  IFNULL(root_thumb,'core/fondoVacioThumb.png') as root_thumb,alt,comentario
						     FROM images where idnota = $idnota order by idimg";
					break;
			    case 1:
			          switch($type){
						case 0:
							$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1
									FROM multimedia where idnota = $idnota order by idmedia";
							break;	
						case 1:
							$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1
									FROM multimedia where nombrecontenedor = 'opress1' order by idmedia desc limit 1";
							break;	
						case 2:
							$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota, codigo1
									  FROM multimedia 
									  Where idcob = $idnota and habilitado = 1 order by idmedia desc";
							break;	
						case 3:
							$ar = explode('-',$cad);
							$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1
									FROM multimedia 
									WHERE fecha = '$ar[0]-$ar[1]-$ar[2]' and habilitado = 1 order by idmedia ";
							break;	
						case 4:
							$ar = explode('-',$cad);
							$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota,codigo1
									FROM multimedia where habilitado = 1 order by idmedia desc limit $ar[0], $ar[1]";
							break;	
		  			}
					break;
			    case 2:
		               $query = "SELECT n.idnota,n.titulo,n.fecha,n.hora,g.idcobertura as idgrupo,g.nombre_cobertura as nombregn, 
					s.Desc_Sec as seccion, s.idsec, nr.tipo2
							FROM notasrelacionadas nr, noticias n, coberturas g, secciones s 
							WHERE nr.idnota = $idnota and 
								 nr.idnotarel = n.idnota and n.idgrupo = g.idcobertura and n.idsec = s.idsec order by idnotarel desc";
					break;
			    case 3:
			          switch ($type) {
						case 0:
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									where idnota = $idnota and  habilitado = 1 ";
							break;
						case 77:
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									Where habilitado = 1 order by idgig desc limit  $nStart, $idnota";
							break;
						case 66:
							$ar = explode('-',$cad);
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									Where fecha = '$ar[0]-$ar[1]-$ar[2]' and habilitado = 1 order by idgig asc ";
							break;
						case 10:
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									Where idgig = $idnota and habilitado = 1";
							break;
						case 11:
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									Where idgig = $idnota";
							break;
						case 88:
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto 
									FROM galeria_definicion 
									Where idcob = $idnota and habilitado = 1 order by idgig desc";
							break;
						case 100:
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									Where idgig = $idnota";
							break;
						case 101:
							$ar = explode('-',$cad);
		               		$query = "SELECT IdGIG as idgig, titulo, guia, directorio, image, titulo_corto FROM galeria_definicion 
									Where habilitado = 1 order by IdGIG desc limit $ar[0], $ar[1]";
							break;
					}
					break;
			    case 4:
		               $query = "SELECT idnota,titulo,fecha,hora
							FROM noticias 
							WHERE idsec = $idnota order by idnota desc limit 5";
					break;
			    case 5:
		               $query = "SELECT idgraf, titulo,main,width,height
						     FROM graficos where idnota = $idnota order by idgraf desc ";
					break;
			    case 6:
		               $query = "SELECT idencuesta,descripcion
						     FROM enc_encab where idnota = $idnota and habilitado = 1 order by idencuesta desc ";
					break;
			    case 7:
		               $query = "SELECT idcomment,usuario,comment,fecha,hora FROM comentarios where id = $idnota and isvalid = 1 and tipo = $type order by idcomment desc";
					break;
			    case 8:
		               $query = "SELECT gc.idgid,gc.image,gc.caption,gc.href,gc.thumbnails,gd.directorio,gd.titulo,gd.titulo_corto,gd.idnota
						     FROM galeria_coleccion gc, galeria_definicion gd where gd.idgig = $Id and gd.idgig = gc.idgig ";
					break;
			    case 9:
						if($type==0){
							$type=1;
						}
						$query = "SELECT nr.idnota,CASE nr.tipo2
							WHEN  1 THEN n.titulo
							WHEN  2 THEN c.titulo_columna
							WHEN 11 THEN gi.titulo
							WHEN 20 THEN m.titulom
							WHEN 25 THEN ms.titulo
							ELSE 'desconocido'
							END
							  AS titulo,
						CASE nr.tipo2
							WHEN  1 THEN n.fecha
							WHEN  2 THEN c.fecha
							WHEN 11 THEN c.fecha
							WHEN 20 THEN m.fecha
							WHEN 25 THEN ms.creado_el
							ELSE 'desconocido'
							END
							  AS fecha,	
						CASE nr.tipo2
							WHEN  1 THEN n.hora
							WHEN  2 THEN '00:00'
							WHEN 11 THEN '00:00'
							WHEN 20 THEN '00:00'
							WHEN 25 THEN '00:00'
							ELSE 'desconocido'
							END
							  AS hora,
							   0 as idgrupo,
							   '' as nombregn,
						CASE nr.tipo2
							WHEN  1 THEN n.Desc_Sec
							WHEN  2 THEN ''
							WHEN 11 THEN ''
							WHEN 20 THEN ''
							WHEN 25 THEN ''
							ELSE 'desconocido'
							END
							  AS seccion,	
						CASE nr.tipo2
							WHEN  1 THEN n.idsec
							WHEN  2 THEN 0
							WHEN 11 THEN 0
							WHEN 20 THEN 0
							WHEN 25 THEN 0
							ELSE 0
							END
							  AS idsec,nr.tipo2,nr.idnotarel 
						FROM notasrelacionadas nr
						LEFT JOIN noti_sec n ON nr.idnotarel = n.idnota 
						LEFT JOIN columnas c ON nr.idnotarel = c.idcolumna
						LEFT JOIN galeria_definicion gi ON nr.idnotarel = gi.idgig
						LEFT JOIN multimedia m ON nr.idnotarel = m.idmedia
						LEFT JOIN micrositios ms ON nr.idnotarel = ms.idms
						WHERE nr.idnota = $idnota and nr.tipo1 = $type 
						ORDER BY tipo2 asc, nr.idnotarel DESC 
						LIMIT 150";
					break;
			    case 10:
		               $query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota, codigo1
						 	FROM multimedia where idmedia = $Id order by idmedia";
					break;
			    case 11:
		               $query = "SELECT c.idcolumna, c.nombrec_columnista, c.titulo_columna, c.titulo_tema, c.imagen_columnista, c.fecha, r.foto, c.idaro, c.idreportero
							FROM columnas c, reporteros r 
							Where c.idaro = $Id and c.habilitada = 1 and c.idreportero = r.idreportero and r.tipo = 1 order by idcolumna desc limit  $nStart, $type ";
					break;
			    case 12:
			          switch($Id){
						  case 0:
						          
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,ifnull(i.root,'core/fondoVacioThumb.png') as image, s.Desc_Sec as seccion, 
											  s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										Where n.ubipub = 1 and n.habilitada = 1  order by n.ispermanent desc, n.idnota desc Limit $type";
								break;
						  case 33:
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, s.Desc_Sec as seccion
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.habilitada = 1 Order By n.idnota desc Limit $type";
								break;
						  case 44:
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, 
											  s.Desc_Sec as seccion,l.count as leidas
										FROM leidas l left Join noticias n on l.id = n.idnota and l.tipo = 1 left Join secciones s 
											On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.habilitada = 1 and (n.fecha BETWEEN (CURDATE() - INTERVAL 5 DAY) AND CURDATE())  Order By leidas desc Limit $type";
								break;
						  case 22:
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, 
											  s.Desc_Sec as seccion,c.count as comentadas
										FROM comentadas c left Join noticias n on c.id = n.idnota and c.tipo = 1 left Join secciones s 
											On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.habilitada = 1 and (n.fecha BETWEEN (CURDATE() - INTERVAL 5 DAY) AND CURDATE())  Order By comentadas desc Limit $type";
								break;
						  case 55:
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, 
									            s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.isfotonota = 1 and n.habilitada = 1 Order By n.idnota desc Limit  $nStart, $type";
								break;		
						  case 66:
						          $ar = explode('.',$cad);
								//and n.isfotonota != 1
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, s.Desc_Sec as seccion, 
									            s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.idsec = $type and n.habilitada = 1 and n.ispermanent != 1 Order By n.idnota desc Limit $ar[0], $ar[1]";
								break;
							case 77: 
								$ar = explode('-',$cad);
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,ifnull(i.root,'core/fondoVacioThumb.png') as image, s.Desc_Sec as seccion, 
											  s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										Where n.fecha = '$ar[0]-$ar[1]-$ar[2]' and s.idsec = $ar[3] and n.habilitada = 1 order by n.ispermanent desc, n.idnota asc";
								break;
						    case 88:
								$ar = explode('-',$cad);
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,ifnull(i.root,'core/fondoVacioThumb.png') as image, s.Desc_Sec as seccion, 
											  s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										Where n.idsec = $type and n.habilitada = 1  order by n.idnota desc Limit $ar[0], $ar[1]";
								break;
	
						  case 99:
						          $ar = explode('.',$cad);
								//where n.idsec = $type and n.habilitada = 1 and (n.ispermanent = 1) Order By n.idnota desc Limit $ar[0], $ar[1]";
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, s.Desc_Sec as seccion, 
									            s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.habilitada = 1 and (n.ispermanent = 1) Order By n.idnota desc Limit $ar[0], $ar[1]";
								break;
						  default:
								$query = "SELECT n.idnota,n.titulo,n.intronota,n.fecha,n.hora,IFNULL(i.root,'core/fondoVacioThumb.png')  as image, s.Desc_Sec as seccion, 
									            s.Desc_Sec as seccion, IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb, IFNULL(i.img2,'core/fondoVacioThumb.png') as sldr,
											  IFNULL(i.img1,'core/fondoVacioThumb.png') as iphone, IFNULL(i.img3,'core/fondoVacioThumb.png') as ipad,
											  IFNULL(i.img4,'core/fondoVacioThumb.png') as img4
										FROM noticias n left Join secciones s On n.idsec = s.idsec Left Join images i On i.idnota = n.idnota
										where n.idsec = $Id and n.habilitada = 1 Order By n.idnota desc Limit $nStart, $type";
								break;
					}
					break;
			    case 13:
			          switch ($type){
						   case 1:
		      			          $query = "SELECT titulo, url, main, thumb from digitales Where fecha = '$fecha' and isedimp = 0 order by iddig desc";
						   		break;
						   default:
		      			          $query = "SELECT titulo, url, main, thumb from digitales Where isedimp = 1 and habilitado = 1 order by iddig desc limit 1";
						   		break;
					}
					break;
			    case 14:
		               
			          switch($nStart){
						case 1:
							$ar = explode('-',$cad);
							$query = "SELECT idcolumna,nombrec_columnista,titulo_columna,titulo_tema,imagen_columnista,fecha,idaro,idreportero 
							 		FROM columnas Where habilitada = 1 and fecha = '$ar[0]-$ar[1]-$ar[2]'  order by idcolumna asc";
							break;
						default:
							$query = "SELECT idcolumna,nombrec_columnista,titulo_columna,titulo_tema,imagen_columnista,fecha,idaro,idreportero 
							 		FROM columnas Where habilitada = 1 order by idcolumna desc limit $type";
							break;
					}
					break;
			    case 15:
			          switch($nStart){
						case 0:
		               		$query = "SELECT iddenuncia,id,tipo,usuario_den,mail_den,titulo_den,denuncia,iduser_ext,fecha,hora,isvalid
							FROM denuncias Where isvalid = 1 order by iddenuncia desc limit $type";
							break;
						case 1:
		               		$query = "SELECT iddenuncia,id,tipo,usuario_den,mail_den,titulo_den,denuncia,iduser_ext,fecha,hora,isvalid
							FROM denuncias Where iddenuncia =  $Id and isvalid = 1 order by iddenuncia desc limit 1";
							break;
						case 2:
		               		$query = "SELECT iddenuncia,id,tipo,usuario_den,mail_den,titulo_den,denuncia,iduser_ext,fecha,hora,isvalid
							FROM denuncias Where isvalid = 1 and iddenuncia != $Id order by iddenuncia desc limit $type";
							break;
						case 3:
		               		$query = "SELECT iddenuncia,id,tipo,usuario_den,mail_den,titulo_den,denuncia,iduser_ext,fecha,hora,isvalid
							FROM denuncias Where isvalid = 1 order by iddenuncia desc limit $type,10";
							break;
					}
					break;
			    case 16:
		               $query = "SELECT idcobertura,nombre_cobertura,codigo,habilitado,orden,tipo 
							FROM coberturas 
							WHERE orden = $Id and tipo = $nStart and habilitado = 1 order by idcobertura asc limit $type";
					break;		
			    case 17:
		               $query = "SELECT codigo,ref
							FROM publicidad 
							WHERE ref = $Id and habilitado = 1 order by orden asc, orden asc limit $type";
					break;
			    case 18:
		               $query = "SELECT c.idcolumna, c.nombrec_columnista, c.titulo_columna, c.titulo_tema, c.imagen_columnista, c.fecha, r.foto, c.idaro, c.idreportero
							 FROM columnas c, reporteros r 
							 Where c.idcolumna = $Id and c.habilitada = 1 and c.idreportero = r.idreportero and r.tipo = 1 order by c.idcolumna desc ";
					break;
			    case 19:
			          // Igual que la 17 pero prosonalizable
		               $query = "SELECT codigo,ref
							FROM publicidad 
							WHERE ref = $Id and habilitado = 1 order by orden asc, orden asc limit 1";
					break;
					
			    case 20:
		               $query = "SELECT idimg,idpub,idsec,idnota,IFNULL(root,'core/fondoVacioThumb.png') as root, 
								  IFNULL(root_thumb,'core/fondoVacioThumb.png') as root_thumb,
								  IFNULL(img1,'core/fondoVacioThumb.png') as iphone,
								  IFNULL(img4,'core/fondoVacioThumb.png') as ipad,
								  IFNULL(img2,'core/fondoVacioThumb.png') as sldr,
								  IFNULL(img3,'core/fondoVacioThumb.png') as especial,
								  alt,comentario
						     FROM images where idimg = $idnota order by idimg";
					break;
			    case 21:
			    		$query = "SELECT idencdet,idenc,descripcion,votos,banner 
							FROM enc_detalle 
							WHERE idenc = $idnota order by votos desc limit 3";
					break;
			    case 22:
			          switch($Id){
						case 0:
					    		$query = "SELECT idms,titulo,sumario,url,image_main,image_thumb,habilitado,parametros,tipo,tags
									FROM micrositios 
									WHERE habilitado = $nStart and tipo = $type order by idms desc limit 1";
							break;
						case -1:
					    		$query = "SELECT idms,titulo,sumario,url,image_main,image_thumb,habilitado,parametros,tipo,tags
									FROM micrositios 
									WHERE idms = $type order by idms desc";
							break;
						case -2:
					    		$query = "SELECT idms,titulo,sumario,url,image_main,image_thumb,habilitado,parametros,tipo,tags
									FROM micrositios 
									WHERE idcob = $type order by idms desc";
							break;
						case 1:
					    		$query = "SELECT idms,titulo,sumario,url,image_main,image_thumb,habilitado,parametros,tipo,tags
									FROM micrositios 
									WHERE tipo = $type order by idms desc ";
							break;
						case 2:
						     $ar = explode('.',$cad);
					    		$query = "SELECT idms,titulo,sumario,url,
										  IFNULL(image_main,'core/fondoVacioThumb.png') as image_main,
										  IFNULL(image_thumb,'core/fondoVacioThumb.png') as image_thumb,
										  habilitado,parametros,tipo,tags
									FROM micrositios 
									WHERE tipo = $type order by idms desc limit $ar[0], $ar[1] ";
							break;
						default:
					    		$query = "SELECT idms,titulo,sumario,url,image_main,image_thumb,habilitado,parametros,tipo,tags
									FROM micrositios 
									WHERE idms = $Id and habilitado = $nStart and tipo = $type order by idms desc limit 1";
							break;
					}
					break;
			   case 23:
					$query="select iduser,alias,password,mail,nombres,apellidos,domicilio,
					 			fecha_nac,fecha_alta, fecha_mod, twitter, facebook,webpage,quien_eres,firma,genero,
								validado, recibir_mail, suscriptor, cid, foto, foto_thumb, teldom, telcel, profesion, 
								escuela, carrera, grado, fromApp, otro  
						   from users 
						   where iduser = $idnota and validado = 1 limit 1";	
					break;	   		   	
			    case 24:
		               $query = "SELECT idcobertura,nombre_cobertura,codigo,habilitado,orden,tipo 
							FROM coberturas 
							WHERE idcobertura = $Id order by orden asc limit 1";
					break;		
			    case 25:
		               $query = "SELECT idcobertura,nombre_cobertura,codigo,habilitado,orden,tipo 
							FROM coberturas 
							WHERE habilitado = 1 and tipo = $type order by idcobertura desc limit $nStart, $idnota";
					break;		
			    case 26:
			          switch($type){
							default:
		               			$query = "SELECT idgraf, main, thumb, pie, titulo, width, height, idnota, habilitado, idcob, codigo1
						     			FROM graficos where idgraf = $Id ";
								break;
					}
			    case 27:
			          switch($type){
							default:
		               			$query = "SELECT idmarcador, campo1, campo2, campo3, campo4, campo5, campo6, campo7, campo8, campo9
						     			FROM marcador where idmarcador = $Id ";
								break;
					}
		  }
		  
		  
		  $Conn = voConn::getInstance();

		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  
		  mysql_select_db($Conn->db);
		  mysql_query("SET NAMES UTF8");
		  
		  $result = mysql_query($query);
		  while ($obj = mysql_fetch_object($result, $arr[$tipo])) {
				   $ret[] = $obj;
	       }
		  mysql_free_result($result);
	       mysql_close($mysql);
		  
		  } catch (Exception $e) {
    			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		  }
		  
		  return  $ret;
	}
	
	public function getStatNote($idnota=0,$tipo=0,$type=0,$cad=""){
		  $res=0;
		  
		  try {
			  
            switch ($tipo){
			    case 0:
					$query = "SELECT count as res FROM leidas WHERE id = $idnota and tipo = $type ";
				     break;
			    case 1:
		               $query = "SELECT count as res FROM comentadas WHERE id = $idnota and tipo = $type ";
					break;
			    case 25:
		               $query = "SELECT count(idms) as res FROM micrositios where idms = $idnota";
					break;
			    case 77:
		               $query = "SELECT count(idmedia) as res FROM multimedia where idmedia = $idnota";
					break;
			    case 99:
		               $query = "SELECT count(IdGIG) as res FROM galeria_coleccion where IdGIG = $idnota";
					break;
			    case 100:
		               $query = "SELECT image as res FROM galeria_coleccion where IdGIG = $idnota";
					break;
			    case 101:
		               $query = "SELECT image as res FROM galeria_definicion where IdGIG = $idnota ";
					break;
			    case 102:
		               $query = "SELECT directorio as res FROM galeria_definicion where IdGIG = $idnota ";
					break;
			    case 200:
		               $query = "SELECT imagen as res FROM multimedia where idmedia = $idnota";
					break;
			    case 300:
		               $query = "SELECT imagen as res FROM multimedia where idmedia = $idnota";
					break;
			    case 50:
		               $query = "SELECT idcolumna as res FROM columnas where titulo_columna like ('%$cad%') order by idcolumna desc limit 1";
					break;
			    case 51:
		               $query = "SELECT count(idaro) as res FROM columnas where idaro = $type order by idcolumna desc limit 1";
					break;
			    case 400: //300:
		               $query = "select votos as res from enc_detalle where idencdet = $idnota limit 1";
					break;
			    case 11:
			          $strIN = $this->getStrQryTitulo($cad,"titulo");
		               $query = "SELECT count(idgig) as res FROM galeria_definicion Where $strIN and habilitado = 1 limit 1 ";
					break;
			    case 20:
			          $strIN = $this->getStrQryTitulo($cad,"titulom");
		               $query = "SELECT count(idmedia) as res FROM multimedia Where $strIN and habilitado = 1 limit 1 ";
					break;
			    case 2:
			          $strIN = $this->getStrQryTitulo($cad,"titulo_tema");
		               $query = "SELECT count(idcolumna) as res FROM columnas Where $strIN and habilitada = 1 limit 1 ";
					break;
			    case 12:
			          $strIN = $this->getStrQryTitulo($cad,"titulo");
		               $query = "SELECT count(idnota) as res FROM noticias Where $strIN and habilitada = 1 limit 1 ";
					break;
			    case 1300:
			          
		               $query = "SELECT Desc_Sec as res FROM secciones Where IdSec = $idnota  limit 1 ";
					break;
		  }
		  
		  
		  $Conn = voConn::getInstance();
		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  mysql_select_db($Conn->db);
		  
		  mysql_query("SET NAMES UTF8");
		  $result = mysql_query($query);
		  if ($result!=0){
			 $dat = mysql_fetch_array($result);
			 if ($tipo<100){
				 if ($dat["res"]!=0){
					 $res = $dat["res"];
				 }
			 }else{
				 $res = $dat["res"];
			 }
		  }
		  //mysql_free_result($result);
	       mysql_close($mysql);
		  
		  } catch (Exception $e) {
    			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		  }
		  
		  return  $res;
		  
	}
	

     public function getQry($tipo=0,$arg="",$pag=0,$limite=0){
		  $arr = array('voNotaBody','voNotaBody','voColumnBody','voMedia');
		  $index = 0;
		  $ret = array();
		  $query="Hola";
		  
		  try {
		
		   $limite = $limite!=0?" limit ".$pag.",".$limite :""; 
		 
            switch ($tipo){
			    case 1:
				     $strIN = $this->getStrQryTitulo($arg,"titulo");
					/*
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, a.nombrea as agencia, 
								  concat(r.nombrer,' ',r.appr,' ',r.apmr) as reportero, s.Desc_Sec as seccion, n.idsec, 
								  IFNULL(i.root,'core/fondoVacioThumb.png') as image, 
								  IFNULL(i.root_thumb,'core/fondoVacioThumb.png') as thumb 								  
						     FROM noticias n LEFT JOIN agencias a ON n.idagencia = a.idagencia 
								           LEFT JOIN reporteros r ON n.idreportero = r.idreportero 
										 LEFT JOIN secciones s ON n.idsec = s.idsec 
										 LEFT JOIN images i ON n.idnota = i.idnota
							Where $strIN and habilitada = 1 order by idnota desc ".$limite;
					*/		
					$query = "SELECT n.idnota, n.titulo, n.intronota, n.fecha, n.hora, n.cuerponota, n.lugar, '' as agencia, 
								  '' as reportero,  s.Desc_Sec as seccion, n.idsec, 
								  'core/fondoVacioThumb.png' as image, 
								  'core/fondoVacioThumb.png' as thumb 								  
						     FROM noticias n LEFT JOIN secciones s ON n.idsec = s.idsec
							Where $strIN and n.habilitada = 1 order by n.idnota desc ".$limite;
					$index = 0;				   
					break;
			    case 10:
				     $strIN = $this->getStrQryTitulo($arg,"titulo");
		               $query = "SELECT titulo,titulo_corto as intronota, idgig as idnota, fecha 
							FROM galeria_definicion 
							Where $strIN and habilitado = 1 order by idgig desc ".$limite;
					$index = 1;			   
					break;
			    case 2:
				     $strIN = $this->getStrQryTitulo($arg,"titulo_tema");
		               $query = "SELECT idcolumna, nombrec_columnista, titulo_columna, titulo_tema, imagen_columnista, fecha, 'null' as foto, idaro, idreportero  
							FROM columnas 
							Where $strIN and habilitada = 1 order by fecha desc ".$limite;
					$index = 2;			   
					break;
			    case 20:
				     $strIN = $this->getStrQryTitulo($arg,"titulom");
			    		$query = "SELECT idmedia,tipo,archivo,imagen,duracion,nombrecontenedor,titulom,descripcionm,idnota, codigo1,fecha 
							FROM multimedia 
							Where $strIN and habilitado = 1 order by idmedia desc ".$limite;
					$index = 3;
					break;
		  }
		  
		  $Conn = voConn::getInstance();
		   
		  $mysql = mysql_connect($Conn->server, $Conn->user, $Conn->pass);
		  
		  mysql_select_db($Conn->db);
		  mysql_query("SET NAMES UTF8");
		  
		  $result = mysql_query($query);
		  
		  while ($obj = mysql_fetch_object($result, $arr[$index])) {
			   $ret[] = $obj;
		  }
		  
		  //mysql_free_result($result);
	       mysql_close($mysql);
		  
		  } catch (Exception $e) {
    			//echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		  }
		  return  $ret;
	}

	
	
 }  


?>