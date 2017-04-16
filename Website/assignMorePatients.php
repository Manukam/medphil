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
  <div class="contentDiv" id="container" style="width:450px;margin-left:-65px">
  <form method="POST" name="careTakerSelectForm" action="assignMorePatientsAction.php">
    <h1>Sign Up </h1>

  <a>Be a part of our community</a>
  <br/>
    <p><b>Step 4: Please choose your patients</b></p>
    <img src="images/patient-icon.png" style="width:200px;margin-left:80px">
    <br/><br/>
    <a class="formText" id="txtuserName" name="userName"> Doctor's UserName </a><br/>
    <?php
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
    <?php
    include("dbConnect.php");
    //$getCareTakerQuery="SELECT userName FROM  patients LEFT OUTER JOIN patientdoctor ON patients.userName = patientdoctor.patientUserName
    //UNION
    //SELECT userName FROM  patients RIGHT OUTER JOIN patientdoctor ON patients.userName = patientdoctor.patientUserName
  //  ";
  $getCareTakerQuery= "SELECT userName FROM patients WHERE patients.userName NOT IN (SELECT patientUserName FROM patientdoctor)";
    $resultsGetMyCareTakers = mysqli_query($con,$getCareTakerQuery);
    $counter=0;
    while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
      $counter++;
    }
    if($counter>0){

      $getMyCareTaker="SELECT userName FROM patients WHERE patients.userName NOT IN (SELECT patientUserName FROM patientdoctor)";
      $resultsGetMyCareTakers = mysqli_query($con,$getMyCareTaker);
      while($getList=mysqli_fetch_array($resultsGetMyCareTakers)){
        echo"<br/>"."<input type=checkbox name=patients[] value=".$getList['userName'].">".$getList['userName']."<br/>";
      }
      echo "<br/><br/>";
      //  echo"<input type=hidden name=hiddenUserName value=$userName>";
      echo "<input type=submit class=commonButton value=submit style=float:right>";
    }else{
      // No orders for this customer
        echo"<input type=text size=30 disabled value='We don't have any care givers></br>";
    }

    ?>
  </form>
  </div>

</body>

</html>
