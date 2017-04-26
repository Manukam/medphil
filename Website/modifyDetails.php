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

    <div class="contentDiv" id="container" style="width:400px; height:600px;left:48%">
    <form method="POST" name="careTakerSelectForm" action="modifyMedicalData.php">
      <h1>Sign Up </h1>

      <a>Be a part of our community</a>
      <br/>
      <p><b> Please cofigure your medicine details</b></p>
      <img src="images/tablets-icon.png" style="margin-left:-50px">
    	<br/><br/>
      <a class="formText" id="txtuserName" name="userName"> UserName </a><br/>

      <?php
      //Retrieve username from database and lock text field
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
      //Retrieve username from database and lock text field
      include("dbConnect.php");
      $query="SELECT medicineName FROM patientmedicine WHERE patientUserName = '$_SESSION[session1]'";
      $results=mysqli_query($con,$query);

      $counter=0;
      while($getList=mysqli_fetch_array($results)){
        $counter++;
      }
      if($counter>0){

        echo"<select name=medicineNameChoices  class=inputs style=width:90px>";
        $query="SELECT medicineName FROM patientmedicine WHERE patientUserName = '$_SESSION[session1]'";
        $results=mysqli_query($con,$query);
        while($getList=mysqli_fetch_array($results)){
          echo"<option class=inputs size=30 value=".$getList['medicineName'].">".$getList['medicineName']."</option>";
        }
      }
      echo "<br>";
      echo"";
      ?>
      <br/>
      <br/> <br/><br/>
      <input type="submit" class="commonButton" value="Modify Details" style="margin-top:20px; float:right" >
</div>
<div style="margin-top:550px">
<?php
include 'websiteFooter.php';
 ?>
</div>


    </body>
    </html>
