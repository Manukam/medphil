<?php
include("dbConnect.php");
//session_start();
$medicineName=$_POST['medicineNameChoices'];

?>

<!DOCTYPE>
<html>
<head>
  <title>Sign-up</title>
  <link rel="stylesheet" type="text/CSS" href="style.CSS">

</head>
<body>

  <?php
  include("headerUser.php");
//  session_start();
  ?>

  <div class="contentDiv" id="container" style="width:600px">
    <form method="POST" name="careTakerSelectForm" action="modifyMedicalDataAction.php">
      <h1>Sign Up </h1>

      <a>Be a part of our community</a>
      <br/>
      <p><b> Please cofigure your medicine details</b></p>
      <img src="images/app.png" style="width:200px; margin-left:105px">
      <br/><br/>
      <a class="formText" id="txtuserName" name="userName"> UserName </a><br/>
      <?php
      include("dbConnect.php");
      $query="SELECT userName FROM patients WHERE userName = '$_SESSION[session1]'";
      $results=mysqli_query($con,$query);
      while( $rows=mysqli_fetch_array($results))
      {
        echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;";
        echo"<input type=text id=txtName class=inputs name=userName value='$rows[userName]' size=30 readonly>";
        echo"<br/><br/>";
      }

      ?>

      <a class="formText" id="txtMedicineName" name="txtMedicineName"> Medicine Name<font color="red">*</font></a><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <?php
      include("dbConnect.php");
      $query="SELECT medicineName FROM patients WHERE medicineName = '$medicineName'";
      $results=mysqli_query($con,$query);
      echo"<input type=text id=txtName class=inputs name=medicineName value='$medicineName' size=30 readonly>";
      echo"<br/><br/>";


      ?>
      <a class="formText" id="txtDoseageGap" name="txtDoseageGap">Doseage Gap <font color="red">*</font></a><br/>
      <?php
      include("dbConnect.php");
      $query="SELECT dosageGap FROM patientmedicine WHERE medicineName = '$medicineName' AND patientUserName = '$_SESSION[session1]' ";
      $results=mysqli_query($con,$query);
      while( $rows=mysqli_fetch_array($results))
      {
        echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;";
        echo"<input type=number min=0 id=txtName class=inputs name=dosageGap value='$rows[dosageGap]' size=30 >";

      }


      ?>
      <a class="formText" id="txtMin" name="txtMin">Minutes</a><br/><br/>
      <a class="formText" id="txtNotifyIteration" name="txtNotifyIteration">How many times to give bottle notification <font color="red">*</font></a><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <?php
      include("dbConnect.php");
      $query="SELECT 	notifyIterations FROM patientmedicine WHERE medicineName = '$medicineName' AND patientUserName = '$_SESSION[session1]' ";
      $results=mysqli_query($con,$query);
      while( $rows=mysqli_fetch_array($results))
      {

        echo"<input type=number min=0 id=notifyItreration class=inputs name=notifyItreration value='$rows[notifyIterations]' size=30 >";

      }
      ?>
      <br/><br/>
      <a class="formText" id="txtWarnDosage" name="txtWarnDosage">Warn Dosage <font color="red">*</font></a><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <?php
      include("dbConnect.php");
      $query="SELECT warnDosage FROM patientmedicine WHERE medicineName = '$medicineName' AND patientUserName = '$_SESSION[session1]' ";
      $results=mysqli_query($con,$query);
      while( $rows=mysqli_fetch_array($results))
      {

        echo"<input type=number min=0 id=warnDosage class=inputs name=warnDosage value='$rows[warnDosage]' size=30 >";

      }
      ?>
         <br/><br/>
<a class="formText" id="txtBottleId" name="txtBottleId">Bottle Id <font color="red">*</font></a><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <?php
      include("dbConnect.php");
      $query="SELECT bottleId FROM patientmedicine WHERE medicineName = '$medicineName' AND patientUserName = '$_SESSION[session1]' ";
      $results=mysqli_query($con,$query);
      while( $rows=mysqli_fetch_array($results))
      {

        echo"<input type=number min=0 id=bottleId class=inputs name=bottleId value='$rows[bottleId]' size=30 >";

      }
      ?>
<br/><br/>
            <input type="submit"  class="commonButton"  value="Submit" style="margin-top:50px; float:right" >
          </div>
          <div style="margin-top:870px">
          <?php
          include 'websiteFooter.php';
           ?>
          </div>

    </body>
    </html>
