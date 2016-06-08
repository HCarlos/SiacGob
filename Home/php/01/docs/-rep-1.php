
<div id="container" style="min-width: 400px; height: 640px; margin: 0 auto; font:1em Arial, Helvetica, sans-serif bold;"> </div>
<?php
$subtitle = "DESDE:  ".$F->getWith3LetterMonthH($fi)." HASTA:  ".$F->getWith3LetterMonthH($ff);
?>
<link rel="stylesheet" type="text/css" href="../../../css/01/class_gen.css"/>
<script src="../../../js/api/jquery-1.7.2.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script>
    var colors = ['#6E1010','#29306F','#056819','#7C4912','#670661','#138895','#47245F','#925428','#245018','#BBBB03','#6E1010','#29306F','#056819','#7C4912','#670661','#138895','#47245F','#925428','#245018','#BBBB03','#6E1010','#29306F','#056819','#7C4912','#670661','#138895','#47245F','#925428','#245018','#BBBB03','#6E1010','#29306F','#056819','#7C4912','#670661','#138895','#47245F','#925428','#245018','#BBBB03']
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column'
        },
	   title:{text:"RESUMEN GENERAL POR DEPENDENCIAS"},
	   subtitle:{text:"<?php echo $subtitle; ?>"},
	   credits: {
            		text: 'logydes.com.mx',
            		href: 'mailto:manager@logydes.com.mx'
        },        
	   xAxis: {
            categories: [
		<?php 
			$i = 0;
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			while ($fila = mysql_fetch_object($result)) {
		 ?>
		  
		 '<?php echo $fila->grupo; ?>'
<?php
		if ( ($i+1) != $row ){
			echo ",";
		}
++$i;
			}
?>
		  
		  ], title: {text: 'DEPENDENCIAS'}
        },

series:[{data:[
		<?php 
			$i = 0;
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			while ($fila = mysql_fetch_object($result)) {
		
		?>
                {name: '<?php echo $fila->dependencia; ?>',color: colors[<?php echo $i; ?>],y: <?php echo $fila->sumid; ?>,dataLabels: {enabled: true,align: 'center',crop: false,style: {fontWeight: 'bold'}}}
		<?php
		
		if ( ($i+1) != $row ){
			echo ",";
		}
++$i;
			}
?>
                
              ]
}]

,
legend: {
            enabled: false
        },
yAxis: {
            lineWidth: 1,
            tickWidth: 1,
            title: {
                align: 'high',
                offset: 40,
                text: 'Número de Solicitudes',
                rotation: -90,
                y: 200
            }
	},
tooltip: {
            shared: true,
            useHTML: true,
            headerFormat: '<small>{point.key}</small><table>',
            pointFormat: '<tr><td style="color: {series.color}">Cant: </td>' +
            '<td style="text-align: right"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            valueDecimals: 0
        }	
		  
		  
    });
    
    

</script>
<?php
mysql_free_result($result);
mysql_close($mysql);
?>
<hr>
<p>Descargar archivo de datos en <a href='http://dc.tabascoweb.com/php/01/docs/<?php echo $fileout; ?>'>MS Excel</a></p>  

