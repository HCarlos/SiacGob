<?php
$arg = $_POST["data"];
parse_str($arg);
?>
<!DOCTYPE HTML>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1.0', {'packages':['corechart']});
      //google.setOnLoadCallback(drawChart);
      function drawChart(datax,t,d) {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'label');
        data.addColumn('number', d);
	   data.addRows ( datax );
        // Set chart options
        var options = {'title':t,
                       width:'50%',
                       height:'460'
				   };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	 
	 
	 
    </script>
<style type="text/css">

html,body{

margin:0px;

height:100%;

}
body{ text-align:left;background:#FFF url(../../../images/img-web/sidc-logo-2-inner.jpg) top left no-repeat; height:auto;  }

#chart_div{margin-top:10em;}

</style>
    
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <table width="96%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    		<td width="15%"></td>	
    		<td width="80%"><div id="chart_div"></div></td>	
    </tr>
    <tr>
    		<td></td>	
    		<!--<td><a id="getPrintHMTL" href="#">Ver Edici&oacute;n Impresa</a></td>-->	
    </tr>
    </table>
    
 	<link rel="stylesheet" type="text/css" href="../../../css/external/normalize.css" />
   	<script  src="../../../js/api/jquery-1.7.2.min.js"></script>
   	<script  src="../../../js/01/base.js"></script>
   	<script  src="../../../js/01/core.js"></script>
   	<script  src="../../../js/01/environment.js"></script>
   	<script  src="../../../js/01/persistent.js"></script>
	<script  src="../../../js/api/jquery.form.js"></script>
   	<script  src="../../../js/init.js"></script>
     <script type="text/javascript">
 		 $("#getPrintHMTL").on('click',function(event){
			window.location.href = "pie-chart-pdf.php";

			var PARAMS = {data:<?php echo $arg; ?>};  
			var url = obj.getValue(0)+"php/01/docs/pie-chart-pdf.php";

			var temp=document.createElement("form");
			temp.action=url;
			temp.method="POST";
			temp.target="_blank";
			temp.style.display="none";
			for(var x in PARAMS) {
				var opt=document.createElement("textarea");
				opt.name=x;
				opt.value=PARAMS[x];
				temp.appendChild(opt);
			}
			document.body.appendChild(temp);
			temp.submit();
			return temp;
			
	 	 });
		 
		 var tr = <?php echo $type_report; ?>;
		 var dia1 = <?php echo date('d',strtotime($fi)); ?>;
		 var dia2 = <?php echo date('d',strtotime($ff)); ?>;
		 var Datax = new Array();

		function getForDep(f,t){
			obj.index = localStorage.opt;
			alert(obj.index);
			$.post(obj.getValue(0)+"getEC/", { o:obj.index, t:1, p:0, c:"<?php echo $fi.".".$ff; ?>" },
 				function(json){
					if (json.length<=0) { return false;}
					$.each(json, function(i, item) {
						Datax.push([ item.label , parseInt(item.data)]);
					});
					drawChart(Datax,f,t);
			}, "json");
		}
		
		switch (tr){
			case 0:
				getForDep("Materiales y Servicios Solicitados del "+dia1+" al "+dia2,"Dependencias");
				break;
		}
		 
   	</script>
  </body>
</html>
