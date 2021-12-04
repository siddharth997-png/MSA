<?php
    session_start();
    if(!array_key_exists('currentId',$_SESSION)) {
        
        header("Location: 1-loginpage.php");
        
    }if(!array_key_exists('num-app',$_SESSION)) {
        
        header("Location: 4-procedure-1.php");
        
    }$row = "";
    include('connection.php');
    //Popultaing appraiser dropbox
    if(mysqli_connect_error()) {
        
        die("Connection error");
    } 
    if($_POST) {
        
        $appraisersarray = array();
        $queryCreateTable = "CREATE TABLE `".$_SESSION['part-number']."`(
                        `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,";
            
            
        for($i=1;$i<=$_SESSION['num-app'];$i++) {
         
            if($i != $_SESSION['num-app']) {
                
                $queryCreateTable .= "`appraiser-".$i."` DOUBLE,";
                
            } else {
                
                $queryCreateTable .= "`appraiser-".$i."` DOUBLE";
                
            }
            
            array_push($appraisersarray,mysqli_real_escape_string($link,$_POST['app-'.$i.'']));
            
        }$queryCreateTable .= ")ENGINE= InnoDB;"; 
        $appraisers = "";
        print_r($appraisersarray);
        for($i=0;$i<$_SESSION['num-app'];$i++) {
            
            $appraisers .= $appraisersarray[$i];
            if($i != $_SESSION['num-app']-1) {
                
                $appraisers .= " , ";
                
            }
            
            
        } $query = "UPDATE `msa-gauge-r&r-study` SET `appraisers` = '".$appraisers."' WHERE `part-number` = '".$_SESSION['part-number']."'";;
        //mysqli_query($link,$query);
        if(mysqli_query($link,$query)) {
            
            /*
            $db = 'id14849148_msaprocedures';
            $username = 'id14849148_root123';
            $pass = 'Uy>Xo{ct}EK?BS9#';
            $link = mysqli_connect($host,$username,$pass,$db);
            if(mysqli_connect_error()) {
                
                die("Connection Error");
                
            }*/
            /*if(!mysqli_query($link,$queryCreateTable)) {
                
                echo mysqli_error($link);
                echo "\nhere it is";
                
            }*/
            $_SESSION['procedure-start'] = "true";
            
            $_SESSION['tablename'] = $_SESSION['part-number'];
            echo "header";
            echo "<script>window.location.href='4-procedure-2.php';</script>";
            header("Location: 4-procedure-2.php");
                
        } else {
            
            echo "\nconnection prb \n";
            echo mysqli_error($link);
            
        }
        
        
    }
    

?>

<html>

    <head>
    
        <title>Appraisers</title>
    
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="style.css">
        
        <script type="text/javascript" src="jquery.min.js"></script>
        
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        
        
        <style type="text/css">
            
            .container{
                
                text-align: center;
                background-color: #e0e5e1;
                margin-left: 25%;
                margin-right: 25%;
                width: 50%;
                margin-top: 50px;
                border: 1px solid black;
                border-radius: 10px;
                font-family: sans-serif;
                margin-bottom: 10px;
                
            } h1{
                
                margin: 20px;
                
            } .form-control{
                
                margin-left: 15%;
                margin-right: 15%;
                width: 70%;
                margin-top: 20px;
                margin-bottom: 20px;
                
            } #jquery-errors{
                
                display: none;
                margin-left: 15%;
                margin-right: 15%;
                width: 70%;
                
            }
            
        </style>
        
    </head>
    
    <body>
    
        <div class="container text-center" id="secondary-container">
            
            <h1>Enter Appraisers : </h1> 
            
            <div id="jquery-errors" class="alert alert-danger" role="alert">
            
                
            
            </div>
           
            <form method="post">
                <?php

                    echo $_SESSION['input-app-array'];

                ?>
                
                <button type="submit" class="btn btn-primary" name="app-form-submit" id="id-app-form-submit">Submit</button>
            </form>
                
        </div>
        
        <script type="text/javascript">
        
            $("#id-app-form-submit").click(function() {
                
               var numapp = '<?php echo $_SESSION['num-app']; ?>';
                console.log(numapp);

                var i,j;
                var errorMessage = "";
                numapp = parseInt(numapp);
                for(i=1;i<=numapp;i++) {

                    for(j=i+1;j<=numapp;j++) {

                        if($("#id-app-"+i).val() == $("#id-app-"+j).val()) {
                            
                            errorMessage = "Enter valid Appraisers.";
                            break;
                            
                        }

                    }

                } if(errorMessage != "") {
                    
                    $("#jquery-errors").html(errorMessage);
                    $("#jquery-errors").show();
                    $("form").submit(function(e){
                        e.preventDefault();
                    });
                    
                } else {
                    
                    $("#jquery-errors").hide();
                    $("form")[0].submit();
                    
                } 
                
            });
            
        
        </script>
    
    </body>


</html>


<?php



?>