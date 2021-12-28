<?php
    $row = "";
    session_start();
    ob_start();
    if(!array_key_exists('currentId',$_SESSION)) {
        
        header("Location: ./index.php");
        echo "<script>window.location.href='./index.php';</script>";

        
    } if(isset($_POST['logout'])) {
        
        include('./logout.php');
        
    } if(array_key_exists('procedure-start',$_SESSION)) {
        
        unset($_SESSION['procedure-start']);
        unset($_SESSION['tol']);
        unset($_SESSION['tablename']);
        unset($_SESSION['procedure-2']);
        if(array_key_exists('procedure-start',$_SESSION)) {
            
            echo "key exists : ".$_SESSION['procedure-start'].$_SESSION['tol'].$_SESSION['tablename'].$_SESSION['procedure-2'];
            
        }
        
    }
    include('connection.php');
    
    //connecting to mysql database
    if(mysqli_connect_error()) {
    //checking if there is an error
        die("Database Connection failed!");
        
    } else {
    //if connection to database is successful  
        $query = "SELECT * FROM `msa-admins` WHERE `id` = '".$_SESSION['currentId']."'";
        $result = mysqli_query($link,$query);
        $row = mysqli_fetch_array($result);
        $_SESSION['currentId'] = $row['id'];
        /*echo $row['id'];
        echo $row['name'];
        echo $row['state'];
        echo $row['city'];
        echo $row['dob'];
        echo $row['address'];
        echo $row['image'];
        echo $row['email'];*/
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
        
        .navbar{
            	background-color:white;
            }
            .navbar-brand{
                
                color: white;
                font-size: 30px;
                
            }
            
            .sidenav {
                
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
            
            .container{
                
                text-align: center;
                background-color:#CBD8D8;
                margin-left: 20%;
                margin-right: 10%;
                width: 75%;
                margin-top: 100px;
                border: 1px solid black;
                border-radius: 10px;
                font-family: sans-serif;
                padding-bottom: 10px;
                
            }  #user-details{
                display:flex;
                justify-content:center;
                align-items:flex-start;
            }
            #user-details>div{
                width:50%;
            }
            #logo-images{
                width:300px;
                height:300px;
                margin-bottom:50px;
                border-radius:25px;
            }
            .user-text{
                
                font-size:20px;
                box-sizing:border-box;
                border-radius: 5px;
                background-color: #E3E7E7;
                padding:7px;
		        margin-right:20px;
                
            }.container>h1{
                
                padding: 25px;
                
            }
        
        </style>
    
    </head>
    
    <body>
    
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
                        
                        <a class="nav-link" href="2-registrationpage.php?type=admin&currentId=<?php echo $row['id'];
                        ?>">Admin Registration</a>
                        
                    </li>
                
                    <li class="nav-item">
                        
                        <a class="nav-link" href="2-registrationpage.php?type=inspector&currentId=<?php echo $row['id']; ?>">Inspector Registration</a>
                        
                    </li>
                
                </ul>
                
            </div>
            
            <form class="form-inline my-2 my-lg-0" method="post">
              
              <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="logout">Logout</button>
                
            </form>
            
        </nav>
        
        <div class="sidenav" id="mySideNav">
            
            <a href="" id="currentUser">About You</a>
            
            <a href="5-display-1.php">Variable Procedure</a>
            <a href="./attribute/display-1.php">Attribute Procedure</a>
            
        </div>
        
        <div class="container">
        
            <h1>Admin Details</h1>
            
            <div id="user-details">

                <div>

                    <?php
                        echo "<img src = 'images/".$row['image']."' id = 'logo-images'>";
                    ?>
                
                
                </div>
            
                <div>
                    <?php
                        echo "<p class='text-left user-text'>Name       :     ".$row['name']." </p>";
                        echo "<p class='text-left user-text'>Email      :     ".$row['email']." </p>";
                        echo "<p class='text-left user-text'>State      :     ".$row['state']." </p>";
                        echo "<p class='text-left user-text'>City       :     ".$row['city']." </p>";
                        echo "<p class='text-left user-text'>DOB        :     ".$row['dob']." </p>";
                        echo "<p class='text-left user-text'>Address    :     ".$row['address']." </p>";
                    
                    ?>
                </div>
            
            </div>
        
        </div>
        
        <script type="text/javascript">
        
            function openNav() {
                
                document.getElementById("mySidenav").style.width = "250px";
                
            }

            /* Set the width of the side navigation to 0 */
            function closeNav() {
                
                document.getElementById("mySidenav").style.width = "0";
                
            }
        
        </script>
        
    </body>

</html>