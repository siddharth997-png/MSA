<?php
    
    $tol = 0.2;
    function getMax($array){ 
        
       $n = count($array);  
       $max = $array[0]; 
        
       for ($i = 1; $i < $n; $i++)  {
           
           if ($max < $array[$i]) {
               
               $max = $array[$i]; 
               
           }
           
        }
        return $max;  
        
    } function getMin($array){ 
        
       $n = count($array);  
       $min = $array[0]; 
        
       for ($i = 1; $i < $n; $i++)  {
           
           if ($min > $array[$i]) {
               
               $min = $array[$i]; 
               
           }
           
        }
        return $min;        
    }
    $array = array(
        
        "a111" => 13.34,"a112" => 13.37,"a113" => 13.37,"a114" => 13.31,"a115" => 13.31,"a116" => 13.33,"a117" => 13.36,"a118" => 13.39,"a119" => 13.32,"a1110" => 13.40,
        "a121" => 13.36,"a122" => 13.34,"a123" => 13.35,"a124" => 13.32,"a125" => 13.34,"a126" => 13.33,"a127" => 13.34,"a128" => 13.36,"a129" => 13.34,"a1210" => 13.36,
        "a131" => 13.33,"a132" => 13.36,"a133" => 13.38,"a134" => 13.35,"a135" => 13.35,"a136" => 13.35,"a137" => 13.32,"a138" => 13.38,"a139" => 13.35,"a1310" => 13.36,
        
        "a211" => 13.35,"a212" => 13.36,"a213" => 13.41,"a214" => 13.38,"a215" => 13.34,"a216" => 13.37,"a217" => 13.33,"a218" => 13.36,"a219" => 13.35,"a2110" => 13.32,
        "a221" => 13.31,"a222" => 13.34,"a223" => 13.38,"a224" => 13.34,"a225" => 13.37,"a226" => 13.38,"a227" => 13.36,"a228" => 13.35,"a229" => 13.39,"a2210" => 13.32,
        "a231" => 13.32,"a232" => 13.38,"a233" => 13.39,"a234" => 13.34,"a235" => 13.34,"a236" => 13.36,"a237" => 13.34,"a238" => 13.38,"a239" => 13.39,"a2310" => 13.36,
        
        "a311" => 13.33,"a312" => 13.39,"a313" => 13.32,"a314" => 13.36,"a315" => 13.38,"a316" => 13.37,"a317" => 13.33,"a318" => 13.34,"a319" => 13.35,"a3110" => 13.36,
        "a321" => 13.31,"a322" => 13.38,"a323" => 13.31,"a324" => 13.33,"a325" => 13.36,"a326" => 13.36,"a327" => 13.35,"a328" => 13.38,"a329" => 13.32,"a3210" => 13.37,
        "a331" => 13.35,"a332" => 13.36,"a333" => 13.34,"a334" => 13.35,"a335" => 13.36,"a336" => 13.33,"a337" => 13.35,"a338" => 13.34,"a339" => 13.35,"a3310" => 13.34,
    );

    /*$array = array(
        
        "a111" => 12.04,"a112" => 12.09,"a113" => 12.02,"a114" => 12.04,"a115" => 12.09,"a116" => 12.09,"a117" => 12.02,"a118" => 12.04,"a119" => 12.09,"a1110" => 12.02,
        "a121" => 12.04,"a122" => 12.09,"a123" => 12.02,"a124" => 12.04,"a125" => 12.09,"a126" => 12.09,"a127" => 12.02,"a128" => 12.04,"a129" => 12.09,"a1210" => 12.02,
        "a131" => 12.04,"a132" => 12.09,"a133" => 12.02,"a134" => 12.04,"a135" => 12.10,"a136" => 12.1,"a137" => 12.02,"a138" => 12.04,"a139" => 12.1,"a1310" => 12.03,
        
        "a211" => 12.04,"a212" => 12.09,"a213" => 12.02,"a214" => 12.04,"a215" => 12.09,"a216" => 12.09,"a217" => 12.02,"a218" => 12.04,"a219" => 12.09,"a2110" => 12.02,
        "a221" => 12.04,"a222" => 12.09,"a223" => 12.02,"a224" => 12.04,"a225" => 12.09,"a226" => 12.09,"a227" => 12.02,"a228" => 12.04,"a229" => 12.09,"a2210" => 12.02,
        "a231" => 12.04,"a232" => 12.09,"a233" => 12.03,"a234" => 12.04,"a235" => 12.09,"a236" => 12.09,"a237" => 12.03,"a238" => 12.04,"a239" => 12.09,"a2310" => 12.03,
        
        "a311" => 12.04,"a312" => 12.09,"a313" => 12.02,"a314" => 12.04,"a315" => 12.09,"a316" => 12.09,"a317" => 12.02,"a318" => 12.04,"a319" => 12.09,"a3110" => 12.02,
        "a321" => 12.04,"a322" => 12.09,"a323" => 12.02,"a324" => 12.04,"a325" => 12.09,"a326" => 12.09,"a327" => 12.02,"a328" => 12.04,"a329" => 12.09,"a3210" => 12.02,
        "a331" => 12.03,"a332" => 12.09,"a333" => 12.02,"a334" => 12.03,"a335" => 12.09,"a336" => 12.09,"a337" => 12.02,"a338" => 12.04,"a339" => 12.09,"a3310" => 12.02
    );*/

    //<!-- a111 = appraiser 1x trial 1y sample 1z-->
        
        $arrx_avg = array();
        $arrx_range = array();
        for($x=1;$x<4;$x++) {
            
            $arrz_avg = array();
            $arrz_range = array();
            for($z=1;$z<11;$z++) {

                $arry = array();
                for($y=1;$y<4;$y++) {

                    $arry[$y-1] = $array['a'.$x.$y.$z.''];

                }echo "<br>Average of ".$z." = ".round(array_sum($arry)/count($arry),3);
                echo "<br>Range of ".$z." = ".round(getMax($arry)-getMin($arry),3);
                $arrz_avg[$z-1] = (array_sum($arry)/count($arry));
                $arrz_range[$z-1] = (getMax($arry)-getMin($arry));

            }echo "<br>X Bar ".$x." = ".round(array_sum($arrz_avg)/count($arrz_avg),3);
            echo "<br>R Bar ".$x." = ".round(array_sum($arrz_range)/count($arrz_range),3)."<br><br>";
            $arrx_avg[$x-1] = (array_sum($arrz_avg)/count($arrz_avg));
            $arrx_range[$x-1] = (array_sum($arrz_range)/count($arrz_range));
                
        }echo "<br>X double Bar = ".round(array_sum($arrx_avg)/count($arrx_avg),3);
        echo "<br>R double Bar= ".round(array_sum($arrx_range)/count($arrx_range),3);
        //------------------------------------------------------------------------------------------------
        $X_double_bar = round(array_sum($arrx_avg)/count($arrx_avg),3);
        $R_double_bar = round(array_sum($arrx_range)/count($arrx_range),3);
        $X_bar_diff = round(getMax($arrx_avg)-getMin($arrx_avg),3);
        //------------------------------------------------------------------------------------------------
    
        echo "<br>X-bar-diff = ".$X_bar_diff;
        //calculation of part average
        $arrz_avg = array();
        for($z=1;$z<11;$z++) {
            
            $arrx_avg = array();
            for($x=1;$x<4;$x++) {

                $arry = array();
                for($y=1;$y<4;$y++) {

                    $arry[$y-1] = $array['a'.$x.$y.$z.''];

                }$arrx_avg[$x-1] = round(array_sum($arry)/count($arry),10);


            } $arrz_avg[$z-1] = round(array_sum($arrx_avg)/count($arrx_avg),10);
            //echo "<br>Part Variation of ".$z." = ". $arrz_avg[$z-1];
            
        } echo "<br>Rp = ".round(getMax($arrz_avg)-getMin($arrz_avg),3);
        //----------------------------------------------------------------
        $Rp = round(getMax($arrz_avg)-getMin($arrz_avg),3);
        
        //----------------------------------------------------------------
        /*$X_double_bar = 12.054;
        $R_double_bar = 0.0027;
        $X_bar_diff = 0.002;
        $Rp = 0.070;*/
        $D4 = 2.58;
        $D3 = 0;
        $K1 = 0.5908;
        $K2 = 0.5231;
        $n = 10;
        $r = 3;
        $K3 = 0.3146;
        /*
        D4 =3.27 for 2 trials and 2.58 for 3 trials
        D3 = 0 for up to 7 trial 
        K1 = 0.8862 for 2 trials, 0.5908 for 3 trials
        K2 = 0.7071 for 2 trials,0.5231 for 3 trials
        n = number of parts
        r = number of trials
        
        Parts	K3
        2	0.7071
        3	0.5231
        4	0.4467
        5	0.4030
        6	0.3742
        7	0.3534
        8	0.3375
        9	0.3275
        10	0.3146

        */
        //----------------------------------------------------------------
        $UCLr = round($R_double_bar*$D4,3);
        $LCLr = round($R_double_bar*$D3,3);
        //----------------------------------------------------------------
        //echo "<br>UCLr : ".$UCLr." LCLr : ".$LCLr;
        //"EV     :   Repeatability - Equipment Variation (EV)
        //AV     :   Reproducibility - Appraiser Variation (AV)
        //R&R    :   Repeatability & Reproducibility (R & R)
        //PV     :   Part Variation (PV)
        $EV = round($R_double_bar * $K1,5);
        
        $x = pow($X_bar_diff * $K2,2);
        $y = pow($EV,2);
        $z = ($n*$r);
        $a = sqrt($x - ($y/$z));
        $AV = round($a,5);
        
       
        $RR = round(sqrt(pow($EV,2) + pow($AV,2)),5);
        
        $PV = round($Rp * $K3,3);

        $TV = sqrt(pow($RR,2)+pow($PV,2));
    
        $Percent_EV = round(100*$EV/$TV,2);
        $Percent_PV = round(100*$PV/$TV,2);
        $Percent_AV = round(100*$AV/$TV,2);
        $Percent_RR = round(100*$RR/$TV,2);
        echo "<br>EV : ".$EV."<br>AV : ".$AV."<br>RR : ".$RR."<br>PV : ".$PV."<br>TV : ".$TV;
        echo "<br>%EV : ".$Percent_EV."<br>%AV : ".$Percent_AV."<br>%RR : ".$Percent_RR."<br>%PV : ".$Percent_PV;
        $ndc = 1.41*($PV/$RR);
        echo "<br>NDC : ".$ndc;
        


?>

<html>

    <head>
    
        <title> practice</title>
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="style.css">
        
        <script type="text/javascript" src="jquery.min.js"></script>
        
        <style type="text/css">
        
            .container-fluid{
                
                text-align: center;
                margin-left: 5%;
                margin-right: 5%;
                background-color: #e0e5e1;
                width: 90%;
                margin-top: 20px;
                border: 1px solid black;
                border-radius: 10px;
                font-family: sans-serif;
                margin-bottom: 10px;
                
            } h1,h6{

                margin: 10px;

            } h5{
                
                margin-top: 20px;
                
            }  .xyz{
                
                margin-top: 65px;
                
            } #first{

                margin-top: 30px;
            
            }
        
        </style>
        
    
    </head>
    
    <body>
    
        <div class="container-fluid">
        
            <h1>Gauge R&amp;R Study</h1>
            
            <div id="display-calculations">
                
                <table class="table text-center">
                  <tbody>
                    <tr>
                      <td><?php echo "X̿ = ".$X_double_bar;  ?></td>
                      <td><?php echo "R̿ = ".$R_double_bar;  ?></td>
                      <td>@<?php echo "Rp = ".$Rp;  ?></td>
                    </tr>
                    <tr>
                      <td><?php echo "X̅DIFF = ".$X_bar_diff;  ?></td>
                      <td><?php echo "UCLr = ".$UCLr;  ?></td>
                      <td><?php echo "LCLr = ".$LCLr;  ?></td>
                    </tr>
                    
                  </tbody>
                </table>
            
                <table class="table text-center" >
                    
                    <thead>
                        
                        <tr>
                            
                            <th scope="col"><h2>Measurement Unit Analysis</h2></th>
                            <th scope="col"><h2>% Tolerance (Tol)</h2></th>
                            
                        </tr>
                        
                  </thead>
                    
                  <tbody>
                      
                    <tr>
                        
                        <td>
                            
                            <div class="calculations">
                            
                                <h5>Repeatability - Equipment Variation (EV)</h5>
                                
                                <h6>EV	=	R̿ x K1	</h6>
                                
                                <h6><?php echo "EV	=	".$EV; ?></h6>
                                
                                <h5>Reproducibility - Appraiser Variation (AV)</h5>
                                
                                <h6>AV	=	{(xDIFF x K2)^2 - (EV2/nr)}^1/2</h6>
                                
                                <h6><?php echo "AV	=	".$AV; ?></h6>
                                
                                <h5>Repeatability &amp; Reproducibility (R &amp; R)</h5>
                                
                                <h6>R&amp;R	=  {(EV2 + AV2)}1/2	</h6>
                                
                                <h6><?php echo "R & R	=	".$RR; ?></h6>
                                
                                <h5>Part Variation (PV)</h5>
                                
                                <h6>PV	=	RP x K3</h6>
                                
                                <h6><?php echo "PV	=	".$PV; ?></h6>
                                
                                <h5>Tolerance</h5>
                                
                                <h6>tol	=	upper - lower	</h6>
                                
                                <h6><?php echo "tol	=	".$tol; ?></h6>
                            
                            </div>
                            
                        </td>
                        
                        <td>
                            
                            <div class="calculations">
                            
                                
                                <h6 class="xyz" id="first">% EV	=	100 (EV/Tol)	</h6>
                                
                                <h6><?php echo "% EV	=	".$Percent_EV."%"; ?></h6>
                                
                                <h6 class="xyz" >% AV	=	100 (AV/Tol)	</h6>
                                
                                <h6><?php echo "% AV	=	".$Percent_AV."%"; ?></h6>
                                
                                <h6 class="xyz" >% RR	=	100 (R&amp;R/Tol)	</h6>
                                
                                <h6><?php echo "% RR	=	".$Percent_RR."%"; ?></h6>
                                
                                <h6 class="xyz" >% PV	=	100 (PV/Tol)	</h6>
                                
                                <h6><?php echo "% AV	=	".$Percent_PV."%"; ?></h6>
                                
                                
                            
                            </div>
                            
                        </td>
                        
                    </tr>
                      
                  </tbody>
                    
                </table>
            
            </div>
                
        
        </div>
    
    </body>

</html>














