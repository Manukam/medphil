<html>
<head>
	<title><?php echo"$_GET[popupUser] "  ?></title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">
    <style>
table, th, td {
    border: 1px solid black;
    width: 900px;
}
</style>

</head>
<body>


<?php

include"dbConnect.php";

include("headerUser.php");
?>

<div class="container" style="width:70%;float:left">
  <br/><br/><br/>
  <center>
  <h1>Medical Details </h1>
</center>
<table>

  <tr>
   <th class="formText" name="MedicineName" id="MedicineName">MedicineName</th>
      <th class="formText" name="MedicineName" id="MedicineName">dosageGap</th>
      <th class="formText" name="MedicineName" id="MedicineName">Notify Iteration</th>
      <th class="formText" name="MedicineName" id="MedicineName">Warn Dosage</th>
      <th class="formText" name="MedicineName" id="MedicineName">Bottle Id</th>
  </tr>
<?php


//$query="SELECT * FROM patientmedicine WHERE patientUserName='$_GET[popupUser]''";
//$results=mysqli_query($con,$query);


  $query="SELECT * FROM patientmedicine WHERE patientUserName='$_GET[popupUser]'";
  $results=mysqli_query($con,$query);

  while($recentRow=mysqli_fetch_array($results)){

  //  echo "<a class=formText name=firstName id=firstName>medicineName  </a>";
echo"<tr>";
    echo"<td class=formText style='margin-left:49px'".$recentRow['medicineName'].">".$recentRow['medicineName']."</td>";
    echo"<td class=formText style='margin-left:49px'".$recentRow['dosageGap'].">".$recentRow['dosageGap']."</td>";
    echo"<td class=formText style='margin-left:49px'".$recentRow['notifyIterations'].">".$recentRow['notifyIterations']."</td>";
    echo"<td class=formText style='margin-left:49px'".$recentRow['warnDosage'].">".$recentRow['warnDosage']."</td>";
    echo"<td class=formText style='margin-left:49px'".$recentRow['bottleId'].">".$recentRow['bottleId']."</td>";

echo "</tr>";
  }

?>
</table>

<div class="container" style="width:70%; margin-top:95px; margin-left:120px">
  <center>
    <h1>
      Statistics
    </h1>
  </center>
  <table style="margin-left:-120px ;width:800px" >
    <tr>
      <th class="formText" name="MedicineName" id="MedicineName">MedicineName</th>
      <th class="formText" name="MedicineName" id="MedicineName">dosageTime</th>
      <th class="formText" name="MedicineName" id="MedicineName">doseageStatus</th>
    </tr>

    <!-- Senthu's code -->
    <?php
      include("dbConnect.php");

      /*Retrieve medicineName from patient table */

      $getMedicineNameQuery="SELECT medicineName,dosageTime,dosageStatus,	id FROM  patientdosage WHERE 	patientUserName='$_GET[popupUser]'";
      $resultLastRow=mysqli_query($con,  $getMedicineNameQuery);
      $resultBeforeRow=$resultLastRow;
      $fetchBeforeRow=mysqli_fetch_array($resultBeforeRow);

      $counter=0;

  while($fetchLastRow=mysqli_fetch_array($resultLastRow)){
    $counter++;

    if($counter>=1){
      echo"<tr>";
      echo "<td class=formText".   $fetchBeforeRow['medicineName'].">".   $fetchBeforeRow['medicineName']."</td>";
      echo "<td class=formText".   $fetchBeforeRow['dosageTime'].">".   $fetchBeforeRow['dosageTime']."</td>";
      echo "<td class=formText".   $fetchLastRow['dosageStatus'].">".   $fetchLastRow['dosageStatus']."</td>";
      echo "</tr>";

      // assigning the before fetch, as the last fetch
      $fetchBeforeRow = $fetchLastRow;
    }




  }
   ?>
   <!----------------------------------------------------------------------- -->
</table>
<br/>
<input type="button" class="commonButton" value="Back To My Profile" onclick="document.location.href='doctorHomePage.php'" style="margin-left:250px">;
</div>
</div>



<div class="container" style="width:30%; float :right">
<br/><br/>
  <center>
    <br/>
<h1><?php echo"$_GET[popupUser] "?> </h1>
<br/>
  <img src=images/frame.png  class=photo >
</center>
<br/>
<a class="formText" name="First Name" id="firstName">First Name </a>
<?php
  include("dbConnect.php");

  /*Retrieve First Name from patient table */

  $getFirstNameQuery="SELECT firstName FROM patients WHERE userName='$_GET[popupUser]'";
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
   $getLastNameQuery="SELECT lastName FROM patients WHERE userName='$_GET[popupUser]'";
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

    $getDOBQuery="SELECT dateOfBirth FROM patients WHERE userName='$_GET[popupUser]'";
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

     $getEmailQuery="SELECT email FROM patients WHERE userName='$_GET[popupUser]'";
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

      $getAddressQuery="SELECT patientAddress FROM patients WHERE userName='$_GET[popupUser]'";
      $resultAddress=mysqli_query($con,$getAddressQuery);

      while($recentAddressRow = mysqli_fetch_array($resultAddress))
      {
           echo"&nbsp;&nbsp;&nbsp;";
            echo"&nbsp;&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentAddressRow['patientAddress'].">".$recentAddressRow['patientAddress']."</a>";
      }
     ?>

     <br/><br/>
      <a class="formText" name="careTakerName" id="careTakerName">Doctors</a>
      <?php
        include("dbConnect.php");

          /*Retrieve DoctorsName from patientDoctor table table */
        $getDoctorQuery="SELECT doctorUserName FROM patientdoctor WHERE patientUserName='$_GET[popupUser]'";
        $resultDoctor=mysqli_query($con,$getDoctorQuery);

        while($recentDoctorRow = mysqli_fetch_array($resultDoctor))
        {
             echo"&nbsp;&nbsp;&nbsp;";
              echo"&nbsp;&nbsp;&nbsp;&nbsp;";
        echo"<a class=formText".$recentDoctorRow['doctorUserName'].">".$recentDoctorRow['doctorUserName'].","."</a>";
        }
       ?>


</div>


</body>
</html>
