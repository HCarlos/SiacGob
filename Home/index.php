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
        <li class="active">Timeline</li>
      </ul>
    </div>
  </section>
  <!-- .................................... $Portfolio .................................... -->
  <section class="section-content section-portfolio" id="section-portfolio">
    <div class="container">
      <h2 class="section-title">
        Denuncias
        <small> registradas en tiempo real.</small>
      </h2>
	 
      <div id="filters">
        <ul class="nav nav-pills">
          <li class="active">
            <a data-filter="*" href="#">Todos</a>
          </li>
          <li>
            <a data-filter=".filter-1" href="#">Recolección de Basura</a>
          </li>
          <li>
            <a data-filter=".filter-2" href="#">Fuga de Agua</a>
          </li>
          <li>
            <a data-filter=".filter-3" href="#">Baches</a>
          </li>
          <li>
            <a data-filter=".filter-4" href="#">Alumbrado Público</a>
          </li>
          <li>
            <a data-filter=".filter-5" href="#">Hundimiento</a>
          </li>
        </ul>
      </div>
	 
      <div class="row">
        <div class="isotope hoverdir" id="container-isotope">
	   <?php
	   	require_once("php/01/oCentura.php");
		$f = oCentura::getInstance();
		$arr = $f->getQuerys(5003,"",0,0,30);
		//echo count($arr);
		foreach($arr as $i=>$value){
			$arrFile = explode(".",$arr[$i]->imagen);
			$img1 = "http://dc.tabascoweb.com/php/01/uploads/".$arrFile[0]."-s.".$arrFile[1];
			$img2 = "http://dc.tabascoweb.com/php/01/uploads/".$arr[$i]->imagen;
			//echo $img1;
			
		?>
	   
          <div class="span3 isotope-item filter-p filter-<?php echo intval($arr[$i]->modulo)+1 ?>">
            <figure class="hoverdir-item">
              <img alt="" src="<?php echo $img1; ?>">
              <div class="figcaption hoverdir-bg">
                <div class="hoverdir-content">
                  <span class="btn-wrap">
			   <!--	
                    <a class="btn btn-squared btn-inverse" href="portfolio-item.html">
                      <i class="icon-heart"></i>
                    </a>
                    <a class="btn btn-squared btn-inverse" href="portfolio-item.html">
                      <i class="icon-external-link"></i>
                    </a>
				-->
                    <a class="btn btn-squared btn-inverse oMap" id="<?php echo $arr[$i]->idmdenuncia; ?>" href="#" >
                      <i class="icon-map-marker"></i>
                    </a>
                    <a class="btn btn-squared btn-inverse fancybox" data-fancybox-group="group" href="<?php echo $img2; ?>" title="<?php echo $arr[$i]->denuncia ?>" >
                      <i class="icon-picture"></i>
                    </a>
                  </span>
                </div>
              </div>
            </figure>
          </div>
		<?php
		}
		?>


        </div>
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
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="js/libs/jquery.ui.map.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/libs/jquery.fancybox.min.js"></script>
  <script src="js/libs/jquery.hoverdir.min.js"></script>
  <script src="js/libs/jquery.isotope.min.js"></script>
  <script src="js/libs/jquery.masonry.min.js"></script>
  <script src="js/libs/jquery.fitvids.min.js"></script>
  <!--<script src="js/libs/jquery.flexslider.min.js"></script>-->
  <script src="js/script.js"></script>

  <script src="js/libs/modernizr.min.js"></script>
  <script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/01/base.js"> </script>
  <script  src="<? echo "http://".$_SERVER['SERVER_NAME']."/";?>js/init.js"> </script>
  <script src="http://187.157.37.204:8080/socket.io/socket.io.js" > </script>
  <script>
  	var stream = io.connect('http://187.157.37.204:8080');
  </script>

  
</body></html>