<?php
//--------------------------Functions----------------------------------
ob_start();
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
//------------------------------------------------------------------------
    session_start();
    if(!array_key_exists('currentId',$_SESSION)) {
    //if user has not logged in
        header("Location: 1-loginpage.php");

    } if(!array_key_exists('tablename',$_SESSION) || !array_key_exists('tol',$_SESSION) || !array_key_exists('procedure-start',$_SESSION)) {
    //if user has logged in but directly jumps to this page
        header("Location: 4-procedure-1.php");

    }$tol = $_SESSION['tol'];
    $tablename = $_SESSION['tablename'];



    //echo "<br>".$_SESSION['num-app']."<br>".$_SESSION['num-trials']."<br>".$_SESSION['num-parts'];
    $numApp = $_SESSION['num-app'];
    $numTrials = $_SESSION['num-trials'];
    $numSamples = $_SESSION['num-parts'];

    $table = '<table class="table table-bordered table-hover"><thead><tr><th class="wider-column">Trial no.</th><th class="wider-column">Sample no.</th>';

    for($i=1;$i<=$numSamples;$i++) {
        
        $table .= '<th>Sample '.$i.'</th>';
        
    }$table.= '</tr></thead><tbody>';
    //i = trials
    //j = appraisers
    //k = samples
    //<!-- a111 = appraiser 1 trial 1 sample 1-->
    for($i=1;$i<=$numTrials;$i++) {
        
        $table .= '<tr><th rowspan="'.$numApp.'">Trial '.$i.'</th>';
        for($j=1;$j<=$numApp;$j++) {
            
            $table .= '<th>Appraiser '.$j.'</th>';
            for($k=1;$k<=$numSamples;$k++) {
                
                $table .= '<td><input type="number" name="a'.$j.$i.$k.'" size="10" step="0.001" required></td>';
                
            } if($j != $numApp) {
                
                $table .= '</tr><tr>';
                
            } else {
                
                $table .= '</tr>';
                
            }
            
        }
        
        
    } $table .= "</tbody></table>";
    




    if(isset($_POST['submit-button'])) {

        include('connection.php');
        if(mysqli_connect_error()) {

            die("Connection error");
            
        }/*$query = "INSERT INTO `".$_SESSION['tablename']."`(";
        for($x=1;$x<=$numApp;$x++) {
            
            $query .= "`appraiser-".$x."`";
            if($x != $numApp) {
                
                $query .= ",";
                
            }
            
        }*/ 
        
        //<!-- a111 = appraiser 1x trial 1y sample 1z-->
        
        
        for($y=1;$y<=$numTrials;$y++) {
            
            for($z=1;$z<=$numSamples;$z++) {
                
                $query = "INSERT INTO `".$_SESSION['tablename']."`(";
                for($x=1;$x<=$numApp;$x++) {

                    $query .= "`appraiser-".$x."`";
                    if($x != $numApp) {

                        $query .= ",";

                    }

                } $query .= ") VALUES (";
                
                for($x=1;$x<=$numApp;$x++) {

                    $query .= $_POST['a'.$x.$y.$z.''];
                    if($x != $numApp) {

                        $query .= ",";

                    }

                } $query .= ')';
                if(!mysqli_query($link,$query)) {
                    
                    echo mysqli_error($link);
                    
                }
                
                
            }
            
            
        }                            
                                         
        
        
       /* for($i=1;$i<$nu;$i++) {

            for($j=1;$j<=$numSamples;$j++) {

                $query = "INSERT INTO `".$_SESSION['tablename']."`(`appraisal-1`,`appraisal-2`,`appraisal-3`) VALUES ('".$_POST['a1'.$i.$j.'']."','".$_POST['a2'.$i.$j.'']."','".$_POST['a3'.$i.$j.'']."')";
                mysqli_query($link,$query);

            }

        }*///<!-- a111 = appraiser 1x trial 1y sample 1z-->
        $arrx_avg = array();
        $arrx_range = array();
        for($x=1;$x<=$numApp;$x++) {
            
            $arrz_avg = array();
            $arrz_range = array();
            for($z=1;$z<=$numSamples;$z++) {

                $arry = array();
                for($y=1;$y<=$numTrials;$y++) {

                    $arry[$y-1] = $_POST['a'.$x.$y.$z.''];

                }/*echo "<br>Average of ".$z." = ".round(array_sum($arry)/count($arry),2);
                echo "<br>Range of ".$z." = ".round(getMax($arry)-getMin($arry),2);*/
                $arrz_avg[$z-1] = (array_sum($arry)/count($arry));
                $arrz_range[$z-1] = (getMax($arry)-getMin($arry));

            }echo "<br>X Bar ".$x." = ".round(array_sum($arrz_avg)/count($arrz_avg),3);
            echo "<br>R Bar ".$x." = ".round(array_sum($arrz_range)/count($arrz_range),3);
            $arrx_avg[$x-1] = (array_sum($arrz_avg)/count($arrz_avg));
            $arrx_range[$x-1] = (array_sum($arrz_range)/count($arrz_range));
                
        }echo "<br>X double Bar = ".round(array_sum($arrx_avg)/count($arrx_avg),3);
        echo "<br>R double Bar= ".round(array_sum($arrx_range)/count($arrx_range),3);
        //------------------------------------------------------------------------------------------------
        $X_double_bar = (array_sum($arrx_avg)/count($arrx_avg));
        $R_double_bar = (array_sum($arrx_range)/count($arrx_range));
        $X_bar_diff = (getMax($arrx_avg)-getMin($arrx_avg));
        //------------------------------------------------------------------------------------------------
    
        //echo "<br>X-bar-diff = ".$X_bar_diff;
        //calculation of part average
        $arrz_avg = array();
        for($z=1;$z<=$numSamples;$z++) {
            
            $arrx_avg = array();
            for($x=1;$x<=$numApp;$x++) {

                $arry = array();
                for($y=1;$y<=$numTrials;$y++) {

                    $arry[$y-1] = $_POST['a'.$x.$y.$z.''];

                }$arrx_avg[$x-1] = (array_sum($arry)/count($arry));


            } $arrz_avg[$z-1] = (array_sum($arrx_avg)/count($arrx_avg));
            echo "<br>Part Variation of ".$z." = ". $arrz_avg[$z-1];
            
        } echo "<br>Rp = ".round(getMax($arrz_avg)-getMin($arrz_avg),3);
        //----------------------------------------------------------------
        $Rp = round(getMax($arrz_avg)-getMin($arrz_avg),10);
        //----------------------------------------------------------------
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
        echo "<br>UCLr : ".$UCLr." LCLr : ".$LCLr;
        //EV     :   Repeatability - Equipment Variation (EV)
        //AV     :   Reproducibility - Appraiser Variation (AV)
        //R&R    :   Repeatability & Reproducibility (R & R)
        //PV     :   Part Variation (PV)
        $EV = round($R_double_bar * $K1,3);
        //$AV = round(sqrt(pow($X_bar_diff * $K2,2) - pow($EV,2)/($n*$r)),4);
        //echo "<br>X_bar_diff : ".$X_bar_diff."<br>K2 : ".$K2."<br>pow(X_bar_diff * K2,2) : ".pow($X_bar_diff * $K2,2)."<br>pow(EV,2)/(n*r) : ".pow($EV,2)/($n*$r)."";
        $x = pow($X_bar_diff*$K2,2);
        $y = pow($EV,2);
        $z = ($n*$r);
        $uzn = $x-($y/$z);
        //echo "<br>Under sqrt sign(AVdmas) ".$uzn."";
        $AV = round(sqrt($uzn),4);
        if(is_nan($AV)) {
            
            $AV = 0;
            
        }
        $RR = round(sqrt(pow($EV,2) + pow($AV,2)),3);
        //echo "<br>Under sqrt sign(RR) : ".pow($EV,2);
        
        $PV = round($Rp * $K3,3);
        //$TV = sqrt
        $Percent_EV = round(100*$EV/$tol,2);
        $Percent_AV = round(100*$AV/$tol,2);
        $Percent_RR = round(100*$RR/$tol,2);
        $Percent_PV = round(100*$PV/$tol,2);
        echo "<br>EV : ".$EV."<br>AV : ".$AV."<br>RR : ".$RR."<br>PV : ".$PV;
        echo "<br>%EV : ".$Percent_EV."<br>%AV : ".$Percent_AV."<br>%RR : ".$Percent_RR."<br>%PV : ".$Percent_PV;
        $tol = round($tol,2);
        
        $X_double_bar = round($X_double_bar,4);
        $Rp = round($Rp,4);
        $X_bar_diff = round($X_bar_diff,4);
        $ndc = 1.41*($PV/$RR);
        $Conclusion = "";
        if($ndc > 5) {

            $Conclusion = "<div class='alert alert-success' role='alert'>Since Non Distinct Catogires is greater than 5, the study is considered valid.</div>";

        } else {
        
            $Conclusion = "<div class='alert alert-danger' role='alert'>Since Non Distinct Catogires is less than 5, the study is considered invalid.</div>";
            
        }
        
        if($Percent_RR < 10 ) {
        
            $Conclusion .= "<div class='alert alert-success' role='alert'>Since GRR is less than 10%, the instrument is considered to be an acceptable measurement System.</div>";

        } else if($Percent_RR >= 10 && $Percent_RR < 30 ) {

            $Conclusion .= "<div class='alert alert-warning' role='alert'>Since GRR is between 10% - 30%, the instrument may be acceptable for some applications or conditionallly acceptable.</div>";

        } else  {

            $Conclusion .= "<div class='alert alert-danger' role='alert'>Since GRR is greater than 30%, the instrument is rejected.</div>";

        } if( $EV > $AV) {

            $Conclusion .= "<div class='alert alert-success' role='alert'><h4>Recommendations : </h4><h5>Since Equipment Variation is greater than Appraiser Variation</h5><ul>Instrument needs maintainence</ul><ul>Redesign gauge for more rigidity</ul><ul>Improve clamping or location of gauging</ul></div> ";
        
        } else {
            
            $Conclusion .= "<div class='alert alert-success' role='alert'><h4>Recommendations : </h4><h5>Since Appraiser Variation is greater than Equipment Variation</h5><ul>Appraiser needs better  gauge use training</ul><ul>Incremental divisions on instrument are not readable</ul><ul>Need fixture to provide consistency in gauge use</ul></div> ";
            
        }
        
    
        include('connection.php');
        if(mysqli_connect_error()) {
            
            die("Dying");
            
        }$Conclusion = mysqli_real_escape_string($link,$Conclusion);
        $query = "INSERT INTO `msa-procedure-results` (`tablename`,`Xdoublebar`,`Rdoublebar`,`Xbardiff`,`Rp`,`UCLr`,`LCLr`,`EV`,`AV`,`RR`,`PV`,`PercentEV`,`PercentAV`,`PercentRR`,`PercentPV`,`ndc`,`Conclusion`) VALUES ('".$tablename."',".$X_double_bar.",".$R_double_bar.",".$X_bar_diff.",".$Rp.",".$UCLr.",".$LCLr.",".$EV.",".$AV.",".$RR.",".$PV.",".$Percent_EV.",".$Percent_AV.",".$Percent_RR.",".$Percent_PV.",".$ndc.",'".$Conclusion."')";
        
        echo $query;
        if(mysqli_query($link,$query)) {
            
            $_SESSION['procedure-2'] = $tablename;
            header("Location:4-procedure-3.php?tablename=".$tablename."&tol=".$tol);
            //echo "<script>window.location.href= '4-procedure-3.php?tablename="$tablename"+&tol=\".$tol";</script>";
            
        } else {
            
            echo "<br>error";
            echo mysqli_error($link);
            
        }
        ////<!-- a111 = appraiser 1 trial 1 sample 1-->
    }
?>

<html>

    <head>

        <title>Gauge R and R Report</title>

        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <script type="text/javascript" src="jquery.min.js"></script>
        
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

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
                float: left;
                overflow: auto;

            } input{

                border:none;
                border-radius: 5px;
                width: 90%;

            } .wider-column{

                width: 120px;

            } h1{

                margin: 10px;

            } #id-submit{

                width: 60%;
                margin-left: 20%;
                margin-right: 20%;
                margin-bottom: 15px;

            } #display-calculations {
                
                display: none;
                
            }

        </style>

    </head>

    <body>

        <div class="container-fluid">

            <h1>Gauge R&amp;R Study</h1>

            <form method="post" id="input-table" autocomplete="on">
                
                <?php
                    echo $table;
                ?>

            <input type="submit" class="btn btn-dark" id="id-submit" name="submit-button" value="Next" style="background-color:#1095a2;">

            </form>

        </div>


    </body>


</html>


