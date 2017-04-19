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
<script>
//Fuction to display pop up
function myFuntion(userName){
    var c;

    // pass as a get request
    document.location=("patientStats.php?popupUser="+userName);
    //document.location=("index.php");
}



</script>

</head>
<body>
  <?php
		include("headerUser.php");

    // creating for getting the current username for popup
    $popupUser;
    //session_start();
	?>
  <br/><br/>
  <div class="container" style="width:70%;float:left">
    <br/>
    <center>
    <h1>
      My Patients
    </h1>
  </center>
  <!--php code starts-->
  <?php
  //make connection with database
  include("dbConnect.php");

  // Query to select patient's username form patientcaretaker table
  $getPatientUserName="SELECT patientUserName FROM patientdoctor WHERE doctorUserName='$_SESSION[session1]'";

  $result=mysqli_query($con,$getPatientUserName);

  $counter=0;

  //iterate patientcaretaker table and get that particular caretaker's patients
  while($patientRow=mysqli_fetch_array($result)){

    //increase counter by one in every iteration
    $counter++;

    //print patient's userName
    echo"<br/> <a class=formText name=userName style='margin-left:100px'".$patientRow['patientUserName'].">".$patientRow['patientUserName']."<a/><br/>";
    //echo"<input type=hidden name=hiddenUserName value='".$patientRow['patientUserName']."'>";
    ?>

    <!-- display image -->
    <img src=images/frame.png class="photo" style="margin-left:80px" >;


    <!--create popup window-->
    <div id="fade"></div>

    <div id="mailSummary" class="shoppingCartProductSummaryPopup" >

      <br/>
      <div class="mailpopupDetails" id="mailPopup">
        <h1>Patient's Medical Details</h1>
        <?php
        //include("dbConnect.php");
        //$query="SELECT * FROM patientmedicine WHERE patientUserName='$patientRow[patientUserName]'";
        $query="SELECT * FROM patientmedicine WHERE patientUserName='$popupUser'";
        $results=mysqli_query($con,$query);

      //  $counter=0;
        // while($recentRow=mysqli_fetch_array($results)){
        //   $counter++;
        // }

        if($counter>0){
          // patientUserName='$patientRow[patientUserName]'
          $query="SELECT * FROM patientmedicine WHERE patientUserName='$popupUser'";
          $results=mysqli_query($con,$query);

          while($recentRow=mysqli_fetch_array($results)){
                      }
        }else{
          //echo "No Medicine";
        }
        //  $counter=0;


        ?>
      </div >
        </div>





    <!--new div to diplay patient's details-->
    <div class="container" style="width:70%; margin-top:-125px; margin-left:350px">

      <!--php code to retrieve data form database and display their personal details-->

      <?php
      echo"<br/>";
      //query to select patients personal details from patients table

      $details="SELECT firstName,lastName,dateOfBirth FROM patients WHERE userName='$patientRow[patientUserName]'";
      $results=mysqli_query($con,$details);

?>




<?php



      while($recentRow=mysqli_fetch_array($results)){

        //first name
        echo "<a class=formText name=firstName id=firstName>First Name  </a>";

        echo"<a class=formText style='margin-left:49px'".$recentRow['firstName'].">".$recentRow['firstName']."<a/><br/>";

        //Last name

        echo "<a class=formText name=lastName id=lastName>Last Name  </a>";

        echo"<a class=formText style='margin-left:49px'".$recentRow['lastName'].">".$recentRow['lastName']."<a/><br/>";

        //Date of birth

        echo "<a class=formText name=firstName id=firstName>Date Of Birth  </a>";
        echo"<a class=formText".$recentRow['dateOfBirth'].">".$recentRow['dateOfBirth']."<a/><br/><br/>";
?>

<?php
        //create submit button (check profile)
        echo"<input type=button class=commonButton name=checkProfile  value=CheckProfile style='margin-left:75px' onclick=myFuntion('".$patientRow['patientUserName']."');>";

        echo "<br/>";


      }

      echo"</div>";
      echo "<br/>";
      echo "<br/>";
    }


    echo "</form>";
    ?>



  </div>




  </div>






  <!--RIGHT SIGHT DIV-->
  <div class="container" style="width:30%; float :right">

    <center>
      <br/>
  <h1>My Profile </h1>
<br/>
    <img src=images/frame.png  class=photo >
  </center>
  <br/><br/>
  <a class="formText" name="First Name" id="firstName">First Name </a>
  <?php
    include("dbConnect.php");

    /*Retrieve First Name from patient table */

    $getFirstNameQuery="SELECT firstName FROM doctors WHERE userName='$_SESSION[session1]'";
    $resultFirstName=mysqli_query($con,$getFirstNameQuery);

    while($recentFirstNameRow = mysqli_fetch_array($resultFirstName))
    {
         echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo"<a class=formText".$recentFirstNameRow['firstName'].">".$recentFirstNameRow['firstName']."</a>";
    }
   ?>


   <br/><br/>
   <a class="formText" name="lastName" id="lastName">Last Name </a>
   <?php
     include("dbConnect.php");
       /*Retrieve Last Name from patient table */
     $getLastNameQuery="SELECT lastName FROM doctors WHERE userName='$_SESSION[session1]'";
     $resultLastName=mysqli_query($con,$getLastNameQuery);

     while($recentLastNameRow = mysqli_fetch_array($resultLastName))
     {
         echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
     echo"<a class=formText".$recentLastNameRow['lastName'].">".$recentLastNameRow['lastName']."</a>";
     }
    ?>
    <br/><br/>
    <a class="formText" name="position" id="position">Position </a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="formText" name="position" id="position">Doctor </a>

    <br/><br/>
    <a class="formText" name="hospital" id="hospital">Hospital </a>
    <?php
      include("dbConnect.php");

        /*Retrieve DOB from patient table */

      $getDOBQuery="SELECT hospital FROM doctors WHERE userName='$_SESSION[session1]'";
      $resultDOB=mysqli_query($con,$getDOBQuery);

      while($recentDOBRow = mysqli_fetch_array($resultDOB))
      {
         echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      echo"<a class=formText".$recentDOBRow['hospital'].">".$recentDOBRow['hospital']."</a>";
      }
     ?>

     <br/><br/>
     <a class="formText" name="emailId" id="emailId">Email Id </a>
     <?php
       include("dbConnect.php");

         /*Retrieve First email from patient table */

       $getEmailQuery="SELECT email FROM doctors WHERE userName='$_SESSION[session1]'";
       $resultEmail=mysqli_query($con,$getEmailQuery);

       while($recentEmailRow = mysqli_fetch_array($resultEmail))
       {
            echo"&nbsp;&nbsp;&nbsp;";
               echo"&nbsp;&nbsp;&nbsp;&nbsp;";
                  echo"&nbsp;&nbsp;&nbsp;&nbsp;";
       echo"<a class=formText".$recentEmailRow['email'].">".$recentEmailRow['email']."</a>";
       }
      ?>

      <br/><br/>
      <a class="formText" name="area" id="area">Specialized Area</a>
      <?php
        include("dbConnect.php");

          /*Retrieve Patient Address from patient table */

        $getAddressQuery="SELECT specializedArea FROM doctors WHERE userName='$_SESSION[session1]'";
        $resultAddress=mysqli_query($con,$getAddressQuery);

        while($recentAddressRow = mysqli_fetch_array($resultAddress))
        {
             //echo"&nbsp;&nbsp;&nbsp;";
              //echo"&nbsp;&nbsp;&nbsp;&nbsp;";
        echo"<a class=formText".$recentAddressRow['specializedArea'].">".$recentAddressRow['specializedArea']."</a>";
        }
       ?>

       <br/><br/>
       <a class="formText" name="telephoneNumber" id="telephoneNumber" >Telephone No</a>
       <?php
         include("dbConnect.php");

           /*Retrieve CareTakerName from patient Caretaker table table */
         $getCareTakerQuery="SELECT telephoneNumber FROM doctors WHERE userName='$_SESSION[session1]'";
         $resultCareTaker=mysqli_query($con,$getCareTakerQuery);

         while($recentCareTakerRow = mysqli_fetch_array($resultCareTaker))
         {
            echo"&nbsp;&nbsp;&nbsp;";
         echo"<a class=formText".$recentCareTakerRow['telephoneNumber'].">".$recentCareTakerRow['telephoneNumber']."</a>";
         }
        ?>

        <br/><br/>
<?php
  echo"<input type=button class=commonButton name=addPatients  value=AddPatients style='margin-left:35px' onclick=window.location='assignMorePatients.php';>";
    echo"<input type=button class=commonButton name=removePatients  value=RemovePatients style='margin-left:175px; margin-top:-38px' onclick=window.location='removePatients.php';>";
?>

  </div>
<div style="margin-top:1000px">
		<?php
		include("websiteFooter.php");
		 ?>
</div
</body>
</html>
