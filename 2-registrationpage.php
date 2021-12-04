
<?php
    //background-color:#17242a;
    ob_start();
    session_start();
    if(!array_key_exists('currentId',$_GET)) {
        
        //header("Location: https://msafluid.000webhostapp.com/");
        //echo "<script>window.location.href='index.php';</script>";
        echo "over here";
        echo $_SESSION['currentId'];
        
    } if(isset($_POST['logout'])) {
        
        include('./logout.php');
        
    }
    $successMessage = "";
    $errorMessage = "";
    if($_POST) {

        include('connection.php');
        //connecting to mysql database
        if(mysqli_connect_error()) {
        //checking if there is an error
            die("Database Connection failed!");
            
        } else {
        //if connection is successful
            $name = mysqli_real_escape_string($link,$_POST['name']);
            $email = mysqli_real_escape_string($link,$_POST['email']);
            $state = mysqli_real_escape_string($link,$_POST['state-name']);
            $city = mysqli_real_escape_string($link,$_POST['city-name']);
            $password = mysqli_real_escape_string($link,password_hash($_POST['password'], PASSWORD_DEFAULT));
            $dob = mysqli_real_escape_string($link,$_POST['date-of-birth']);
            $address = mysqli_real_escape_string($link,$_POST['address']);
            $image = $_FILES['image']['name'];
            $target = "./images/".basename($image);
            
            //Checking weather the entered email already exists
            if($_GET['type'] == "admin") {
                
                $query = "SELECT `id` FROM `msa-admins` WHERE `email` = '".$email."'";
                
            } else {
                
                $query = "SELECT `id` FROM `msa-inspectors` WHERE `email` = '".$email."'";
                
            }
            
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_array($result);
            
            if($row) {
            //if the entered email already exsits 
                $errorMessage = "<div class = 'alert alert-danger' role='alert' style = 'margin: 12px;'>That email is already taken</div>";
                
            } else {
                
                if($_GET['type'] == "admin") {
                
                    $query = "INSERT INTO `msa-admins` (`name`,`email`,`state`,`city`,`password`,`dob`,`address`,`image`) VALUES ('".$name."','".$email."','".$state."','".$city."','".$password."','".$dob."','".$address."','".$image."')";

                } else {

                    $query = "INSERT INTO `msa-inspectors` (`name`,`email`,`state`,`city`,`password`,`dob`,`address`,`image`) VALUES ('".$name."','".$email."','".$state."','".$city."','".$password."','".$dob."','".$address."','".$image."')";
                }            
                if(mysqli_query($link,$query)) {

                    //echo "Insertion Successful";
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

                        //Image uploaded Successful
                        $successMessage = "<div class = 'alert alert-primary' role='alert'>Sign Up Successful!</div>";

                    } else {

                        echo "Image upload unsuccessful";

                    }

                } else {

                    echo "Insertion unsuccessful";

                }
                
            }
        
        }
     
    }

?>

<html>

    <head>
    
        <title> Registration Page</title>
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="fonts/fonts.css">
        
        <link rel="stylesheet" href="style.css">
        
        <script type="text/javascript" src="jquery.min.js"></script>
        
        <style type="text/css">
        
            
            .container{
                
                width: 70%;
                background:none;
                margin-top: 50px;
                border: 2px solid #1a1e20;
                border-radius: 15px;
                padding: 30px;
                background-color: #CBD8D8;
                font-family:inherit;
                color: #1a1e20;
                margin-bottom: 50px;
                
            } .reg-left{
                
                float: left;
                width: 48%;
                
                
            } .reg-right{
                
                width: 48%;
               
                
            } .reg-left1{
                
                float: left;
                width: 28%;
                
                
            } .reg-right1{
                
                width: 68%;
               
                
            } .login-inputs,.login-inputs:focus{
                
                margin-right: 12px;
                margin-left: 12px;
                
                border-color:#1a1e20;
                
            } #id-submit, .btn-file{
                
                margin-left: 20%;
                margin-right: 20%;
                width: 60%;
                
            } #errorMessage{
                
                display: none;
                margin: 12px;
                
            } 
        
        </style>
    
    </head>
    
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <a class="navbar-brand" href="#">MSA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              
                <span class="navbar-toggler-icon"></span>
              
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
                <?php
                
                    if($_GET['type'] == "admin") {
                        
                        echo '<ul class="navbar-nav mr-auto">
                
                                <li class="nav-item">

                                    <a class="nav-link" href="3-mainpage-admin.php">Home</a>

                                </li>

                                <li class="nav-item active">

                                    <a class="nav-link" href="2-registrationpage.php?type=admin">Admin Registration <span class="sr-only">(current)</span></a>

                                </li>

                            </ul>';
                        
                    } else {
                        
                        echo '<ul class="navbar-nav mr-auto">
                
                                <li class="nav-item ">

                                    <a class="nav-link" href="3-mainpage-admin.php">Home </a>

                                </li>

                                <li class="nav-item active">

                                    <a class="nav-link" href="2-registrationpage.php?type=inspector">Inspector Registration <span class="sr-only">(current)</span></a>

                                </li>

                            </ul>';
                        
                    }
                
                
                ?>
                
                
            </div>
            
            <form class="form-inline my-2 my-lg-0" method="post">
              
              <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="logout">Logout</button>
                
            </form>
            
        </nav>
    
        <div class="container">
            
            <h2 class="text-center">Registration</h2>
        
            <div id="errorMessage" class="alert alert-danger" role="alert">
            </div>
            
            <div>
                <?php
                
                    if($successMessage != "") {
                        
                        echo $successMessage;
                        
                    }
                
                    if($errorMessage != "") {
                        
                        echo $errorMessage;
                        
                    }
                ?>
            
            </div>
            
            <form method="post" id="registration-form" enctype="multipart/form-data">
               
                <div class="form-group">
                        
                        <input class="form-control reg-left login-inputs" type="text" placeholder=" Name" id="id-name" name="name">
                    
                </div>   
                <div class="form-group">
                    
                        <input type="email" class="form-control reg-right login-inputs" id="id-email" placeholder=" Email" name="email">
                    
                </div>   
                <div class="form-group">
                        
                        <select class="form-control reg-left login-inputs" id="id-state-name" name="state-name">
                            
                            <option value="" disabled selected>State</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            
                        </select>
                    
                </div>   
                <div class="form-group">
                        
                        <input class="form-control reg-right login-inputs" type="text" placeholder=" City" id="id-city-name" name="city-name">
                    
                </div>
                
                <div class="form-group">
                        
                        <input class="form-control reg-left login-inputs" type="password" placeholder=" Password" id="id-password" name="password">
                    
                </div>   
                <div class="form-group">
                        
                        <input class="form-control reg-right login-inputs" type="password" placeholder=" Confirm Password" id="id-confirm-password">
                    
                </div>
                
                <div class="form-group">
                        
                        <input placeholder="Date Of Birth" class="form-control reg-left1 login-inputs" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="id-date" name="date-of-birth"/>
                    
                </div>   
                <div class="form-group">
                        
                        <input class="form-control reg-right1 login-inputs" type="text" placeholder=" Address" id="id-address" name="address">
                    
                </div>
                
                <div class="form-group">
                    
                    <label class="btn btn-secondary btn-file" style="background-color:#8fc1e2;">
                        
                        
                        Image/Group Symbol 
                        
                        <input type="file" style="display: none;" id="id-image" accept="image/*" data-type='image' name="image">
                        
                    </label>
                    
                </div>
                
                <input type="submit" class="btn btn-dark" id="id-submit" name="submit-button" value="Submit!" style="background-color:#1095a2;">
                
            </form>
        
        </div>
    
        <script type="text/javascript">
        
            function isEmail(email) {
            
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
                
            } $("#id-submit").click(function() {
                
                var errorMessage = "";
                var fieldsMissing = "";
                
                if($("#id-name").val() == "") {
                    
                    fieldsMissing += "<br>Name"
                    
                } if($("#id-email").val() == "") {
                    
                    fieldsMissing += "<br>Email"
                    
                } if($("#id-state-name").val() == "") {
                    
                    fieldsMissing += "<br>State Name"
                    
                } if($("#id-city-name").val() == "") {
                    
                    fieldsMissing += "<br>City Name"
                    
                } if($("#id-password").val() == "") {
                    
                    fieldsMissing += "<br>Password"
                    
                } if($("#id-confirm-password").val() == "") {
                    
                    fieldsMissing += "<br>Conifrm Password"
                    
                } if($("#id-date").val() == "") {
                    
                    fieldsMissing += "<br>Date Of Birth"
                    
                } if($("#id-address").val() == "") {
                    
                    fieldsMissing += "<br>Address"
                    
                }if($("#id-image").val() == "") {
                    
                    fieldsMissing += "<br>Image"
                    
                } if (fieldsMissing != "") {
                    
                    errorMessage += "The following fied(s) are missing: " + fieldsMissing;
                    
                } else {

                    if($("#id-password").val() != $("#id-confirm-password").val()) {
                    
                        errorMessage += "The passwords do not match<br>";
                    
                    }
                    
                }
                
                if(errorMessage != "") {
                    
                    $("#errorMessage").html(errorMessage);
                    $("#errorMessage").show();
                    $("form").submit(function(e){
                        e.preventDefault();
                    });
                      
                } else {
                    
                    $("#errorMessage").hide();
                    $("#registration-form")[0].submit();
                    
                }
                
            });
        
        </script>
        
    </body>

</html>