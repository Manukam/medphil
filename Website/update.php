<?php

 require "dbConnect.php";

 //$sql = "UPDATE availableslots SET freeSlots = '".$_GET["freeSlots"]."' WHERE id = '2' ";
$sql = "INSERT INTO patientdosage(patientUserName,medicineName,dosageStatus) .VALUES ('$_GET["userName"]','$_GET["medicineName"]', '$_GET["dosageStatus"]')  "     ;

 if(mysqli_query($con,$sql)){
	echo"<br><h3>One Row Affected</h3>";
 }
 else{
	echo"Error in updating".mysqli_error($con);
 }

?>