<?php
session_start();
if(!array_key_exists('currentId',$_SESSION)) {
    header("Location: 1-loginpage.php");
}if(!array_key_exists('num-app',$_SESSION)) {
    header("Location: procedure-1.php");
} if(!array_key_exists('procedure-start',$_SESSION)) {
    header("Location: procedure-1.php");
}
include('../connection.php');
if(mysqli_connect_error()) {
    die("Connection error");
} 
if(isset($_POST['submit-button'])) {
    $vals = array();
    for($i=1;$i<=10;$i++) {
        $vals[$i] = $_POST['tv'.$i];
    }
    $_SESSION['vals'] = $vals;
    $SESSION['id'] = $id;
    echo "header";
    echo "<script>window.location.href='procedure-4.php';</script>";
    header("Location: procedure-4.php");
    // print_r($vals);
    // print_r($_POST);
}
?>

<html>

    <head>
    
        <title>Appraisers</title>
    
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="../style.css">
        
        <script type="text/javascript" src="../jquery.min.js"></script>
        
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        
        
        
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
            
            <h1>Attribute R&amp;R Study</h1> 
            <div class="alert " role="alert">
                <b>
                    Please enter the true values for all the parts. 
                </b>
            </div>
            <div class="alert warning" role="alert">
                <b>
                Please make sure that the number of accepted and rejected parts are equal. 
                </b>
            </div>
            <form action="" method="POST">
            <table class="table table-bordered border-primary">
  <thead>
      <!-- ROW 0 -->
    <tr>
      <th scope="col">Part Number</th>
      <th scope="col">Input</th>
      <th scope="col">Part Number</th>
      <th scope="col">Input</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">1</th>
      <td>
           <select name="tv1" id="idtv1" required>
            <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 

    </td>

      <td>6</td>
      <td> 
          <select name="tv6" id="idtv6" required>
          <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> </td>
    </tr>


      <!-- ROW 2 -->
    <tr>
      <th scope="row">2</th>
      <td>

          <select name="tv2" id="idtv2" required>
          <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 

    </td>
    
      <td>7</td>
      <td>
           <select name="tv7" id="idtv7" required >
           <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 
     </td>
    </tr>

    <!-- ROW 3 -->
    <tr>
      <th scope="row">3</th>
      <td>

          <select name="tv3" id="idtv3" required>
          <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 

    </td>
    
      <td>8</td>
      <td>
           <select name="tv8" id="idtv8" required>
           <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 
     </td>
    </tr>

    <!-- ROW 4 -->
    <tr>
      <th scope="row">4</th>
      <td>

          <select name="tv4" id="idtv4" required>
          <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 

    </td>
    
      <td>9</td>
      <td>
           <select name="tv9" id="idtv9" required>
           <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 
     </td>
    </tr>

    <!-- ROW 5 -->
    <tr>
      <th scope="row">5</th>
      <td>

          <select name="tv5" id="idtv5" required>
          <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 

    </td>
    
      <td>10</td>
      <td>
           <select name="tv10" id="idtv10" required>
           <option value="" disabled selected>Select an option</option>
            <option value="0">Reject</option>
            <option value="1">Accept</option>
            </select> 
     </td>
    </tr>


  </tbody>
</table> 
<button type="submit" name="submit-button">Submit</button> 
</form>
                
        </div>
            
        
        <script type="text/javascript">
        
            
        </script>
    
    </body>


</html>