<?php
include("dbConnect.php");

$userName=$_POST["hiddenUserName"];
$hospital=$_POST["hospitalName"];
$hospitalAddress=$_POST["hospitalAddress"];
$telephoneNumber=$_POST["telephoneNumber"];
$visitingTime=$_POST["visitingHour"].''.$_POST["visitingMin"].''.$_POST['visitingSec'];
$query4="INSERT INTO  doctorhospital (doctorUserName,hospitalName,hospitalAddress,visitingTime,hospitalTelNo) VALUES ('$userName','$hospital','$hospitalAddress','$visitingTime','$telephoneNumber') ";
$result4=mysqli_query($con,$query4);
    if(!$result4){
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


    <form method="POST" name="step2" action="addMoreHospitals.php">
      <br/><br/>
      <img src="images/hospital.png" style="width:200px;margin-left:600px">
<h1> <center>Do you want to add more hospitals </center></h1>
<?php echo "<input type=hidden name=hiddenUserName value=$userName>";?>
<br/>

<br/>

<input type="submit" class="commonButton" name="commonButton" id="commonButton" value="addMoreHospitals" style="margin-left :500px;margin-top:-35px">
</form>
<form method="POST" name="step3" action="finalStepDoctor.php">
  <?php echo "<input type=hidden name=hiddenUserName value=$userName>";?>

  <input type="submit" class="commonButton" name="commonButton" id="commonButton" value="Continue" style="margin-left:550px;margin-top:-53px;margin-left:900px">



    </form>

</body>
</html>
<?php
}

?>
