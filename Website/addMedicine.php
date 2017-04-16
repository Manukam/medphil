<!DOCTYPE>
<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">

</head>
<body>

	  	<?php
	  		include("headerUser.php");
				//session_start();
	  	?>

<div class="contentDiv" id="container" style="width:600px">
<form method="POST" name="careTakerSelectForm" action="AddMedicalConfig.php">
	<h1>Sign Up </h1>

<a>Be a part of our community</a>
<br/>
	<p><b> Please cofigure your medicine details</b></p>
	<img src="images/app.png" style="width:200px; margin-left:105px">
	<br/><br/>
		<a class="formText" id="txtuserName" name="userName"> UserName </a><br/>
		<?php
				include("dbConnect.php");
					$query="SELECT userName FROM patients WHERE userName = '$_SESSION[session1]'";
					$results=mysqli_query($con,$query);
					while( $rows=mysqli_fetch_array($results))
				 {
					 echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;";
					 echo"<input type=text id=txtName class=inputs name=userName value='$rows[userName]' size=30 readonly>";
				 		echo"<br/><br/>";
			 	}

		 ?>

	  <a class="formText" id="txtMedicineName" name="txtMedicineName"> Medicine Name<font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="text" class="inputs" name="medicineName" id="medicineName" size="30" placeholder="Medicine Name" required><br/><br/>
		<a class="formText" id="txtDoseageGap" name="txtDoseageGap">Doseage Gap <font color="red">*</font></a><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
		<input type="number" min="0" class="inputs" name="medicineDoseageGap" id="medicineDoseageGap" size="30" placeholder="Doseage Gap" required>
		<a class="formText" id="txtMin" name="txtMin">Minutes</a><br/><br/>
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

		<input type="submit" style="float : right" class="commonButton" name="nextStep" id="nextStep" value="Submit" >
	</div>
	<div style="margin-top:770px">
	<?php
	include 'websiteFooter.php';
	 ?>
	</div>
</body>
</html>
