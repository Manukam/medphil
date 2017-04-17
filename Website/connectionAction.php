<?php
include("dbConnect.php");
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
$userName=$_POST["userName"];
$password=$_POST["password"];
$emailAddress=$_POST["email"];
?>



<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
	<link rel="stylesheet" type="text/CSS" href="style.CSS">
	<script type="text/javascript">
	/*change button link depending on which radio button is selected*/
		 function myFunction() {

        if(document.getElementById('radioRole1').checked) {
             window.location.assign("patientSignUp.php");
        }else if(document.getElementById('radioRole2').checked){
        	 window.location.assign("careTaker.php");
        }else{

        	 window.location.assign("doctorSignup.php");
        }
    }
	</script>
</head>
<body>


  	<?php
  		include("websiteHeader.php");
  	?>


<div class="contentDiv"  id="container" style="width:620px;height:600px;left:50%; margin-top:-150px; margin-left:-320px">

	<form method="POST" name="step2" action="connectionRoleAction.php">
		<h1>Sign Up </h1>

<a>Be a part of our community</a>
<br/>
		<p><b>Step 2: Choose your role</b></p>

		<img src="images/patient-icon.png" style="height:150px; margin-left:-10px;">
			<img src="images/careTaker-icon.png" style="height:150px; margin-left:35px;">
				<img src="images/doctor-icon.png" style="height:150px; margin-left:10px;">
				<br/>
				<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputs" name="radioRole" id="radioRole1" value="patient" checked>
		<a class="formText" id="formText">Patient </a>
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputs" name="radioRole" id="radioRole2" value="careTaker">
		<a class="formText" id="formText">CareTaker </a>
		<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio"  class="inputs" name="radioRole" id="radioRole3" value="doctor">
		<a class="formText" id="formText">Doctor </a>
		<br/>
		<br/>
		<?php
		echo"<input type=hidden name=hiddenFirstName value=$firstName>";
		echo"<input type=hidden name=hiddenLastName value=$lastName>";
		echo"<input type=hidden name=hiddenUserName value=$userName>";
		echo"<input type=hidden name=hiddenPassword value=$password>";
		echo"<input type=hidden name=hiddenEmail value=$emailAddress>";

		?>
		<input type="submit" class="commonButton" name="nextStep" id="nextStepBtn" value="Next step" style="float : right">



	</form>





</div>
<div style="margin-top:580px">
				<?php
				include'websiteFooter.php';
				 ?>
		</div>


</body>
</html>
