<?php
session_start();
if(!array_key_exists('currentId',$_SESSION)) {
    header("Location: 1-loginpage.php");
}
$row = "";
include('../connection.php');
$link = mysqli_connect($host,$username,$pass,$db);
//Populting appraiser dropbox
if(mysqli_connect_error()) {
    die("Connection error");
}
$query = "SELECT `name` FROM `msa-admins` WHERE `id` = '".$_SESSION['currentId']."'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$admin = $row['name'];
$query = "SELECT `name` FROM `msa-inspectors`";
$result = mysqli_query($link,$query);
$inspectorArray = "";
while($row = mysqli_fetch_array($result)) {
    $inspectorArray .="<option value='".$row['name']."'>".$row['name']."</option>";
} 
if($_POST) {
    $part_number = mysqli_real_escape_string($link,$_POST['part-number']);
    $_SESSION['part-number'] = $part_number;
    $part_name = mysqli_real_escape_string($link,$_POST['part-name']);
    $instrument_number = mysqli_real_escape_string($link,$_POST['instrument-number']);
    $instrument_name = mysqli_real_escape_string($link,$_POST['instrument-name']);
    $characteristic = mysqli_real_escape_string($link,$_POST['characteristic']);
    $gauge_type = mysqli_real_escape_string($link,$_POST['gauge-type']);
    $specification = $_POST['specifications'];
    $upper = $_POST['upper'];
    $lower = $_POST['lower'];
    $tol = $upper - $lower;
    $numappraisers = 3;
    $appraisersarray = array();
    $_SESSION['num-app'] = 3;
    $_SESSION['num-trials'] = 3;
    $_SESSION['num-parts'] = 10;
    $appraisers = "";
    $_SESSION['input-app-array'] = "";
    for($i=1;$i<=$_SESSION['num-app'];$i++) {
        
        $_SESSION['input-app-array'] .= '<select class="form-control" type="text" placeholder="Appraiser '.$i.' : " id="id-app-'.$i.'" name="app-'.$i.'" required><option value="" disabled selected>Appraisal '.$i.'</option>'.$inspectorArray.'</select>';
        
    }
    $id = uniqid();
    $performer = mysqli_real_escape_string($link,$admin);
    $date = $_POST['date-performed'];
    $query = "INSERT INTO `attribute-gauge-r&r-study` (`idd`,`part-number`,`part-name`,`instrument-number`,`instrument-name`,`characteristic`,`gauge-type`,`specification`,`upper`,`lower`,`trials`,`parts`,`numappraisers`,`appraisers`,`performer`,`date`) VALUES ('".$id."','".$part_number."','".$part_name."','".$instrument_number."','".$instrument_name."','".$characteristic."','".$gauge_type."','".$specification."','".$upper."','".$lower."','".$_SESSION['num-trials']."','".$_SESSION['num-parts']."','".$numappraisers."','".$appraisers."','".$performer."','".$date."')";
    $_SESSION['tol'] = $tol;
    $_SESSION['part-number'] = $part_number;
    $_SESSION['id'] = $id;
    if(mysqli_query($link,$query)) {
        header("Location: procedure-2.php");
    } else {
        echo mysqli_error($link);
    }
}
?>

<html>

    <head>
    
        <title>Gauge R and R Study</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <link rel="stylesheet" href="../style.css">
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        
        <style type="text/css">
        
            .container{
                
                text-align: center;
                background-color: #e0e5e1;
                margin-left: 10%;
                margin-right: 10%;
                width: 80%;
                margin-top: 50px;
                border: 1px solid black;
                border-radius: 10px;
                font-family: sans-serif;
                margin-bottom: 10px;
                
            } h1{
                
                margin: 20px;
                
            } .reg-left1{
                
                float: left;
                width: 20%;
                margin-left: 250px;
                
                
            } .reg-right1{
                
                width: 60%;
               
                
            } .login-inputs{
                
                margin-right: 12px;
                margin-left: 12px;
                background-color: #e0e5e1;
                border-color:#1a1e20;
                
            } #id-submit{
                
                width: 80%;
                margin-left: 10%;
                margin-right: 10%;
                margin-top: -10px;
                
            } #jquery-errors{
                
                display: none;
                text-align: left;
                margin: 20px;
                margin-left: 35px;
                margin-right: 35px;
                
            } #id-specifications, #id-tolerance{
                
                display: inline-block;
                width: 47%;
                
            } .text-muted{
                
                margin-bottom: -20px;
                text-align: center;
                
            } #secondary-container{
                
                display: none;
                
            } #id-small-date-performed{
                
               
                
            }
        
        </style>
    x
    </head>
    
    <body>
    
        <div class="container" id="main-container">
        
            <h1>Attribute R&amp;R Study</h1> 
            
            <div id="jquery-errors" class="alert alert-danger" role="alert">
            
                
            
            </div>
            
            <form method="post" id="gaugeR&Rstudyform" >
                
                <table class="table">
                  
                    <tbody>
                        <tr>
                            <th scope="row"> </th>
                            <td>
                        
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder=" Part No./Drg.No :" id="id-part-number" name="part-number" required>
                    
                                </div>
                        
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder=" Instrument Name :" id="id-instrument-name" name="instrument-name" required>
                    
                                </div>
                            
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <!--<select class="form-control" type="text" placeholder="Number Of Appraisers" id="id-num-app" name="num-app">
                                        
                                        <option value="" disabled selected>Appraisal A</option>
                                        <?php
                                        
                                            //echo $inspectorArray;
                                        
                                        ?>
                                        
                                    </select>-->                                    
                                    <div class="alert alert-dark" role="alert">
                                      3 Appriasers
                                    </div>
                    
                                </div>
                            
                            </td>
                            <th scope="row"> </th>
                        </tr>
                        
                        <tr>
                            <th scope="row"> </th>
                            <td>
                        
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Part Name :" id="id-part-name" name="part-name" required>
                    
                                </div>
                        
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Instrument Number :" id="id-instrument-number" name="instrument-number" required>
                    
                                </div>
                            
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <!--<select class="form-control" type="text" placeholder="Number Of Trials" id="id-num-trials" name="num-trials">
                                        
                                        <option value="" disabled selected>Appraisal B</option>
                                        <?php
                                        
                                            //echo $inspectorArray;
                                        
                                        ?>
                                        
                                    </select>-->
                                                                       
                                <div class="alert alert-dark" role="alert">
                                     3 Trials
                                </div>
                    
                                </div>
                            
                            </td>
                            <th scope="row"> </th>
                        </tr>
                        
                        <tr>
                            <th scope="row"> </th>
                            <td>
                        
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Characteristic :" id="id-characteristic" name="characteristic" required>
                    
                                </div>
                        
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Gauge Type :" id="id-gauge-type" name="gauge-type" required>
                    
                                </div>
                            
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <!--<select class="form-control" type="text" placeholder="Appraiser C : " id="id-num-parts" name="num-parts">
                                        
                                        <option value="default" disabled selected>Appraisal C</option>
                                        <?php
                                        
                                           // echo $inspectorArray;
                                        
                                        ?>
                                        
                                    </select>-->
                                    
                                    <div class="alert alert-dark" role="alert">
                                     10 Parts
                                    </div>

                            </td>
                            <th scope="row"> </th>
                        </tr>
                        
                        <tr>
                            <th scope="row"> </th>
                            <td>
                        
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Specifications(in mm) :" id="id-specifications" name="specifications"> 
                                    +- 
                                    <input class="form-control" type="text" placeholder="" id="id-tolerance" name="tolerance" required>
                                    
                    
                                </div>
                        
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Upper :" id="id-upper" name="upper" required>
                    
                                </div>
                            
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Lower :  " id="id-lower" name="lower"  required>
                    
                                </div>
                            
                            </td>
                            <th scope="row"> </th>
                        </tr>
                        
                        <tr>
                            <th scope="row"> </th>
                            <td>
                        
                                <div class="form-group">
                        
                                    <input class="form-control" type="text" placeholder="Performed By : <?php echo $admin ?>" id="id-performer" name="performer" readonly>
                                    

                                </div> 
                        
                            </td>
                            <td>
                            
                                <div class="form-group">

                                    <input class="form-control" type="text" placeholder="Least Count(in mm) :" id="id-least-count" name="least-count" required>

                                </div>
                            
                            </td>
                            <td>
                            
                                <div class="form-group">
                        
                                    <input placeholder="Date Performed : " class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="id-date-performed" name="date-performed" required/>
                                    
                                    <small id="id-small-date-performed" class="form-text text-muted">Date Performed(YYYY-MM-DD)</small>
                    
                                </div>
                            
                            </td>
                            <th scope="row"> </th>
                        </tr>
                        
                  </tbody>
                    
                </table>
                
                <input type="submit" class="btn btn-dark" id="id-submit" name="submit-button" value="Next" style="background-color:#1095a2;">
                
            
            </form>
        
        </div>
        
        <script type="text/javascript">
        
            $("#id-submit").click(function() {
                
                var errorMessages = "";
                if($.isNumeric($("#id-tolerance").val()) && $("#id-tolerance").val() != "" && $.isNumeric($("#id-least-count").val()) && $("#id-least-count").val() != "" && $("#id-least-count").val() > $("#id-tolerance").val()/10) {
                    
                    errorMessages += "<br>The measuring instrument should be ten times more accurate as the characteristic to be measured<br>Least count should be <= Tolerance/10<br><br> "
                    
                } 
                
                if(!$.isNumeric($("#id-specifications").val()) && $("#id-specifications").val() != "") {
                    
                    errorMessages += "<br>Enter Valid Specification(in mm)."
                    
                }  if(!$.isNumeric($("#id-tolerance").val()) && $("#id-tolerance").val() != "") {
                    
                    errorMessages += "<br>Enter Valid tolerance(in mm)."
                    
                } if(!$.isNumeric($("#id-least-count").val()) && $("#id-least-count").val() != "") {
                    
                    errorMessages += "<br>Enter Valid Least Count(in mm)."
                    
                } //if($("#id-app-a").val() != "" && $("#id-app-b").val() != "" && $("#id-app-c").val() != "" && ($("#id-app-a").val() == $("#id-app-b").val() || ($("#id-app-b").val() == $("#id-app-c").val()) || ($("#id-app-a").val() == $("#id-app-c").val()))) {
                    
                   // errorMessages += "Enter Valid Appraisals.<br><br>";
                    
                //}
                
                if($("#id-tolerance").val() != "" && $("#id-specifications").val() != "" && $("#id-upper").val() != "" && $("#id-lower").val()!="" &&
                    (parseFloat($("#id-upper").val()) + parseFloat($("#id-lower").val())) != ($("#id-specifications").val())*2) {
                    
                    errorMessages += "<br>(Upper limit + Lower Limit)/2 Should be equal to Specification.";
                    
                } if($("#id-tolerance").val() != "" && $("#id-specifications").val() != "" && $("#id-upper").val() != "" && $("#id-lower").val()!="" &&
                    (parseFloat($("#id-upper").val()) - parseFloat($("#id-tolerance").val())) != parseFloat($("#id-specifications").val())) {
                    
                    errorMessages += "<br>Upper limit - Tolerance Should be equal to Specification.";
                    
                } if($("#id-tolerance").val() != "" && $("#id-specifications").val() != "" && $("#id-upper").val() != "" && $("#id-lower").val()!="" &&
                    (parseFloat($("#id-lower").val()) + parseFloat($("#id-tolerance").val())) != parseFloat($("#id-specifications").val())) {
                    
                    errorMessages += "<br>Lower limit + Tolerance Should be equal to Specification.";
                    
                } if($("#id-num-app").val()!="" && $("#id-num-app").val()!=3) {
                    
                    errorMessages += "<br>Enter number of appraisers in valid range.";
                    
                } if($("#id-num-trials").val()!="" && $("#id-num-trials").val()!=3 ) {
                    
                    errorMessages += "<br>Enter number of trials in valid range.";
                    
                } if($("#id-num-parts").val()!="" && $("#id-num-parts").val()!=10) {
                    
                    errorMessages += "<br>Enter number of trials in valid range.";
                    
                }
                
                if (errorMessages != "") {
                    
                    $("#jquery-errors").html( errorMessages);
                    $("#jquery-errors").show();
                    $("form").submit(function(e){
                        e.preventDefault();
                    });
                    
                } else {
                    
                    $("#jquery-errors").hide();
                    $("form")[0].submit();
                    
                } 
                
            });
            
            Date.prototype.toDateInputValue = (function() {
                
                var local = new Date(this); 
                local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                return local.toJSON().slice(0,10);
                
            });
            $(document).ready( function() {
                $('#id-date-performed').val(new Date().toDateInputValue());
            });
            
        
        </script>
    
    </body>

</html>