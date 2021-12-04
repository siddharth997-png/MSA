<?php
    $row = "";
    session_start();
    if(!array_key_exists('currentId',$_SESSION)) {
    //if user has not logged in
        header("Location: 1-loginpage.php");

    } if(!array_key_exists('tablename',$_SESSION) ) {
    //if user has logged in but directly jumps to this page
        header("Location: 4-procedure-1.php");

    } if(!array_key_exists('procedure-2',$_SESSION)) {
        
        header("Location: 4-procedure-2.php");
        
    } include('connection.php');
    $tablename = $_GET['tablename'];
    //echo $tablename;
    if(mysqli_connect_error()) {
            
        die("Dying");
            
        
    } $query = "SELECT * FROM `msa-gauge-r&r-study` WHERE `part-number` = '".$tablename."'";
    if($result = mysqli_query($link,$query)) {
        
        if($row = mysqli_fetch_array($result)) {
            
            $partnumber = $row['part-number'];
            $partname = $row['part-name'];
            $instrumentnumber = $row['instrument-number'];
            $instrumentname = $row['instrument-name'];
            $characteristic = $row['characteristic'];
            $gaugetype = $row['gauge-type'];
            $specification = $row['specification'];
            $upper = $row['upper'];
            $lower = $row['lower'];
            $trials = $row['trials'];
            $parts = $row['parts'];
            $numappraisers = $row['numappraisers'];
            $appraiserString = $row['appraisers'];
            $appraisers = explode(" , ",$appraiserString);
            $performer = $row['performer'];
            $date = $row['date'];
            
            /*echo $partnumber;
            echo $partname;
            echo $instrumentnumber;
            echo $instrumentname;
            echo $characteristic;
            echo $specification;
            echo $upper;
            echo $lower;
            echo "parts : ".$parts;
            echo $numappraisers;
            for($i=0;$i<$numappraisers;$i++) {
                
                echo "<br>".$appraisers[$i];
                
            }
            echo $trials;
            echo $performer;
            echo $date;*/
            
        } else {
            
            echo "not found";
            
        }
        
    } else {
        
        echo mysqli_error($link);
        
    }





    
$query = "SELECT * FROM `msa-procedure-results` WHERE `tablename`='".$tablename."'";
if($result = mysqli_query($link,$query)) {
    
    if($row = mysqli_fetch_array($result)) {
        
        $X_double_bar = $row['Xdoublebar'];
        $R_double_bar = $row['Rdoublebar'];
        $Rp = $row['Rp'];
        $X_bar_diff = $row['Xbardiff'];
        $UCLr = $row['UCLr'];
        $LCLr = $row['LCLr'];
        $EV = $row['EV'];
        $Percent_EV = $row['PercentEV'];
        $AV = $row['AV'];
        $Percent_AV = $row['PercentAV'];
        $RR = $row['RR'];
        $Percent_RR = $row['PercentRR'];
        $PV = $row['PV'];
        $Percent_PV = $row['PercentPV'];
        $tol = $_GET['tol'];
        $conclusion = "";
        $conclusion .= $row['Conclusion'];
        $ndc = $row['ndc'];
        
        
    }
    
} else {
    
    echo mysqli_error($link);
    
}

    
?>

<html>

    <head>
    
        <title>Gauge RR Study</title>
        
        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="jquery.min.js"></script>

        <style type="text/css">
            
            .container-fluid{
                
                text-align: center;
                margin-left: 5%;
                margin-right: 5%;
                background-color: whitesmoke;
                width: 90%;
                margin-top: 20px;
                border: 1px solid black;
                border-radius: 10px;
                font-family: sans-serif;
                margin-bottom: 10px;
                
            } h1,h6{

                margin: 10px;

            } h5{
                
                margin-top: 10px;
                margin-bottom: 10px;
                
            }  .xyz{
                
                margin-top: 30px;
                margin-bottom: 30px;
                
            } #first{

                margin-top: 30px;
            
            } .calc-disp{
                
                margin-left: 5%;
                margin-right: 5%;
                width: 90%;
                
            } .table-primary{
                
                margin-left: 30%;
                margin-right: 30%;
                width: 40%;
                
                
            } #display-calculations{
                
                overflow: auto;
                display: none;
                
            } tbody{
                
                font-weight: 700;
                font-size: 17px;
                
            } #view-results{
                
                margin: 30px;
                
            } #header{
                
                margin: 30px;
                
            } #leftt{
                
                margin-left: 25%;
                float: left;
                
            } #rightt{
                
                margin-right: 30%;
                float: right;
                
            } #conclusion {
                
                margin-left: 15%;
                margin-right: 15%;
                width: 70%;
                font-size: 20px;
                font-weight: 700;
                
            } a, a:hover{
                
                color: white;
                text-decoration: none;
                
            } .conclusion{
                display:flex;
                justify-content:center;
                align-items:center;
            }
            
        </style>
    
    </head>
    
    <body>

        <div class="container-fluid">

            <h1 id="header">Gauge R&amp;R Study</h1>
            
            <div id="basic-info">
            
                <table class="table text-center table-striped">
                  <tbody>
                    <tr>
                      <td>Part Number : <?php echo $partnumber; ?></td>
                      <td>Part Name : <?php echo $partname; ?></td>
                      <td>Instrument Name : <?php echo $instrumentname; ?></td>
                    </tr>
                    <tr>
                      
                      <td>Characteristic : <?php echo $characteristic; ?></td>
                      <td>Gauge Type : <?php echo $gaugetype; ?></td>
                      <td>Instrument Number : <?php echo $instrumentnumber; ?></td>
                    </tr>
                    <tr>
                      
                      <td>Specification : <?php echo $specification; ?>mm</td>
                      <td>Upper Limit : <?php echo $upper; ?>mm</td>
                      <td>Lower Limit : <?php echo $lower; ?>mm</td>
                    </tr>
                      
                    <tr>
                      
                      <td>Trials : <?php echo $trials; ?></td>
                      <td>Parts : <?php echo $parts; ?></td>
                      <td>Number of Appraisers : <?php echo $numappraisers; ?></td>
                    </tr>
                      
                    <tr>
                      
                      <td colspan="3">Appraisers : <?php echo $appraiserString; ?></td>
            
                    </tr>
                      
                    <tr>
                      
                        <td colspan="3">
                            
                            <span id="leftt">
                                Performer : <?php echo $performer; ?>
                            </span>
                            <span id=rightt>
                                Date : <?php echo $date; ?> 
                            </span>
                            
                        
                        </td>
                      
                    </tr>
                  </tbody>
                </table>
                
                <button type="button" class="btn btn-primary" id="view-results">View Results</button>
            
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div id="display-calculations">
                
                <table class="table text-center sm">
                    
                    
                      <tbody>


                            <tr>
                                
                                <td>
                                    <div class="alert alert-primary calc-disp" role="alert">
                                        <?php echo "X̿ = ".$X_double_bar;  ?>
                                        
                                    </div>
                                </td>
                                <td>
                                    <div class="alert alert-primary calc-disp" role="alert">
                                        <?php echo "R̿ = ".$R_double_bar;  ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="alert alert-primary calc-disp" role="alert">
                                        <?php echo "Rp = ".$Rp;  ?>
                                    </div>
                                </td>
                                
                                
                            </tr>
                            <tr>
                                
                                <td>
                                    <div class="alert alert-primary calc-disp" role="alert">
                                        <?php echo "X̅DIFF = ".$X_bar_diff;  ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="alert alert-primary calc-disp" role="alert">
                                        <?php echo "UCLr = ".$UCLr;  ?>
                                    </div>   
                                </td>
                                    
                                <td>
                                    <div class="alert alert-primary calc-disp" role="alert">
                                        <?php echo "LCLr = ".$LCLr;  ?>
                                    </div>  
                                </td>
                                
                            </tr>


                      </tbody>
                        
                   
                </table>
            
                <table class="table text-center" >
                    
                    <thead>
                        
                        <tr>
                            
                            <th scope="col" colspan="2"><h2>Measurement Unit Analysis</h2></th>
                            
                            <th scope="col" ><h2>% Tolerance (Tol)</h2></th>
                            
                            
                        </tr>
                        
                  </thead>
                    
                  <tbody>
                      
                    <tr>
                        
                        <td>
                            
                            <div class="calculations">
                                
                                <div class="alert alert-success calc-disp" role="alert">
                                    
                                    <h5>Repeatability - Equipment Variation (EV)</h5>
                                
                                    <h6>EV	=	R̿ x K1	</h6>
                                
                                    <h6><?php echo "EV	=	".$EV; ?></h6>
                                
                                </div>
                                
                                
                                
                                <div class="alert alert-success calc-disp" role="alert">
                                
                                    <h5>Repeatability &amp; Reproducibility (R &amp; R)</h5>

                                    <h6>R&amp;R	=  {(EV2 + AV2)}1/2	</h6>

                                    <h6><?php echo "R & R	=	".$RR; ?></h6>
                                    
                                </div>
                                
                                
                                <div class="alert alert-success calc-disp" role="alert">
                                
                                    <h5>Tolerance</h5>

                                    <h6>tol	=	upper - lower	</h6>

                                    <h6><?php echo "tol	=	".$tol; ?></h6>
                                    
                                </div>
                                
                            
                            </div>
                            
                        </td>
                        
                        <td>
                        
                            <div class="alert alert-success calc-disp" role="alert">
                                
                                    <h5>Reproducibility - Appraiser Variation (AV)</h5>

                                    <h6>AV	=	{(xDIFF x K2)^2 - (EV2/nr)}^1/2</h6>

                                    <h6><?php echo "AV	=	".$AV; ?></h6>
                                    
                                </div>
                            
                            
                            
                            <div class="alert alert-success calc-disp" role="alert">
                                
                                    <h5>Part Variation (PV)</h5>

                                    <h6>PV	=	RP x K3</h6>

                                    <h6><?php echo "PV	=	".$PV; ?></h6>
                                    
                                </div>
                            
                            <div class="alert alert-primary calc-disp" role="alert">
                                    
                                <h6 class="xyz" >% PV	=	100 (PV/Tol)	</h6>
                                
                                <h6><?php echo "% PV	=	".$Percent_PV."%"; ?></h6>
                                    
                                </div>
                        
                        </td>
                        
                        <td>
                            
                            <div class="calculations">
                            
                               <div class="alert alert-primary calc-disp" role="alert"> 
                                <h6 class="xyz" id="first">% EV	=	100 (EV/Tol)	</h6>
                                
                                <h6><?php echo "% EV	=	".$Percent_EV."%"; ?></h6>
                                   
                                </div>
                                
                                <div class="alert alert-primary calc-disp" role="alert">
                                
                                <h6 class="xyz" >% AV	=	100 (AV/Tol)	</h6>
                                
                                <h6><?php echo "% AV	=	".$Percent_AV."%"; ?></h6>
                                    
                                </div>
                                
                                <div class="alert alert-primary calc-disp" role="alert">
                                
                                <h6 class="xyz" >% RR	=	100 (R&amp;R/Tol)	</h6>
                                
                                <h6><?php echo "% RR	=	".$Percent_RR."%"; ?></h6>
                                
                                </div>
                                
                                <div class="alert alert-primary calc-disp" role="alert">
                                
                                <h6 class="xyz" >NDC	=	1.41 * (PV/RR)	</h6>
                                
                                <h6><?php echo "NDC	=	".$ndc; ?></h6>
                                
                                </div>
                                
                                
                            
                            </div>
                            
                        </td>
                        
                    </tr>
                      
                  </tbody>
                    
                </table>
                
                <div id="conclusion">
                
                    <?php echo "<h2>Conclusion : </h2><br>"."<div class='conslusion'>".$conclusion."</div>"; ?>
                
                </div>
                
                <button type="button" class="btn btn-primary" id="view-results"><a href="3-mainpage-admin.php">Go Back to Main page</a></button>
            
            </div>
            
        </div>
        
        <script type="text/javascript">
        
            $("#view-results").click(function() {
                
                $("#basic-info").hide();
                $("#display-calculations").show();
                
            });
        
        </script>
    
    </body>

</html>