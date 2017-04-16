
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
           <a class="formText" name="txtHospitalName" id="txtHospitalName">Hospital Name<font color="red">*</font></a><br/>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
           <input type="text" class="inputs" name="hospitalName" id="hospitalName" size="30" required><br/><br/>
   				<a class="formText" name="txtHospitalAddress" id="txtHospitalAddress">Hospital Address<font color="red">*</font></a><br/>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
           <input type="text" class="inputs" name="hospitalAddress" id="hospitalAddress" size="30" required ><br/><br/>
           <a class="formText" name="txtTelephoneNumber" id="txtTelephoneNumber">Telephone Number<font color="red">*</font></a><br/>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
           <input type="number" min="0" class="inputs" name="telephoneNumber" id="telephoneNumber" size="30" required><br/><br/>
   				<a class="formText" id="txtVisitingTime" name="txtVisitingTime" >Visting Time <font color="red">*</font></a><br/>
   				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
   				<input type="number" min="0" max=24 class="inputs" name="visitingHour" id="visitingHour" size="30" placeholder="HH" required>
   		<font color="red">:</font></a>
   		&nbsp;&nbsp;
   		<input type="number" min="0" max=60 class="inputs" name="visitingMin" id="visitingMin" size="30" placeholder="MM" required >
      <font color="red">:</font></a>
      &nbsp;&nbsp;
      <input type="number" min="0" max=60 class="inputs" name="visitingSec" id="visitingSec" size="30" placeholder="SS" required >
   				<br/><br/>
          <?php echo "<input type=hidden name=hiddenUserName value=$userName>"?>;
           <input type="submit" class="commonButton" name="signUpBtn" id="signUpBtn" value="submit" style="float:right" >
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
