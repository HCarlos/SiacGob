    <style type="text/css">
      .header {
        color: purple;
        background-color: #abc;
        font-size: 40px;
        text-align: center;
      }
    </style>
    <div class="header">RESUMEN GENERAL POR DEPENDENCIAS</div>
<div id="chart_div" style="align: center; width: 1024px !important; height: 400px;"></div>
<?php
$subtitle = "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff);
?>
<link rel="stylesheet" type="text/css" href="../../../css/01/class_gen.css"/>

<script src="../../../js/api/jquery-1.7.2.min.js"></script>

<!--
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
-->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script type="text/javascript">
      google.load('visualization', '1',
          {'packages': ['corechart']});
      google.setOnLoadCallback(dibuja);

      function dibuja() {


        		var Datos = new google.visualization.DataTable({
	cols:
          [{type:"string",label:"init",pattern:"",id:"init"},
           {type:"number",label:"Supervisado",pattern:"#0.###############",id:"Supervisado"},
           {type:"number",label:"No Procede",pattern:"#0.###############",id:"No_Procede"},
           {type:"number",label:"Dep. Externa",pattern:"#0.###############",id:"DepExt"},
           {type:"number",label:"En Proceso",pattern:"#0.###############",id:"Proceso"},
           {type:"number",label:"Atendidos",pattern:"#0.###############",id:"Atendido"},
           {type:"number",label:"Resueltos",pattern:"#0.###############",id:"Resuelto"}
          ],
     rows:
          [
		<?php 
			$i = 0;
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			while ($fila = mysql_fetch_object($result)) {
		 ?>
		
		{c: [{v:"<?php echo $fila->grupo; ?>:<?php echo $fila->sumid; ?>"},
			{v:<?php echo $fila->verificado==0?0:$fila->verificado; ?>,f:"<?php echo $fila->verificado==0?0:$fila->verificado; ?>"},
			{v:<?php echo $fila->no_procede==0?0:$fila->no_procede; ?>,f:"<?php echo $fila->no_procede==0?0:$fila->no_procede; ?>"},
			{v:<?php echo $fila->otrasdep==0?0:$fila->otrasdep; ?>,f:"<?php echo $fila->otrasdep==0?0:$fila->otrasdep; ?>"},
			{v:<?php echo $fila->tramite==0?0:$fila->tramite; ?>,f:"<?php echo $fila->tramite==0?0:$fila->tramite; ?>"},
			{v:<?php echo $fila->atendidos==0?0:$fila->atendidos; ?>,f:"<?php echo $fila->atendidos==0?0:$fila->atendidos; ?>"},
			{v:<?php echo $fila->resuelto==0?0:$fila->resuelto; ?>,f:"<?php echo $fila->resuelto==0?0:$fila->resuelto; ?>"},
			]
		},
		<?php
			}
		?>
          ]
			});

        //var ticketsData = response.getDataTable();
	   console.log(Datos);
        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));
        chart.draw(Datos, {isStacked: true, legend: 'rigth',
            vAxis: {title: 'Número de Solicitudes'}}
		  
		  );

      }
    </script>

<?php
mysql_free_result($result);
mysql_close($mysql);
?>
<hr>
<p>Descargar archivo de datos en <a href='http://dc.tabascoweb.com/php/01/docs/<?php echo $fileout; ?>'>MS Excel</a></p>  
