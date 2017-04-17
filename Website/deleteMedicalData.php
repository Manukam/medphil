<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">
		<style>
		h1{

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
$medicineName=$_POST['medicineNameChoices'];
$query="DELETE  FROM patientmedicine WHERE medicineName = '$medicineName'";
//$results=mysqli_query($con,$query);
$result=mysqli_query($con,$query);
		if(!$result){
			die(mysqli_error($con));
		}else{
			echo "<br/>";
				echo "<br/>";
				echo "<br/>";
					echo "<br/>";
			echo"<h1> Successfully Deleted '$medicineName' from your site </h1>";
				echo "<br/>";
			echo"<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='patientHomePage.php'>";


    }
 ?>
</body>
</html>
