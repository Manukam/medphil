<?php
//grab username from hidden field using post method
$userName = $_GET["doctorUsername"];
@$addMore = $_GET["addMore"];

?>
<!DOCTYPE>
<html>
<head>
    <title>Sign-up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>
    <script>
        // initialize Firebase
        var config = {
            apiKey: "AIzaSyCmvzi-bgRE_gsPxwKc2iHiMCuRxtCliYg",
            authDomain: "medphil-ffa76.firebaseapp.com",
            databaseURL: "https://medphil-ffa76.firebaseio.com",
            projectId: "medphil-ffa76",
            storageBucket: "medphil-ffa76.appspot.com",
            messagingSenderId: "706075479090"
        };

        // initialize and load app
        firebase.initializeApp(config);

        // load db
        var db = firebase.database();

        // FUNCTIONS /////////////////////////////////////////////////////////////////////////////

        // returns full visiting time by combining hh mm
        function getVisitingTime() {

            var hh = document.getElementById('visitingHour').value;
            var mm = document.getElementById('visitingMin').value;

            return hh + ":" + mm;

        }

        // gets doctor data after submission for writing into database
        function submitDoctorHospitalData() {

            // doctor data
            var d_username = document.getElementById('hiddenUserName').value;

            // doctor hospital data
            var h_address = document.getElementById('hospitalAddress').value;
            var h_name = document.getElementById('hospitalName').value;
            var h_telno = document.getElementById('telephoneNumber').value;
            var dh_visitingTime = getVisitingTime();

            // write doctor hospital data to database
            writeDoctorHospitalData(h_address, h_name, h_telno, d_username, dh_visitingTime);

        }

        // gets doctor data after submission for writing into database

        // writes doctor hospital data to database
        // p_ stands for parameter, otherwise json object will have the keys in the same name
        function writeDoctorHospitalData(p_address, p_name, p_telno, p_username, p_visitingTime) {

            // a doctorHospital object
            var doctorHospitalObj = {

                hospitalAddress: p_address,
                hospitalName: p_name,
                hospitalTelNo: p_telno,
                username: p_username,
                visitingTime: p_visitingTime

            }

            // write to database
            var updates = {};
            updates['/doctorHospitals/' + p_username + "_" + p_name] = doctorHospitalObj;

            firebase.database().ref().update(updates);

            // redirect
            window.location = "hospitalConfirmation.php?doctorUsername=" + p_username;

        }


        // shows success message after writing caretaker data
        function showSuccessMessage() {

            document.getElementById('successMessage').innerHTML =
                "<br/>" + "<br/>" + "<br/>" +
                "<h1 style=color:black> Welcome to MedPhil Community </h1>" +
                "<br/>" +
                "<h1> Successfully Added Your Details </h1>" +
                "<br/>" +
                "<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='index.php'>";

        }

        // progress bar length
        function progress(i,value) {
            var elem = document.getElementById("myBar");
            var width = i;
            var id = setInterval(frame, 10);

            function frame() {
                if (width >= value) {
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + '%';
                }
            }

        }

    </script>

</head>
<body onload="progress(40,70)">
<?php
include("websiteHeader.php");
?>

<div class="contentDiv" id="container" style="width:450px;height:800px;left:45%">


    <form method="POST" name="step2" action="hospitalConfirmation.php">
        <h1>Sign Up </h1>

        <a>Be a part of our community</a>
        <br/>
        <div id="myProgress">
            <div id="myBar"></div>
        </div>
        <p><b>Step 3 : Insert your hospital visit details</b></p>
        <img src="images/doctor-icon.png" style="height:150px; margin-left:100px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <?php echo "<input type=hidden class=inputs name=hiddenUserName id=hiddenUserName size=30  value='$userName' readonly>" ?>
        <br/><br/>

        <!-- hospital name-->
        <a class="formText" name="txtHospitalName" id="txtHospitalName">Hospital Name <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="text" class="inputs" name="hospitalName" id="hospitalName" size="30" required><br/><br/>

        <!-- hospital address -->
        <a class="formText" name="txtHospitalAddress" id="txtHospitalAddress">Hospital Address <font
                    color="red">*</font></a>
        <br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="text" class="inputs" name="hospitalAddress" id="hospitalAddress" size="30" required><br/><br/>

        <!-- telephone number -->
        <a class="formText" name="txtTelephoneNumber" id="txtTelephoneNumber">Telephone Number <font
                    color="red">*</font></a>
        <br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="number" min="0" class="inputs" name="telephoneNumber" id="telephoneNumber" size="30"
               required><br/><br/>

        <!-- visiting time -->
        <a class="formText" id="txtVisitingTime" name="txtVisitingTime">Visting Time <font
                    color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="number" min="0" max=24 class="inputs" name="visitingHour" id="visitingHour" size="30"
               placeholder="hh" required>

        <input type="number" min="0" max=60 class="inputs" name="visitingMin" id="visitingMin" size="30"
               placeholder="mm" required>
        <br/><br/>

        <?php

        // if this is not the first hospital added
        if (isset($addMore)) {

            echo "<input type=button class=commonButton name=signUpBtn id=signUpBtn onclick=submitDoctorHospitalData() value='Next'
               style='float:right'>";

        } else {

            // if this is the first hospital added
            echo "<input type=button class=commonButton name=signUpBtn id=signUpBtn onclick=submitDoctorHospitalData() value='Next'
               style='float:right'>";
        }

        ?>

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