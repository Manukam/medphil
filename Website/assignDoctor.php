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
include("headerWithoutLogin.php");
 ?>


<?php
include("dbConnect.php");
$checkbox=$_POST['patients'];
$userName=$_POST["hiddenUserName"];
$query="INSERT INTO patientdoctor(patientUserName,doctorUserName) values('$checkbox','$userName')";
$result=mysqli_query($con,$query);
		if(!$result){
			die(mysqli_error($con));
		}else{


		}
// for($i=0;$i<sizeof($checkbox);$i++){
//
// }

echo "<br/>";
	echo "<br/>";
		echo "<br/>";
		echo "<form method=POST name=careTakerSelectForm action=addMorePatients.php>";
		echo"<h1 style=color:black> Welcome to MedPhil Community </h1>";
		echo "<br/>";
echo"<h1> Successfully Added Your Details </h1>";
	echo "<br/>";
	echo"<input type=hidden name=hiddenUserName value=$userName>";
echo"<input type=button class= commonButton style='margin-left:810px' value =FinishProcedure onclick=document.location.href='index.php'>";
echo"<input type=submit class= commonButton style='margin-left:560px;margin-top:-38px' value =AddMorePatients onclick=document.location.href='addMorePatients.php'>";

 ?>

 </body>
 </html>
