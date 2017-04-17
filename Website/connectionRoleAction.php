<?php
//include("dbConnect.php");
$firstName = $_POST["hiddenFirstName"];
$lastName = $_POST["hiddenLastName"];
$userName=$_POST["hiddenUserName"];
$password=$_POST["hiddenPassword"];
$emailAddress=$_POST["hiddenEmail"];
?>
<?php
$role=$_POST['radioRole'];
	if($role=="patient"){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">

</head>
<body>
	<?php
		include("websiteHeader.php");
	?>
   <div class="contentDiv"  id="container" style="width:470px;height:630px;left:45%">

    <form method="POST" name="step2" action="finalStep.php">
			<h1>Sign Up </h1>

	<a>Be a part of our community</a>
	<br/>
			<p><b>Step 3: Insert your personal details</b></p>
			<img src="images/patient-icon.png" style="height:150px; margin-left:100px;">
			<br/><br/>
        <a class="formText" name="txtDateOfBirth" id="txtDateOfBirth">Date of Birth <font color="red">*</font></a><br/><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="date" name="dateOfBirth" id="dateOfBirth"  class="inputs"><br/><br/>
        <a class="formText" name="txtPatientAddress" id="txtPatientAddress">Address<font color="red">*</font></a><br/><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="textarea" name="patientAddress"  class="inputs" id="patientAddress" size="30" required><br/><br/>

        <?php
		echo"<input type=hidden name=hiddenFirstName value=$firstName>";
		echo"<input type=hidden name=hiddenLastName value=$lastName>";
		echo"<input type=hidden name=hiddenUserName value=$userName>";
		echo"<input type=hidden name=hiddenPassword value=$password>";
		echo"<input type=hidden name=hiddenEmail value=$emailAddress>";
		?>
        <input type="submit" class="commonButton" name="signUpBtn" id="signUpBtn" value="next" style="float : right">

    </form>




</div>
<div style="margin-top:580px">
<?php
include 'websiteFooter.php';
 ?>
</div>


</body>
</html>



	<?php
		}
else if($role=="careTaker"){
?>
<?php

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">
</head>
<body>
	<?php
		include("websiteHeader.php");
	?>
   <div class="contentDiv"  id="container" style="width:450px;height:650px;left:50%">

    <form method="POST" name="step2" action="finalStepCareTaker.php">
			<h1>Sign Up </h1>

	<a>Be a part of our community</a>
	<br/>
			<p><b>Step 3: Insert your personal details</b></p>
			<img src="images/caretaker-icon.png" style="height:150px; margin-left:100px;">
			<br/><br/>
        <a class="formText" name="txtMobileNo" id="txtMobileNo">Mobile No <font color="red">*</font></a><br/><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="number" min="0" class="inputs" name="mobileNo" id="mobileNo" size="30" required><br/><br/>
        <a class="formText" name="txtAddress" id="txtAddress">Address<font color="red">*</font></a><br/><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="text" class="inputs"name="address" id="address" size="30" required><br/><br/>
        <?php
		echo"<input type=hidden name=hiddenFirstName value=$firstName>";
		echo"<input type=hidden name=hiddenLastName value=$lastName>";
		echo"<input type=hidden name=hiddenUserName value=$userName>";
		echo"<input type=hidden name=hiddenPassword value=$password>";
		echo"<input type=hidden name=hiddenEmail value=$emailAddress>";
		?>

        <input type="submit" class="commonButton" name="signUpBtn" id="signUpBtn" value="Signup" style="float:right"  >

        <input type="button" class="commonButton" name="resetBtn" id="resetBtn" value="Reset"  onclick="location.href = 'index.php';" >
    </form>




</div>
<div style="margin-top:580px">
<?php
include 'websiteFooter.php';
 ?>
</div>

</body>
</html>
<?php
}

else{


?>

<?php
include("dbConnect.php");
$firstName = $_POST["hiddenFirstName"];
$lastName = $_POST["hiddenLastName"];
$userName=$_POST["hiddenUserName"];
$password=$_POST["hiddenPassword"];
$emailAddress=$_POST["hiddenEmail"];
$query3="insert into doctors (firstName,lastName,userName,password,email)values('$firstName','$lastName','$userName','$password','$emailAddress')";
$result3=mysqli_query($con,$query3);
		if(!$result3){
			die(mysqli_error($con));
		}else{

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">

</head>
<body>
	<?php
		include("websiteHeader.php");
	?>
   <div class="contentDiv"  id="container" style="width:450px;height:800px;left:45%">

    <form method="POST" name="step2" action="hospitalConfirmation.php">
			<h1>Sign Up </h1>

	<a>Be a part of our community</a>
	<br/>
			<p><b>Step 3: Insert your professional details</b></p>
			<img src="images/doctor-icon.png" style="height:150px; margin-left:100px;">
 		 <br/><br/>
        <a class="formText" name="txtHospital" id="txtHospital">Doctors Name <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <?php echo"<input type=text class=inputs name=hospital id=hospital size=30  value='$userName' readonly>"?><br/><br/>
        <a class="formText" name="txtHospitalName" id="txtHospitalName">Hospital Name</a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="text" class="inputs" name="hospitalName" id="hospitalName" size="30"><br/><br/>
				<a class="formText" name="txtHospitalAddress" id="txtHospitalAddress">Hospital Address<font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="text" class="inputs" name="hospitalAddress" id="hospitalAddress" size="30" required><br/><br/>
        <a class="formText" name="txtTelephoneNumber" id="txtTelephoneNumber">Telephone Number<font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="number" min="0" class="inputs" name="telephoneNumber" id="telephoneNumber" size="30" required><br/><br/>
				<a class="formText" id="txtVisitingTime" name="txtVisitingTime">Visting Time <font color="red">*</font></a><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
				<input type="number" min="0" max=24 class="inputs" name="visitingHour" id="visitingHour" size="30" placeholder="HH" required>
		<font color="red">:</font></a>
		&nbsp;&nbsp;
		<input type="number" min="0" max=60 class="inputs" name="visitingMin" id="visitingMin" size="30" placeholder="MM" required>
			<font color="red">:</font></a>
		&nbsp;&nbsp;
		<input type="number" min="0" max=60 class="inputs" name="visitingSec" id="visitingSec" size="30" placeholder="SS" required>
				<br/><br/>
         <?php
		echo"<input type=hidden name=hiddenFirstName value=$firstName>";
		echo"<input type=hidden name=hiddenLastName value=$lastName>";
		echo"<input type=hidden name=hiddenUserName value=$userName>";
		echo"<input type=hidden name=hiddenPassword value=$password>";
		echo"<input type=hidden name=hiddenEmail value=$emailAddress>";
		?>
        <input type="submit" class="commonButton" name="signUpBtn" id="signUpBtn" value="Signup" style="float:right" >

    </form>




</div>

<!-- footer -->

<div style="margin-top:580px">
<?php
include 'websiteFooter.php';
 ?>
</div>


</body>
</html>

<?php
}
}
?>
<?php
	// CLosing the connection
	//mysqli_close($con);



?>
