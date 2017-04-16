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
$checkbox=$_POST['patients'];
$userName=$_POST["userName"];
for($i=0;$i<sizeof($checkbox);$i++){
  $query="INSERT INTO patientdoctor(patientUserName,doctorUserName) values('".$checkbox[$i]."','$userName')";
  $result=mysqli_query($con,$query);
  		if(!$result){
  			die(mysqli_error($con));
  		}else{


      }
}
echo "<br/>";
	echo "<br/>";
		echo "<br/>";
		echo"<h1 style=color:black> Hi DR. '$userName' </h1>";
		echo "<br/>";
echo"<h1> Successfully Added Your Details </h1>";
	echo "<br/>";
echo"<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='doctorHomePage.php'>";


 ?>

 </body>
 </html>
