<?php
$arg = $_POST["data"];
parse_str($arg);

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


require('../diag/sector.php');

class PDF_Diag extends PDF_Sector {
    var $legends;
    var $wLegend;
    var $sum;
    var $NbVal;
    var $ley;
    var $datos;


    function ColumnChart($w, $h, $data, $format, $color=null, $maxVal=0, $nbDiv=4)
    {

        // RGB for color 0
        $colors[0][0] = 0;
        $colors[0][1] = 102;
        $colors[0][2] = 155;

        // RGB for color 1
        $colors[1][0] = 0;
        $colors[1][1] = 155;
        $colors[1][2] = 0;

        // RGB for color 2
        $colors[2][0] = 75;
        $colors[2][1] = 155;
        $colors[2][2] = 255;

        // RGB for color 3
        $colors[3][0] = 75;
        $colors[3][1] = 0;
        $colors[3][2] = 155;

        // RGB for color 3
        $colors[4][0] = 255;
        $colors[4][1] = 153;
        $colors[4][2] = 51;

        $this->SetFont('Courier', '', 10);
        $this->SetLegends($data,$format);

        // Starting corner (current page position where the chart has been inserted)
        $XPage = $this->GetX()+50;
        $YPage = $this->GetY();
        $margin = 2; 

        // Y position of the chart
        $YDiag = $YPage + $margin;

        // chart HEIGHT
        $hDiag = floor($h - $margin * 2);

        // X position of the chart
        $XDiag = $XPage + $margin;

        // chart LENGHT
        $lDiag = floor($w - $margin * 3 - $this->wLegend);

        if($color == null)
            $color=array(155,155,155);
        if ($maxVal == 0) 
        {
            foreach($data as $val)
            {
                if(max($val) > $maxVal)
                {
                    $maxVal = max($val);
                }
            }
        }

        // define the distance between the visual reference lines (the lines which cross the chart's internal area and serve as visual reference for the column's heights)
        $valIndRepere = ceil($maxVal / $nbDiv);

        // adjust the maximum value to be plotted (recalculate through the newly calculated distance between the visual reference lines)
        $maxVal = $valIndRepere * $nbDiv;

        // define the distance between the visual reference lines (in milimeters)
        $hRepere = floor($hDiag / $nbDiv);

        // adjust the chart HEIGHT
        $hDiag = $hRepere * $nbDiv;

        // determine the height unit (milimiters/data unit)
        $unit = $hDiag / $maxVal;

        // determine the bar's thickness
        $lBar = floor($lDiag / ($this->NbVal + 1));
        $lDiag = $lBar * ($this->NbVal + 1);
        $eColumn = floor($lBar * 80 / 100);

        // draw the chart border
        $this->SetLineWidth(0.2);
        $this->Rect($XDiag, $YDiag, $lDiag, $hDiag);

        $this->SetFont('Arial', '', 7);
        $this->SetFillColor($color[0],$color[1],$color[2]);
        $i=0;
        foreach($data as $val) 
        {
            //Column
            $yval = $YDiag + $hDiag;
            $xval = $XDiag + ($i + 1) * $lBar - $eColumn/2;
            $lval = floor($eColumn/(count($val)));
            $j=0;
            foreach($val as $v)
            {
                $hval = (int)($v * $unit);

                $this->SetFillColor($colors[$j][0], $colors[$j][1], $colors[$j][2]);
                $this->Rect($xval+($lval*$j), $yval, $lval, -$hval, 'DF');
                $j++;
            }

            //Legend
            $this->SetXY($xval, $yval + $margin);
            $this->Cell($lval, 5, utf8_decode($this->legends[$i]),0,0,'C');
        	  $this->SetFont('Arial', '', 10);
            $this->SetTextColor(128,128,128);
            $this->Cell($lval-50, 15, $val[0],0,0,'C');
            $this->SetTextColor(0,0,0);
		  $this->SetFont('Arial', '', 7);
            $i++;
        }

        //Scales
        for ($i = 0; $i <= $nbDiv; $i++) 
        {
            $ypos = $YDiag + $hRepere * $i;
            //$this->Line($XDiag, $ypos, $XDiag + $lDiag, $ypos);
            $val = ($nbDiv - $i) * $valIndRepere;
            $ypos = $YDiag + $hRepere * $i;
            $xpos = $XDiag - $margin - $this->GetStringWidth($val);
            $this->Text($xpos, $ypos, $val);
        }
    }

    function SetLegends($data, $format)
    {
        //$this->legends=array("Hola","mun","do");
        $this->legends=$this->ley;
        $this->wLegend=0;
        $this->NbVal=count($data);
    }

    function Header()
    {   
		$this->SetFillColor(64,64,64);
          $this->Image('../../../images/img-web/sidc-logo-2-inner.jpg',0,0,300);
		$this->Ln(40);
	} 
    
}

switch ($type_report){
	case 0:
	      $dia1 = date('d',strtotime($fi));
	      $dia2 = date('d',strtotime($ff));
		 $mes1 = date('M',strtotime($ff));
		 $ano1 = date('Y',strtotime($ff));
		$datos = array("Materiales y Servicios Solicitados del ".$dia1." al ".$dia2." de ".$mes1." de ".$ano1,"Dependencias");
		break;
}


require_once('../vo/voConn.php');
require_once("../oFunctions.php");
require_once("../oCentura.php");
$f = oCentura::getInstance();

$ret = $f->getCombo(200,$fi.".".$ff,0,0,1);

$pdf = new PDF_Diag('L','mm','Letter');
$pdf->AddPage();

foreach($ret as $i=>$value){
	$data[$i] = array($ret[$i]->data);
	$ley[$i] =$ret[$i]->label;
} 
$pdf->ley = $ley;
/*
$data[0] = array(470);
$data[1] = array(450);
$data[2] = array(420);
*/

// Column chart
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(280, 5, $datos[0], 0, 1, 'C');
$pdf->Ln(10);
$valX = $pdf->GetX();
$valY = $pdf->GetY();
$pdf->ColumnChart(220, 100, $data, null, array(255,175,100));
//$pdf->SetXY($valX, $valY);

$pdf->Output();

?>
