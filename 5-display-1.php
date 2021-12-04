<?php
     
    session_start();
    if(!array_key_exists('currentId',$_SESSION)) {
        
        header("Location: 1-loginpage.php");
        
    } if(isset($_POST['logout'])) {
        
        include('./logout.php');
        
    }  $row = "";
    include('connection.php');
    //Populting appraiser dropbox
    if(mysqli_connect_error()) {
        
        die("Connection error");
        
    } $query = "SELECT `part-number`,`performer`,`date`,`upper`,`lower` FROM `msa-gauge-r&r-study`";
    $result = mysqli_query($link,$query);
    $_SESSION['tablename'] = "true";
    $_SESSION['procedure-2'] = "true";

    $displayField = "";
    $i=1;
    $tol = 0;
    while($row = mysqli_fetch_array($result)) {

        $tol = $row['upper']-$row['lower'];
        $displayField .= "<div class='alert alert-dark text-left' role='alert'><a href='4-procedure-3.php?tablename=".$row['part-number']."&tol=".$tol."'>".$i.") Part Number : ".$row['part-number']."<br>   Performer : ".$row['performer']."<br>   Date : ".$row['date']."</a></div>";
        $i++;
    
    } if($displayField == "") {
        
        $displayField = "No Gauge R&amp;R studies have been performed yet.";
        
    }
    
    
     
?>
<html>

    <head>
    
        <title>Welcome Admin</title>
        
        <link rel="stylesheet" href="style.css">
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        
        <script type="text/javascript" src="jquery.min.js"></script>
        
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        <style type="text/css">
            
            .navbar-brand{
                
                color: white;
                font-size: 30px;
                
                
            } .sidenav {
                
                  height: 100%; /* Full-height: remove this if you want "auto" height */
                  width: 160px; /* Set the width of the sidebar */
                  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
                  z-index: 1; /* Stay on top */
                   /* Stay at the top */
                  left: 0;
                  background-color: #111; /* Black */
                  overflow-x: hidden; /* Disable horizontal scroll */
                  padding-top: 20px;
                  margin-top: -29px;
                
            }

                /* The navigation menu links */
            .sidenav a {
                
                  padding: 6px 8px 6px 16px;
                  text-decoration: none;
                  font-size: 25px;
                  color: #818181;
                  display: block;
            }

                /* When you mouse over the navigation links, change their color */
            .sidenav a:hover, #currentUser {
                
                  color: #f1f1f1;
                
            }

                /* Style page content */
            .main {
                  margin-left: 160px; /* Same as the width of the sidebar */
                  padding: 0px 10px;
            }

                /* On smaller screens, where height is less than 450px, change the style of the sidebar (less padding and a smaller font size) */
            @media screen and (max-height: 450px)  {
                  .sidenav {padding-top: 15px;width: 100px;}
                  .sidenav a {font-size: 18px;}
            } @media screen and (max-width: 500px) {
                  .sidenav {padding-top: 15px;width: 100px;}
                  .sidenav a {font-size: 18px;}
                
            } h1{
                
                margin: 20px;
                
            } .container{
                
                text-align: center;
                background-color: #e0e5e1;
                margin-left: 25%;
                margin-right: 30%;
                width: 60%;
                margin-top: 100px;
                border: 1px solid black;
                border-radius: 10px;
                font-family: sans-serif;
                padding-bottom: 10px;
                
            } a{
                
                color: black;
                
            } a:hover{
                
                text-decoration: none;
                color: black;
                
            }.alert-dark:hover{
                background-color:#9A9C9C;
            }
            
        
        </style>
    
    </head>
    
    <body>
        
        <div class="sidenav" id="mySideNav">
            
            <a href="3-mainpage-admin.php" >About You</a>
          
            <a href="4-procedure-1.php">Procedure</a>
            
            <a href="5-display-1.php" id="currentUser">Display Conclusions</a>
            
        </div>
    
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            
            <a class="navbar-brand" href="#">MSA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              
                <span class="navbar-toggler-icon"></span>
              
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
                <ul class="navbar-nav mr-auto">
                
                    <li class="nav-item active">
                        
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        
                    </li>
                
                    <li class="nav-item">
                        
                        <a class="nav-link" href="2-registrationpage.php?type=admin&">Admin Registration</a>
                        
                    </li>
                
                    <li class="nav-item">
                        
                        <a class="nav-link" href="2-registrationpage.php?type=inspector">Inspector Registration</a>
                        
                    </li>
                
                </ul>
                
            </div>
            
            <form class="form-inline my-2 my-lg-0" method="post">
              
              <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="logout">Logout</button>
                
            </form>
            
        </nav>
        
        
        
        <div class="container">
        
            <h1>Studies Conducted : </h1>
            
            <?php 
            
                echo $displayField;
            
            ?>
        
        </div>
    
    </body>


</html>