<?php
header("text/html; charset=utf-8");  
header("Cache-Control: no-cache");

$idmdenuncia = $_POST["id"];

require_once("php/01/oCentura.php");
$f = oCentura::getInstance();

require_once("php/01/oFunctions.php");
$Q = oFunctions::getInstance();

$arr = $f->getQuerys(5004,"ntipo=".$idmdenuncia,0,0,1);

$un    = explode("@",$arr[0]->username);
$fecha = explode(" ",$arr[0]->creado_el); 

date_default_timezone_set('America/Mexico_City');

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Siac Gob</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="ppparticularity.com" name="author">
  <link href="css/style-t1.css" rel="stylesheet">
	
  
  
  
  <link href="ico/favicon.ico" rel="shortcut icon">
  <link href="ico/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="ico/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
  <link href="ico/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">

<style type="text/css">

html,body{

margin:0px;

height:100%;

}
#users-contain {position:relative; width:96.7%;}
#formBody {position:relative; width:96.7%;}
#users-contain{ padding:1em; overflow:scroll; overflow-x:hidden;  text-align:left;}
#formBody > #h3{ padding:0.4em 0.5em; margin-bottom:0.8em; text-align:left;}
#formBody > #h3 span{ display:inline-block;}
#edad { width:50px;}
#users-contain{ overflow-y:scroll;}
.fondoBlanco{ background-color:#FFF !important ; color: #666;}
</style>
  
</head>
<body class="portfolio portfolio-4">
  <!-- .................................... $header .................................... -->
  <header class="navbar-fixed-top">
    <div class="container">
      <div class="navbar">
        <div class="navbar-inner">
          <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
            <i class="icon-reorder"></i>
          </a>
          <a class="brand span3" href="/">
            <img alt="" src="img/logo-t1.png">
          </a>
          <nav class="nav-collapse collapse">
<!--		
            <ul class="nav primary-nav pull-right">
              <li><a href="index.html">Home</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="services.html">Services</a></li>
              <li class="active dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Portfolio
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="portfolio-3.html">3 columns</a></li>
                  <li class="active"><a href="portfolio-4.html">4 columns</a></li>
                  <li><a href="portfolio-item.html">Portfolio item</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Pages
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="page-content-sidebar.html">Content sidebar</a></li>
                  <li><a href="page-sidebar-content.html">Sidebar content</a></li>
                  <li><a href="page-sidebar-content-sidebar.html">Sidebar content sidebar</a></li>
                  <li><a href="page-content-sidebar-sidebar.html">Content sidebar sidebar</a></li>
                  <li><a href="page-sidebar-sidebar-content.html">Sidebar sidebar content</a></li>
                </ul>
              </li>
              <li><a href="contact.html">Contact</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  More
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="features.html">Features</a></li>
                  <li><a href="feature-slider.html">Slider</a></li>
                  <li><a href="feature-video.html">Video</a></li>
                  <li><a href="feature-masonry-isotope.html">Masonry - Isotope</a></li>
                  <li><a href="feature-gallery.html">Gallery</a></li>
                  <li><a href="feature-pricing.html">Pricing</a></li>
                  <li><a href="news.html">News</a></li>
                  <li><a href="news-item.html">News item</a></li>
                  <li><a href="feature-miscellanea.html">Miscellanea</a></li>
                  <li><a href="colors.html">Colors</a></li>
                </ul>
              </li>
            </ul>
-->		  

          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- .................................... $breadcrumb .................................... -->
  <section class="section-breadcrumb section-color-graylighter">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="/">Perfil</a><span class="divider">/</span></li>
        <li><a href="/">Timeline</a><span class="divider">/</span></li>
        <li class="active">Geolocalización</li>
      </ul>
    </div>
  </section>
  <!-- .................................... $Portfolio .................................... -->
  <section class="section-content section-portfolio" id="section-portfolio">
    <div class="container">
      <h2 class="section-title">
        Ubicación:
        <small id="domicilio"> <?php echo $arr[0]->domicilio; ?></small>
      </h2>
      <div class="row">
	 



  <!-- .................................... $MAP on background .................................... -->
  <section class="section-content section-map-background" id="section-map-background">
    <div class="map map-background" id="mapDen"></div>

    <div class="hidden-phone">
      <div class="container">
        
	   <div class="row">
          <div class="span3 offset8">
            <div class="box box-shadow">
              <h3 class="box-title">
                <strong>Ficha de Datos</strong>
              </h3>
              <div class="box-content">
                <p>
                  Usuario:
                  <br>
                  <strong><?php echo $un[0]; ?></strong>
                  <br>
                  <br>
                  Fecha 
                  <br>
                  <?php echo  $Q->getWith3LetterMonthD($fecha[0]); ?>
			   <br>
			   <br>
	   		   <a class="btn btn-small btn-primary" id="updateDom" href="#">
              		<i class="icon-save"></i>
              		Actualizar Ubicación
            	   </a>
			   <br>
			   <br>
	   		   <a class="btn btn-small btn-secondary" id="closeWindowMap" href="#">
              		<i class="icon-remove"></i>
              		Cerrar Ventana
            	   </a>
			   
                </p>
              </div>
		    
		    
            </div>
		  
          </div>
        </div>

	 
	 </div>
	 











	 
	 
    </div>
  </section>








	 
	 
    	 </div>
    </div>
  </section>
  
  <!-- .................................... $post-footer .................................... -->
  <div class="post-footer section-content section-content-mini section-color-graydark">
    <div class="container">
      <p class="pull-right">
        Designed by
        <a href="http://www.logydes.com.mx">logydes.com.mx</a>
      </p>
      <p>&copy; Tabascoweb - <?php echo date('Y'); ?> All rights reserved</p>
    </div>
  </div>
  <!-- .................................... $scripts .................................... -->
  <script src="js/libs/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>

  <script src="js/libs/modernizr.min.js"></script>
  <script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/01/base.js"></script>
  <script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/init.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  
  
  <script>
	var lat = <?php echo $arr[0]->latitud; ?>;
	var lon = <?php echo $arr[0]->longitud; ?>;
	obj.id = <?php echo $idmdenuncia; ?>;
	obj.dom = '<?php echo $arr[0]->domicilio; ?>';
	obj.init = true;
	
	$("#updateDom").hide();

		var tM ;
		switch(parseInt($('SELECT[name=tM]').val())){
			case 0:
				tM = google.maps.MapTypeId.ROADMAP;
				break;
			case 1:
				tM = google.maps.MapTypeId.SATELLITE;	
				break;
			case 2:
				tM = google.maps.MapTypeId.HYBRID;	
				break;
			case 3:
				tM = google.maps.MapTypeId.TERRAIN;	
				break;

		}

		var latlng = new google.maps.LatLng(lat,lon);
		var myOptions = {
		    zoom: 17,
		    center: latlng,
		    mapTypeControl: false,
		    mapMaker:true,
		    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
		    mapTypeId: tM
		};

		var map = new google.maps.Map(document.getElementById("mapDen"), myOptions);
		var img = "http://siac.tabascoweb.com/img/marker.png";
		
		var marker = new google.maps.Marker({
		    position: latlng, 
		    map: map, 
		    optimized:false,
			icon:img,
		    visible:true,
		    title:"Map View",
		    draggable:true
		  });
		dom    = geocodePosition(marker.getPosition());
		obj.newPos = "";
		google.maps.event.addListener(marker, 'dragend', function() {
			obj.init = false;
   			geocodePosition(marker.getPosition());
		});

		function geocodePosition(pos) {
		   geocoder = new google.maps.Geocoder();
		   geocoder.geocode
		    ({
		        latLng: pos
		    }, 
		        function(results, status) 
		        {
		            if (status == google.maps.GeocoderStatus.OK) {    
				  	  if (dom != "undefined"){
						  if (obj.dom==""){
					      	obj.dom    = results[0].formatted_address;
					      	obj.newPos = marker.position;
							updateCurrentPos();
						  }else{
					      	obj.dom    = results[0].formatted_address;
					      	obj.newPos = marker.position;
							if (!obj.init){
							   $("#updateDom").show();
							}
						  }
						  $("#domicilio").text(results[0].formatted_address);
						 //alert(obj.dom);
				       }
		                $("#mapSearchInput").val(results[0].formatted_address);
		                $("#mapErrorMsg").hide(100);
		            } 
		            else 
		            {
		                $("#mapErrorMsg").html('Cannot determine address at this location.'+status).show(100);
		            }
		        }
		    );
		}


  </script>






  
</body></html>