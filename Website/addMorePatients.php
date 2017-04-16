	<?php
		$userName=$_POST["hiddenUserName"];

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
					  <div class="contentDiv" id="container" style="width:450px">
					  <form method="POST" name="careTakerSelectForm" action="assignDoctor.php">
							<h1>Sign Up </h1>

						<a>Be a part of our community</a>
						<br/>
							<p><b>Step 4: Please choose your patients</b></p>
							<img src="images/doctor-icon.png" style="height:150px; margin-left:100px;">
						 <br/><br/>
					  	<?php
					  	// include("dbConnect.php");
					  	// $getCareTakerQuery="SELECT userName FROM  patients";
					  	// $resultsGetMyCareTakers = mysqli_query($con,$getCareTakerQuery);
					  	// $counter=0;
					  	// while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
					  	// 	$counter++;
					  	// }
					  	// if($counter>0){
							//
					  	// 	$getMyCareTaker="SELECT userName From patients";
					  	// 	$resultsGetMyCareTakers = mysqli_query($con,$getMyCareTaker);
					  	// 	while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
					  	// 		echo"<br/>"."<input type=checkbox name=patients[] value=".$getList['userName'].">".$getList['userName']."<br/>";
					  	// 	}
					  	// 	echo "<br/><br/>";
							// 		echo"<input type=hidden name=hiddenUserName value=$userName>";
					  	// 	echo "<input type=submit class=commonButton value=submit style=float:right>";
					  	// }else{
					  	// 	// No orders for this customer
					  	// 		echo"<input type=text size=30 disabled value='We don't have any care givers></br>";
					  	// }

							echo"<input type=hidden name=hiddenUserName value=$userName>";
					  	?>
							<!-- text box to input care taker name -->
						<input class="inputs" id="txtpatients" name="patients" type="text" onkeydown="loadPatients()" onpaste="loadPatients()" oninput="loadPatients()" onchange="loadPatients()">

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
						* patientName : finalized patient's name before setting into the database
						*/
						function setPatient(patientName){
							// replace the text field's value with the complete username, after clicking the appearing username
							document.getElementById("txtpatients").value = patientName;
							// drop down will no more be there
							document.getElementById("dropDownDiv").innerHTML="";
							// 'Assign' button will appear
							// hidden input field for carrying the username through POST request
							document.getElementById("submitDiv").innerHTML=
								"<form method='POST' action='assignDoctor.php'><input type='hidden' name='caretakerChoices' value='"+patientName+"'> <input class='commonButton' type='submit' value='Assign'> </form>";
						}

						// searches and shows caretakers with matching string that is input, in dropdown
						function loadPatients() {
							// acquire typed string
							var reqUsername = document.getElementById('txtpatients').value;

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
							xhttp.open("POST", "finalStepDoctorAjax.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							// key value pairs, that are sent through the post request
							xhttp.send("reqUsername="+reqUsername+"&fname=Henry&lname=Ford");
						}
						</script>
					</body>

					</html>
