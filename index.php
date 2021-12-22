<?php

    //123 $2y$10$YRfiA.HsgAAl.WxiSqOv.OpfoBUKze.zuw7J4oS2.hFtxO6/P8k0.
    //ob_start();
    $error = "";
    $success = "";
    session_start();
    include('connection.php');
    if(mysqli_connect_error()) {
    //checking if there is an error
        die("Database Connection failed!");
        
    }
    if($_POST) {
        //if connection to database is successful  
            $email = mysqli_real_escape_string($link,$_POST['email']);
            if($_POST['type'] == 'Admin') {
                
                $query = "SELECT `id`,`password` FROM `msa-admins` WHERE `email` = '".$email."'";
                
            } else {
                
                $query = "SELECT `id`,`password` FROM `msa-inspectors` WHERE `email` = '".$email."'";
                
            }
            
            //query to check weather the email exists in database
            if($result = mysqli_query($link,$query)) {
                
                if($row = mysqli_fetch_array($result)) {
                //email exists, check password  
                    if(password_verify($_POST['password'],$row['password'])){
                        
                        //echo $row['id'];
                        $success = "Login Successful";
                        //echo "Correct Password";

                    } else {

                        $error .= "Invalid password<br>";
                        //echo "Incorrect Password";

                    }
                    
                    
                } else {
                //email does not exist
                    $error .= "Invalid Email address";
                    //echo "Email does not exist exists";
                    
                }
                
            } else {
                echo mysqli_error($link);
                //echo "connection unsuccessful";
            }
        
    }

?>

<html>

    <head>
    
        <title>Login Page</title>
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="fonts/fonts.css">
        
        <link rel="stylesheet" href="style.css">
        
        <script type="text/javascript" src="jquery.min.js"></script>
        
        <style type="text/css">
            
            .container{
                
                margin-top: 70px;
                margin-bottom: 50px;
                padding: 50px;
                width: 50%;
                background-image: linear-gradient(to bottom right,white,whitesmoke );
                border: 2px solid #081c26;
                border-radius: 10px;
                
            } #header-text{
                
                font-size: 50px;
                color: #355971;
                
            }input{
                
                margin: 20px;
                
            } .login-form-inputs, #type{
                
                margin-left: 25%;
                margin-right: 25%;
                width: 50%;
                transition: 0.25s;
                text-align: center;
                background-color: whitesmoke;
                border-radius: 30px;
                
            } .login-form-inputs:focus{
                
                margin-left: 15%;
                margin-right: 15%;
                width: 70%;
                border-color:#7d94b4;
                background-color: #D1D9DC;
                
            } #jquery-errorMessages{
                
                display: none;
                margin-left: 20%;
                margin-right: 20%;
                width: 60%;
                
            } #php-errorMessages{
                
                margin-left: 20%;
                margin-right: 20%;
                width: 60%;
                
            } #id-submit{
                
                background-image: linear-gradient(to bottom right,#145265 , #60C7E8);
                border-radius: 20px;
                width: 150px;
                color: white;
                
            }
        
        </style>
    
    </head>
    
    <body>
    
        <div class="container text-center">
        
            <h1 id="header-text">Fluid Controls</h1>
            <p>Measurment System Analysis</p>
            
            <div id="jquery-errorMessages" class="alert alert-danger" role="alert">
            
                
            
            </div>
            
            <div id="php-errorMessages">
            
                <?php
                
                    if($error != "") {
                        
                        echo '<div class="alert alert-danger" role="alert">
                            '.$error.'
                        </div>';
                        
                    } if($success != "") {
                        
                        /*echo '<div class="alert alert-success" role="alert">
                            '.$success.'
                        
                        </div>';*/
                        if($_POST['type'] == 'Admin') {
                
                            $_SESSION['currentId'] = $row['id'];
                            //echo $_SESSION['currentId'];
                            header("Location: 3-mainpage-admin.php");
                            //echo "<script>window.location.href='3-mainpage-admin.php';</script>";

                        } 
                        
                    }
                
                ?>
            
            </div>
            
            <form id="loginForm" method="post">
                        
                <div class="form-group">
                            
                    <input type="email" class="form-control login-form-inputs" id="email" aria-describedby="emailHelp" placeholder=" Email" name = "email">
                            
                    <input type="password" class="form-control login-form-inputs" id="password" placeholder=" Password" name = "password">
                    
                    <select class="form-control" id="type" name = "type">
                                
                        <option>Admin</option>
                                
                        <option>Inspector</option>
                            
                    </select>
                            
                    <input type="submit" class="btn btn-outline-dark" id="id-submit" name="submit-button" value="Submit!">
                            
                    <p id="login-notregistered-text"><b>Not Registered? Ask an Admin to get you registered</b></p>
                            
                </div> 
                        
            </form>
        
        </div>
        
        <script type="text/javascript">
            
            $("#id-submit").click(function() {
                
                $fieldsMissing = "";
                if($("#email").val() == "") {
                    
                    $fieldsMissing += "Email<br>";
                    
                } if($("#password").val() == "") {
                    
                    $fieldsMissing += "Password<br>";
                    
                } if($fieldsMissing != "") {
                    
                    $("#jquery-errorMessages").html("The following fied(s) are missing :<br> "+$fieldsMissing);
                    $("#jquery-errorMessages").show();
                    $("form").submit(function(e){
                        
                        e.preventDefault();
                        
                    });
                    
                } else {
                    
                    $("#jquery-errorMessages").hide();
                    $("#loginForm")[0].submit();
                    
                }
                
            });
        
        </script>
    
    </body>

</html>