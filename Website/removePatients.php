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

  <div class="contentDiv" id="container" style="width:430px; left:45%">
    <form method="POST" name="careTakerSelectForm" action="removePatientsAction.php">
      <h1>Sign Up </h1>

      <a>Be a part of our community</a>
      <br/>
      <p><b> Remove your patients</b></p>
      <a class="formText" id="txtuserName" name="userName"> UserName </a><br/>

      <?php
      //Retrieve username from database and lock text field
      include("dbConnect.php");
      $query="SELECT userName FROM doctors WHERE userName = '$_SESSION[session1]'";
      $results=mysqli_query($con,$query);
      while( $rows=mysqli_fetch_array($results))
      {
        echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;";
        echo"<input type=text id=txtName class=inputs name=userName value='$rows[userName]' size=30 readonly>";
        echo"<br/><br/>";
      }

      ?>
      <img src="images/patient-icon.png" style="width:200px;margin-left:80px">
      <br/><br/>
      <a class="formText" id="txtMedicineName" name="txtMedicineName">PatientList<font color="red">*</font></a><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <?php
      //Retrieve username from database and lock text field
      include("dbConnect.php");
      $query="SELECT patientUserName FROM patientdoctor WHERE doctorUserName = '$_SESSION[session1]'";
      $results=mysqli_query($con,$query);

      $counter=0;
      while($getList=mysqli_fetch_array($results)){
        $counter++;
      }
      if($counter>0){

        //echo"<select name=medicineNameChoices  class=inputs>";
        $query="SELECT  patientUserName FROM patientdoctor WHERE doctorUserName = '$_SESSION[session1]'";
        $results=mysqli_query($con,$query);
        while($getList=mysqli_fetch_array($results)){
          	echo"<br/>"."<input type=checkbox id=checkbox[] name=checkbox[] value=".$getList['patientUserName'].">".$getList['patientUserName']."<br/>";
        }
      }
      echo "<br>";
      echo"";
      ?>
      <br/>
      <br>
      <input type="submit" class="commonButton" value="Delete Details" name="delete" style="margin-top:20px; float:right">


    </body>
    </html>
