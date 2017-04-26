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

<div class="contentDiv" id="container" style="width:470px; height:580px;left:45%">
<form method="POST" name="careTakerSelectForm" action="updateCaretakerAction.php">
	<h1>Sign Up </h1>

<a>Be a part of our community</a>
<br/>
	<p><b> Change your caretaker</b></p>
	<img src="images/caretaker-icon.png" style="height:150px; margin-left:100px;">
	<br/><br/>
	<?php
	?>

	<!-- text box to input care taker name -->
	<input class="inputs" id="txtCareTakers" type="text" onkeydown="loadCareTakers()" onpaste="loadCareTakers()" oninput="loadCareTakers()" onchange="loadCareTakers()">

	<!-- this div functions as the dropdown box -->
	<div id="dropDownDiv" class="dropDownDiv" style="box-shadow: 0px 0px 2px #888888;margin-top:4px">
	</div>

	<!-- submit button, and the hidden field to carry care taker name will appear in this div-->
	<div id="submitDiv">
	</div>



</form>
</div>
<div style="margin-top:520px">
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
		"<form method='POST' action='updateCaretakerAction.php'><input type='hidden' name='caretakerChoices' value='"+careTakerName+"'> <input class='commonButton' type='submit' value='Assign'> </form>";
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
  xhttp.open("POST", "updateCareTakerAJAX.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// key value pairs, that are sent through the post request
  xhttp.send("reqUsername="+reqUsername+"&fname=Henry&lname=Ford");
}
</script>

</body>
</html>
