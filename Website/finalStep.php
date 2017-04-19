<?php
include("dbConnect.php");
$firstName = $_POST["hiddenFirstName"];
$lastName = $_POST["hiddenLastName"];
$userName=$_POST["hiddenUserName"];
$password=$_POST["hiddenPassword"];
$emailAddress=$_POST["hiddenEmail"];
?>
<?php
$dateOfBirth=$_POST["dateOfBirth"];
$patientAddress=$_POST["patientAddress"];

$query="insert into patients (firstName,lastName,userName,password,email,dateOfBirth,patientAddress)values('$firstName','$lastName','$userName','$password','$emailAddress','$dateOfBirth','$patientAddress')";
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

<div class="contentDiv" id="container" style="width:400px; height:530px;left:48%;margin-top:-150px">
<form method="POST" name="careTakerSelectForm" action="assignCareTaker.php">
	<h1>Sign Up </h1>

<a>Be a part of our community</a>
<br/>
	<p><b>Step 4: Please choose your caretaker</b></p>
	<img src="images/caretakerPic.png" alt="caretaker" style="margin-left:-50px">;
	<br/><br/>
	<?php
	// include("dbConnect.php");
	// $getCareTakerQuery="SELECT userName FROM  caretakers";
	// $resultsGetMyCareTakers = mysqli_query($con,$getCareTakerQuery);
	// $counter=0;
	// while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
	// 	$counter++;
	// }
	// if($counter>0){
	// 	echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;";
	// 	//echo "Caretaker's Name";
	// //	echo "&nbsp;&nbsp;&nbsp;";
	// 	echo"<select name=caretakerChoices  class=inputs style=width:150px placeholder=Caretakers>";
	// 	echo "<option class=inputs size=50   value=Caretakers>"."</option>";
	// 	$getMyCareTaker="SELECT userName From caretakers";
	// 	$resultsGetMyCareTakers = mysqli_query($con,$getMyCareTaker);
	// 	while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
	// 		echo"<option class=inputs size=50   value=".$getList['userName'].">".$getList['userName']."</option>";
	// 	}
	// 	echo "</select><br/><br/>";
			echo"<input type=hidden name=hiddenUserName value=$userName>";
	// 	echo "<input type=submit class=commonButton value=next style=float:right>";
	// }else{
	// 	// No orders for this customer
	// 		echo"<input type=text size=30 disabled value='We don't have any care givers></br>";
	// }

	?>

		<!-- text box to input care taker name -->
	<input class="inputs" id="txtCareTakers" type="text" onkeydown="loadCareTakers()" onpaste="loadCareTakers()" oninput="loadCareTakers()" onchange="loadCareTakers()">

<!-- <input type="hidden" name="hiddenUserName" value= "$userName"> -->

	<!-- this div functions as the dropdown box -->
	<div id="dropDownDiv" class="dropDownDiv" style="box-shadow: 0px 0px 2px #888888;margin-top:4px">
	</div>

	<!-- submit button, and the hidden field to carry care taker name will appear in this div-->
	<div id="submitDiv">
	</div>

</form>
</div>
<div style="margin-top:530px">
<?php
include 'websiteFooter.php';
 ?>
</div>

<script>
/** finalizes and sets care taker's name in the input text box
* careTakerName : finalized caretaker's name before setting into the database
*/
function setCareTaker(careTakerName){
	// replace the text field's value with the complete username, after clicking the appearing username
	document.getElementById("txtCareTakers").value = careTakerName;
	// drop down will no more be there
	document.getElementById("dropDownDiv").innerHTML="";
	// 'Assign' button will appear
	// hidden input field for carrying the username through POST request
	document.getElementById("submitDiv").innerHTML=
		"<form method='POST' action='assignCareTaker.php'><input type='hidden' name='caretakerChoices' value='"+careTakerName+"'> <input class='commonButton' type='submit' value='Assign'> </form>";
}

// searches and shows caretakers with matching string that is input, in dropdown
function loadCareTakers() {
	// acquire typed string
	var reqUsername = document.getElementById('txtCareTakers').value;

	// clear the dropdown - this is necessary when anything is erased
	document.getElementById("dropDownDiv").innerHTML = "";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // show response taken results (usernames)
			// **** suggestion : show Full name, alongwith the username. It'll look nice
			document.getElementById("dropDownDiv").innerHTML = this.responseText;
    }
  };
	// post request, file - to where the request is sent
  xhttp.open("POST", "assignCareTakerAJAX.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// key value pairs, that are sent through the post request
  xhttp.send("reqUsername="+reqUsername+"&fname=Henry&lname=Ford");
}
</script>
</body>
</html>

<?php
		}

?>
