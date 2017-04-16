<?php
include("dbConnect.php");
$selectedCareTaker=$_POST['caretakerChoices'];
$userName=$_POST["hiddenUserName"];
$query="INSERT INTO patientcaretaker(patientUserName,	caretakerUserName)values('$userName','$selectedCareTaker')";
$result=mysqli_query($con,$query);
		if(!$result){
			die(mysqli_error($con));
		}else{
?>
<!DOCTYPE>
<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">

</head>
<body>

	  	<?php
	  		include("websiteHeader.php");
	  	?>

<div class="contentDiv" id="container" style="width:500px; margin-left:-55px">
<form method="POST" name="careTakerSelectForm" action="medicalConfig.php">
	<h1>Sign Up </h1>

<a>Be a part of our community</a>
<br/>
	<p><b>Step 5: Please cofigure your medicine details</b></p>
	<img src="images/app.png" style="width:200px; margin-left:105px">
	<br/><br/>
	  <a class="formText" id="txtMedicineName" name="txtMedicineName"> Medicine Name<font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="text" class="inputs" name="medicineName" id="medicineName" size="30" placeholder="Medicine Name" required><br/><br/>
		<a class="formText" id="txtDoseageGap" name="txtDoseageGap">Doseage Gap <font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="number" min="0" max=24 class="inputs" name="medicineHourDoseageGap" id="medicineHourDoseageGap" size="30" placeholder="HH" required>
<font color="red">:</font></a>
&nbsp;&nbsp;
<input type="number" min="0" max=60 class="inputs" name="medicineMinDoseageGap" id="medicineMinDoseageGap" size="30" placeholder="MM" required>
		<br/><br/>
		<a class="formText" id="txtNotifyIteration" name="txtNotifyIteration">How many times to give bottle notification <font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="number" min="0" class="inputs" name="notifyItreration" id="notifyItreration" size="30" placeholder="Notify Times" required>
		<a class="formText" id="txtGram" name="txtGram">Times</a><br/><br/>
		<a class="formText" id="txtWarnDosage" name="txtWarnDosage">Warn Dosage <font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="number" min="0" class="inputs" name="warnDosage" id="warnDosage" size="30" placeholder="Warn Dosage" required>
		<br/><br/>

		<a class="formText" id="txtBottleId" name="txtBottleId">Bottle Id <font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="number" min="0" class="inputs" name="bottleId" id="bottleId" size="30" placeholder="Bottle Id" required>

		<?php
		echo"<input type=hidden name=hiddenUserName value=$userName>";
?>

<br/><br/>
		<input type="submit" style="float : right" class="commonButton" name="nextStep" id="nextStep" value="Submit" >
	</div>
	<div style="margin-top:770px">
	<?php
	include 'websiteFooter.php';
	 ?>
	</div>
</body>
</html>
<?php }
 ?>
