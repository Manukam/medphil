<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">
		<style>
		h1{
			color: #19baaa;
			text-align: center;
		}

		</style>


</head>
<body>

<?php
include("headerUser.php");
 ?>



<?php
include("dbConnect.php");
//session_start();
$userName=$_POST["userName"];
$medicineName=$_POST["medicineName"];
$doseageGap=$_POST["medicineDoseageGap"];
$notifyItreration=$_POST["notifyItreration"];
$warnDosage=$_POST["warnDosage"];
$bottleId=$_POST["bottleId"];

$query="INSERT INTO patientmedicine(patientUserName,dosageGap,notifyIterations,warnDosage,medicineName,bottleId)values('$userName','$doseageGap','$notifyItreration','$warnDosage','$medicineName','$bottleId')";

$result=mysqli_query($con,$query);
		if(!$result){
			die(mysqli_error($con));
		}else{
			echo "<br/>";
				echo "<br/>";
				echo "<br/>";
				echo"<h1 style=color:black>Hi '$userName'<h1/>";
					echo "<br/>";
			echo"<h1> Successfully Added '$medicineName' to your site </h1>";
				echo "<br/>";
			echo"<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='patientHomePage.php'>";


    }
mysqli_query($con,'SET foreign_key_checks = 1');
?>
</body>
</html>
