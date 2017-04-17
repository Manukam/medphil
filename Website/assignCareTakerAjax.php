<?php
// connect to database
include("dbConnect.php");
//session_start();
// username comes through AJAX - post request
$username = $_POST["reqUsername"];

//sql query to select usernames, that contains typed in string
$getCareTakerQuery="SELECT userName From caretakers WHERE userName LIKE '%".$username."%'";
//$getCareTakerQuery="SELECT userName From caretakers WHERE caretakers.userName NOT IN (SELECT caretakerUserName FROM patientcaretaker WHERE patientUserName ='$_SESSION[session1]')";
$resultsGetMyCareTakers = mysqli_query($con,$getCareTakerQuery);
$counter=0;
while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
  // display each matching username
  // **** suggestion : display username and Full name
  echo "<a onclick=setCareTaker('".$getList['userName']."') class='navBarUpperText'>".$getList['userName']."</a></br>";
}

//echo $username;







?>
