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

$numParts =  (int)$_SESSION['num-parts'];
$partsTable = "";
for($i=1;$i<=$numParts;$i++) {
  $partsTable .= '
  <tr>
    <th scope="row">'.$i.'</th>
    <td>
      <select name="tv'.$i.'" id="idtv'.$i.'" required>
      <option value="" disabled selected>Select an option</option>
      <option value="0">Reject</option>
      <option value="1">Accept</option>
      </select>
    </td>
  </tr>
  ';
}


if(isset($_POST['submit-button'])) {
    $vals = array();
    for($i=1;$i<=$numParts;$i++) {
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
                
            } .table{
              overflow: scroll;
              height: 200px;
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
            <form action="" method="POST">
            <table class="table table-bordered border-primary">
  <thead>
     
    <tr>
      <th scope="col">Part Number</th>
      <th scope="col">Input</th>
    </tr>
  </thead>
  <tbody>
    <?php
      echo $partsTable;
    ?>

    
  </tbody>
</table> 
<button type="submit" name="submit-button">Submit</button> 
</form>
                
        </div>
            
        
        <script type="text/javascript">
        
            
        </script>
    
    </body>


</html>