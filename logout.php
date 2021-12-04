<?php

$_SESSION['currentId'] = "";
session_destroy();
echo "logout";
header("Location: ./index.php");
echo "<script>window.location.href='index.php';</script>";

?>