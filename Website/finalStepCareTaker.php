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
$firstName = $_POST["hiddenFirstName"];
$lastName = $_POST["hiddenLastName"];
$userName=$_POST["hiddenUserName"];
$password=$_POST["hiddenPassword"];
$emailAddress=$_POST["hiddenEmail"];
?>
<?php
$mobileNo=$_POST["mobileNo"];
$careTakerAddress=$_POST["address"];
$query2="insert into caretakers (firstName,lastName,userName,password,email,	mobileNo,address)values('$firstName','$lastName','$userName','$password','$emailAddress','$mobileNo','$careTakerAddress')";
$result2=mysqli_query($con,$query2);
		if(!$result2){
			die(mysqli_error($con));
		}else{
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
