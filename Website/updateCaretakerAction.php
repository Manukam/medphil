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
$selectedCareTaker=$_POST['caretakerChoices'];
//$userName=$_POST["hiddenUserName"];
$query="UPDATE  patientcaretaker SET caretakerUserName='$selectedCareTaker' WHERE patientUserName='$_SESSION[session1]'";
$result=mysqli_query($con,$query);
		if(!$result){
			die(mysqli_error($con));
		}else{
      echo "<br/>";
        echo "<br/>";
        echo "<br/>";
      //  echo"<h1 style=color:black>Hi '$userName'<h1/>";
          echo "<br/>";
      echo"<h1> Successfully Changed '$selectedCareTaker' to your site </h1>";
        echo "<br/>";
      echo"<input type=button class=commonButton style='margin-left:650px' value =Back onclick=document.location.href='patientHomePage.php'>";

    }
?>
