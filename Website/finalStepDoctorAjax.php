<?php
// connect to database
include("dbConnect.php");
//session_start();
// username comes through AJAX - post request
$username = $_POST["reqUsername"];

//sql query to select usernames, that contains typed in string
$getCareTakerQuery="SELECT userName From patients WHERE userName LIKE '%".$username."%'";
//$getCareTakerQuery="SELECT userName From patients WHERE patients.userName  NOT IN (SELECT patientUserName FROM patientdoctor WHERE patientUserName LIKE '%".$username."%' )";
//$getCareTakerQuery="SELECT patients.userName FROM patients RIGHT JOIN patientdoctor ON patients.userName=patientdoctor.patientUserName WHERE patients.userName LIKE '%".$username."%' ";
$resultsGetMyCareTakers = mysqli_query($con,$getCareTakerQuery);
$counter=0;
while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
  // display each matching username
  // **** suggestion : display username and Full name
  echo "<a onclick=setPatient('".$getList['userName']."') class='navBarUpperText'>".$getList['userName']."</a></br>";
}

//echo $username;







?>
