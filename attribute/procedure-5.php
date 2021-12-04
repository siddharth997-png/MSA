<?php
    $row = "";
    session_start();
    if(!array_key_exists('currentId',$_SESSION)) {
    //if user has not logged in
        header("Location: 1-loginpage.php");

    } include('../connection.php');
    $id = $_GET['id'];
    //echo $tablename;
    if(mysqli_connect_error()) {
            
        die("Dying");
            
        
    } $query = "SELECT * FROM `attribute-gauge-r&r-study` WHERE `idd` = '".$id."'";
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
            $result = $row['result'];
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
?>

<html>

    <head>
    
        <title>Gauge RR Study</title>
        
        <link rel="stylesheet" href="../style.css">

        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="../jquery.min.js"></script>

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

            <h1 id="header">Attribute R&amp;R Study</h1>
            
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
            <div class="alert alert-primary" role="alert">
                Effictiveness of a Measurement system should be greater than 80%.
            </div>
            <div class="alert alert-primary" role="alert">
                Bias should be greater than 1
            </div>
                <?php
                    echo $result;
                ?>

                <button type="button" class="btn btn-primary" id="view-results"><a href="../3-mainpage-admin.php">Go Back to Main page</a></button>
            
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