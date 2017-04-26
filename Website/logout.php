<?php
include("dbConnect.php");
mysqli_close($con);
//session_start();
session_destroy();
header("Location:index.php");

 ?>
