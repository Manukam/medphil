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
include("websiteHeader.php");
 ?>




<?php
include("dbConnect.php");
$userName=$_POST["hiddenUserName"];
$medicineName=$_POST["medicineName"];
$doseageHourGap=$_POST["medicineHourDoseageGap"];
$doseageMinGap=$_POST["medicineMinDoseageGap"];
$doseageGap=($doseageHourGap*3600*60)+($doseageMinGap*60*60);
$notifyItreration=$_POST["notifyItreration"];
$warnDosage=$_POST["warnDosage"];
$bottleId=$_POST["bottleId"];

$query="INSERT INTO patientmedicine(patientUserName,dosageGap,notifyIterations,warnDosage,medicineName,bottleId)values('$userName','$doseageGap','$notifyItreration','$warnDosage','$medicineName','$bottleId')";
$result=mysqli_query($con,$query);
		if(!$result){
			die(mysqli_error($con));
		}else{
			//create new table in the database
			$query="CREATE TABLE $userName"."_dosage"."(
				id int NOT NULL AUTO_INCREMENT,
				patientUserName VARCHAR(25),
				medicineName VARCHAR(20),
				dosageStatus VARCHAR(20),
				dosageTime timestamp,
				PRIMARY KEY (id)
			)";
			$CreateResult=mysqli_query($con,$query);
			if(!$CreateResult){
				die(mysqli_error($con));
			}else{

			}

$data = '<'.$bottleId.'>'.$userName." " . $medicineName." ".$doseageGap." ".$notifyItreration." ".$warnDosage." ".'<'.'/'.$bottleId.'>'."\r\n";
    $ret = file_put_contents('userConfig.txt', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
      //  echo "$ret bytes written to file";
    }


			echo "<br/>";
				echo "<br/>";
					echo "<br/>";
					echo"<h1 style=color:black> Welcome to MedPhil Community </h1>";
					echo "<br/>";
			echo"<h1> Successfully Added Your Details </h1>";
				echo "<br/>";
			echo"<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='index.php'>";
    }
?>

</body>
</html>
