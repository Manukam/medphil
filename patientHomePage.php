<!DOCTYPE>
<html>
<head>
  <title>My Profile</title>
  <link rel="stylesheet" type="text/CSS" href="style.CSS">
  <style>
  table, th, td {
    border: 1px solid black;
    width: 900px;
  }
  </style>
</head>

</head>
<body>



 <?php
    include("headerUser.php");
	
    
  ?>
  
  
  
  
 


  <div class="container" style="width:70%;float:left">
    <br/>
    <center>
      <h1>
        My Medical Details
      </h1>
    </center>
    <table >
      <tr>
        <th class="formText" name="MedicineName" id="MedicineName">MedicineName</th>
        <th class="formText" name="MedicineName" id="MedicineName">dosageGap</th>
        <th class="formText" name="MedicineName" id="MedicineName">Notify Iteration</th>
        <th class="formText" name="MedicineName" id="MedicineName">Warn Dosage</th>
        <th class="formText" name="MedicineName" id="MedicineName">Bottle Id</th>

      </tr>
      <?php
      include("dbConnect.php");

      /*Retrieve medicineName from patient table */

      $getMedicineNameQuery="SELECT medicineName,dosageGap,notifyIterations,warnDosage,bottleId FROM  patientmedicine WHERE 	patientUserName='$_SESSION[session1]'";
      $resultFirstName=mysqli_query($con,  $getMedicineNameQuery);



      while($recentFirstNameRow = mysqli_fetch_array($resultFirstName))
      {
        //echo"&nbsp;&nbsp;&nbsp;";
        echo"<tr>";
        echo"<td class=formText".$recentFirstNameRow['medicineName'].">".$recentFirstNameRow['medicineName']."</td>";

        echo"<td class=formText".$recentFirstNameRow['dosageGap'].">".$recentFirstNameRow['dosageGap']."</td>";

        echo"<td class=formText".$recentFirstNameRow['notifyIterations'].">".$recentFirstNameRow['notifyIterations']."</td>";

        echo"<td class=formText".$recentFirstNameRow['warnDosage'].">".$recentFirstNameRow['warnDosage']."</td>";

        echo"<td class=formText".$recentFirstNameRow['bottleId'].">".$recentFirstNameRow['bottleId']."</td>";


        echo "</tr>";
      }
      ?>
    </table>
    <br/>
    <input type="button" class="commonButton" value="Add Medicine" onclick="location.href='addMedicine.php'" style="margin-left:380px;margin-top:-5px">
    <input type="button" class="commonButton" value="Delete Medical data" onclick="location.href='deleteMedicalDetails.php'" style="margin-left:75px; margin-top:-40px" >
    <input type="button" class="commonButton" value="Modify Medical data" onclick="location.href='modifyDetails.php'" style="margin-left:700px;margin-top:-30px">

    <div class="container" id="get data" style="width:70%; margin-top:125px; margin-left:120px">
      <center>
        <h1> My Stats</h1>
      </center>
      <table style="margin-left:-120px" >
        <tr>
          <th class="formText" name="MedicineName" id="MedicineName">MedicineName</th>
          <th class="formText" name="MedicineName" id="MedicineName">dosageTime</th>
          <th class="formText" name="MedicineName" id="MedicineName">doseageStatus</th>
          <!-- senthu : no need of id column. It's not bottle id. It's auto increment id -->
          <!-- <th class="formText" name="MedicineName" id="MedicineName">bottleId</th> -->

        </tr>
        
      </table>
    </div>
	<script type="text/javascript">
function dis(){

 xmlhttp= new XMLHttpRequest();
 xmlhttp.open("GET","select.php",false);
  xmlhttp.send(null);
  document.getElementById("get data").innerHTML=xmlhttp.responseText;
}
dis();

setInterval(function(){

dis();
},2000);
</script>
  </div>
  <div class="container" style="width:30%; float :right">

    <center>
      <br/>
      <h1>My Profile </h1>
      <br/>
      <img src=images/frame.png  class=photo >
    </center>
    <br/>
    <a class="formText" name="First Name" id="firstName">First Name </a>
    <?php
    include("dbConnect.php");

    /*Retrieve First Name from patient table */

    $getFirstNameQuery="SELECT firstName FROM patients WHERE userName='$_SESSION[session1]'";
    $resultFirstName=mysqli_query($con,$getFirstNameQuery);

    while($recentFirstNameRow = mysqli_fetch_array($resultFirstName))
    {
      echo"&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentFirstNameRow['firstName'].">".$recentFirstNameRow['firstName']."</a>";
    }
    ?>


    <br/><br/>
    <a class="formText" name="lastName" id="lastName">Last Name </a>
    <?php
    include("dbConnect.php");
    /*Retrieve Last Name from patient table */
    $getLastNameQuery="SELECT lastName FROM patients WHERE userName='$_SESSION[session1]'";
    $resultLastName=mysqli_query($con,$getLastNameQuery);

    while($recentLastNameRow = mysqli_fetch_array($resultLastName))
    {
      echo"&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentLastNameRow['lastName'].">".$recentLastNameRow['lastName']."</a>";
    }
    ?>

    <br/><br/>
    <a class="formText" name="dateOfBirth" id="dateOfBirth">DateOfBirth </a>
    <?php
    include("dbConnect.php");

    /*Retrieve DOB from patient table */

    $getDOBQuery="SELECT dateOfBirth FROM patients WHERE userName='$_SESSION[session1]'";
    $resultDOB=mysqli_query($con,$getDOBQuery);

    while($recentDOBRow = mysqli_fetch_array($resultDOB))
    {
      echo"<a class=formText".$recentDOBRow['dateOfBirth'].">".$recentDOBRow['dateOfBirth']."</a>";
    }
    ?>

    <br/><br/>
    <a class="formText" name="emailId" id="emailId">Email Id </a>
    <?php
    include("dbConnect.php");

    /*Retrieve First email from patient table */

    $getEmailQuery="SELECT email FROM patients WHERE userName='$_SESSION[session1]'";
    $resultEmail=mysqli_query($con,$getEmailQuery);

    while($recentEmailRow = mysqli_fetch_array($resultEmail))
    {
      echo"&nbsp;&nbsp;&nbsp;";
      echo"&nbsp;&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentEmailRow['email'].">".$recentEmailRow['email']."</a>";
    }
    ?>

    <br/><br/>
    <a class="formText" name="address" id="address">Address</a>
    <?php
    include("dbConnect.php");

    /*Retrieve Patient Address from patient table */

    $getAddressQuery="SELECT patientAddress FROM patients WHERE userName='$_SESSION[session1]'";
    $resultAddress=mysqli_query($con,$getAddressQuery);

    while($recentAddressRow = mysqli_fetch_array($resultAddress))
    {
      echo"&nbsp;&nbsp;&nbsp;";
      echo"&nbsp;&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentAddressRow['patientAddress'].">".$recentAddressRow['patientAddress']."</a>";
    }
    ?>

    <br/><br/>
    <a class="formText" name="careTakerName" id="careTakerName" >CareTaker</a>
    <?php
    include("dbConnect.php");

    /*Retrieve CareTakerName from patient Caretaker table table */
    $getCareTakerQuery="SELECT caretakerUserName FROM patientcaretaker WHERE patientUserName='$_SESSION[session1]'";
    $resultCareTaker=mysqli_query($con,$getCareTakerQuery);

    while($recentCareTakerRow = mysqli_fetch_array($resultCareTaker))
    {
      echo"&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentCareTakerRow['caretakerUserName'].">".$recentCareTakerRow['caretakerUserName']."</a>";
    }
    ?>

    <br/><br/>
    <a class="formText" name="careTakerName" id="careTakerName">Doctors</a>
    <?php
    include("dbConnect.php");

    /*Retrieve DoctorsName from patientDoctor table table */
    $getDoctorQuery="SELECT doctorUserName FROM patientdoctor WHERE patientUserName='$_SESSION[session1]'";
    $resultDoctor=mysqli_query($con,$getDoctorQuery);

    while($recentDoctorRow = mysqli_fetch_array($resultDoctor))
    {
      echo"&nbsp;&nbsp;&nbsp;";
      echo"&nbsp;&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentDoctorRow['doctorUserName'].">".$recentDoctorRow['doctorUserName'].","."</a>";
    }
    ?>

  </br></br>
  <?php
  echo"<input type=button class=commonButton name=updateCaretaker  value=updateCaretaker style='margin-left:75px' onclick=window.location='updateCaretaker.php';>";
  ?>

<!-- black overlay when popup notification is shown -->
<div id="black_overlay" class="black_overlay"></div>

</div>
<div style="margin-top:700px">
  <?php
  include("websiteFooter.php");
  ?>
</div>

</body>
</html>
