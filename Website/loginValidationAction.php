<?php
session_start();
echo "<link rel=stylesheet type=text/css href=Style.css>";

/*Establish connection to the data base*/
include("dbConnect.php");

/* Getting data from form*/
$userName=$_POST["userName"];
$password=$_POST["password"];

/*Selection query for for patients table*/
$patientSelectionQuery="SELECT userName,password FROM patients WHERE userName='$userName'";

/*Selection query for for caretakers table*/
$careTakerSelectionQuery="SELECT userName,password FROM caretakers WHERE userName='$userName'";

/*Selection query for for doctors table*/
$doctorSelectionQuery="SELECT userName,password FROM doctors WHERE userName='$userName'";

//Execute query
$executePatientQuery = mysqli_query($con,$patientSelectionQuery);
$patientRow = mysqli_fetch_array($executePatientQuery);


$executeCaretakerQuery = mysqli_query($con,$careTakerSelectionQuery);
$careTakerRow = mysqli_fetch_array($executeCaretakerQuery);


$executeDoctorQuery = mysqli_query($con,$doctorSelectionQuery);
$doctorRow = mysqli_fetch_array($executeDoctorQuery);


if($patientRow['userName']==$userName){
	if($patientRow['password']==$password){
		if(!($userName==" " || $password==" ")){
			$_SESSION["session1"] = $userName;
			header("LOCATION:patientHomePage.php");
		}else{
			header("Location:loginError.php");
		}
	}else{
		header("Location:loginError.php");

	}
}else if($careTakerRow['userName']==$userName){
	if ($careTakerRow['password']==$password) {
		if(!($userName==" "|| $password==" ")){
			$_SESSION["session1"] = $userName;
			header("LOCATION:caretakerHomePage.php");
		}else{
			header("Location:loginError.php");
		}

	}else{
		header("Location:loginError.php");
	}

}else if($doctorRow['userName']==$userName){
	if($doctorRow['password']==$password){
		if(!($userName==" "|| $password==" ")){
			$_SESSION["session1"] = $userName;
			header("LOCATION:doctorHomePage.php");
		}else{
			header("Location:loginError.php");
		}

	}else{
		header("Location:loginError.php");
	}
}else{
	header("Location:loginErrorNoUser.php");
}

// CLosing the connection
mysqli_close($con);
?>
