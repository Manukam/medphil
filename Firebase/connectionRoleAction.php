<?php
//include("dbConnect.php");
//grab details using post method
$firstName = $_POST["hiddenFirstName"];
$lastName = $_POST["hiddenLastName"];
$userName = $_POST["hiddenUserName"];
$password = $_POST["hiddenPassword"];
$emailAddress = $_POST["hiddenEmail"];


$role = $_POST['radioRole'];

if ($role == "patient") {

    // PATIENT ////////////////////////////////////////////////////
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Sign-up</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script>
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
    <body onload=progress(40,60)>

    <?php
    include("websiteHeader.php");
    ?>

    <div class="contentDiv" id="container" style="width:470px;height:630px;left:45%">

        <form method="POST" name="step2" action="finalStep.php">
            <h1>Sign Up </h1>

            <a>Be a part of our community</a>
            <br/>
            <div id="myProgress">
                <div id="myBar"></div>
            </div>

            <p><b>Step 3 : Insert your personal details</b></p>
            <img src="images/patient-icon.png" style="height:150px; margin-left:100px;">
            <br/><br/>


            <!-- <a class="formText" name="txtDateOfBirth" id="txtDateOfBirth">Date of Birth <font color="red">*</font></a>
            <br/><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

            <!-- DateofBirth -->
            <!--<input type="date" name="dateOfBirth" id="dateOfBirth"  class="inputs"><br/><br/> -->


            <a class="formText" name="txtPatientAddress" id="txtPatientAddress">Address <font
                        color="red">*</font></a><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

            <input type="textarea" name="patientAddress" class="inputs" id="patientAddress" size="30"
                   required><br/><br/>

            <?php
            echo "<input type=hidden name=hiddenFirstName value=$firstName>";
            echo "<input type=hidden name=hiddenLastName value=$lastName>";
            echo "<input type=hidden name=hiddenUserName value=$userName>";
            echo "<input type=hidden name=hiddenPassword value=$password>";
            echo "<input type=hidden name=hiddenEmail value=$emailAddress>";
            ?>

            <input type="submit" class="commonButton" name="signUpBtn" id="signUpBtn" value="Next"
                   style="float : right">

        </form>

    </div>

    <div style="margin-top:580px">
        <?php
        include 'websiteFooter.php';
        ?>
    </div>

    </body>
    </html>


    <?php

} else if ($role == "careTaker") {

    //CARETAKER ////////////////////////////////////////////////////////
    ?>
    <!DOCTYPE html>
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

            // gets caretaker data after submission for writing into database
            function submitCaretakerData() {

                var ct_username = document.getElementById('hiddenUserName').value;
                var ct_address = document.getElementById('address').value;
                var ct_email = document.getElementById('hiddenEmail').value;
                var ct_firstname = document.getElementById('hiddenFirstName').value;
                var ct_lastname = document.getElementById('hiddenLastName').value;
                var ct_mobile = document.getElementById('mobileNo').value;
                var ct_password = document.getElementById('hiddenPassword').value;


                // write data to database
                writeCaretakerData(ct_username, ct_address, ct_email, ct_firstname, ct_lastname, ct_mobile, ct_password);

            }

            // writes caretaker data to database and shows success message
            // p_ stands for parameter, otherwise json object will have the keys in the same name
            function writeCaretakerData(p_username, p_address, p_email, p_firstName, p_lastName, p_mobileNo, p_password) {

                // a caretaker object
                var caretakerObj = {

                    address: p_address,
                    email: p_email,
                    firstname: p_firstName,
                    lastname: p_lastName,
                    mobileno: p_mobileNo,
                    password: p_password

                };

                // write to database
                var updates = {};
                updates['/caretakers/' + p_username] = caretakerObj;

                firebase.database().ref().update(updates);

                // show success message
                // showSuccessMessage();

                window.location = "finalStepCareTaker.php";

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
    <body onload=progress(40,100)>
    <?php
    include("websiteHeader.php");
    ?>
    <div class="contentDiv" id="container" style="width:450px;height:650px;left:50%">

        <form method="POST" name="step2">
            <h1>Sign Up </h1>
            <a>Be a part of our community</a>
            <br/>
            <div id="myProgress">
                <div id="myBar"></div>
            </div>
            <p><b>Step 3 : Insert your personal details</b></p>
            <img src="images/caretaker-icon.png" style="height:150px; margin-left:100px;">
            <br/><br/>

            <!--mobile no-->
            <a class="formText" name="txtMobileNo" id="txtMobileNo">Mobile No <font color="red">*</font></a><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp
            <input type="number" min="0" class="inputs" name="mobileNo" id="mobileNo" size="30" required><br/><br/>

            <!-- address -->
            <a class="formText" name="txtAddress" id="txtAddress">Address <font color="red">*</font></a><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp
            <input type="text" class="inputs" name="address" id="address" size="30" required><br/><br/>

            <?php

            // get from POST request and store
            echo "<input type=hidden id=hiddenFirstName name=hiddenFirstName value=" . $firstName . ">";
            echo "<input type=hidden id=hiddenLastName name=hiddenLastName value=" . $lastName . ">";
            echo "<input type=hidden id=hiddenUserName name=hiddenUserName value=" . $userName . ">";
            echo "<input type=hidden id=hiddenPassword name=hiddenPassword value=" . $password . ">";
            echo "<input type=hidden id=hiddenEmail name=hiddenEmail value=" . $emailAddress . ">";
            ?>

            <input type="button" class="commonButton" name="signUpBtn" onclick="submitCaretakerData()" id="signUpBtn"
                   value="Signup" style="float:right">

        </form>
    </div>


    <div style="margin-top:580px">
        <?php
        include 'websiteFooter.php';
        ?>
    </div>

    </body>
    </html>
    <?php
} else {

    // DOCTOR /////////////////////////////////////////////////////////////////////////////////

    /*
    * doctor's signup procedures are over before this
    * add doctor details to database
    * doctor hospital details are yet to be filled out
    */
    ?>

    <!DOCTYPE html>
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
            function submitDoctorData() {

                // doctor data
                var d_username = document.getElementById('hiddenUserName').value;
                var d_email = document.getElementById('hiddenEmail').value;
                var d_firstname = document.getElementById('hiddenFirstName').value;
                var d_lastname = document.getElementById('hiddenLastName').value;
                var d_password = document.getElementById('hiddenPassword').value;

                // doctor hospital data
                var h_address = document.getElementById('hospitalAddress').value;
                var h_name = document.getElementById('hospitalName').value;
                var h_telno = document.getElementById('telephoneNumber').value;
                var dh_visitingTime = getVisitingTime();

                // write doctor data to database
                //writeDoctorData(d_username, d_email, d_firstname, d_lastname, d_password);

                // write doctor hospital data to database
                //writeDoctorHospitalData(h_address, h_name, h_telno, d_username, dh_visitingTime);

                addHospitalAndSignup(d_username, d_email, d_firstname, d_lastname, d_password, h_address, h_name, h_telno, dh_visitingTime)

            }

            // signups the doctor with hospital
            function addHospitalAndSignup(d_username, d_email, d_firstName, d_lastName, d_password, h_address, h_name, h_telno, dh_visitingTime) {

                // a doctor object
                var doctorObj = {

                    email: d_email,
                    firstname: d_firstName,
                    lastname: d_lastName,
                    password: d_password

                };

                var doctorHospitalObj = {

                    hospitalAddress: h_address,
                    hospitalName: h_name,
                    hospitalTelNo: h_telno,
                    username: d_username,
                    visitingTime: dh_visitingTime

                }

                // write to database
                var dbUpdates = {};
                dbUpdates['/doctors/' + d_username] = doctorObj;
                dbUpdates['/doctorHospitals/' + d_username + "_" + h_name] = doctorHospitalObj;

                firebase.database().ref().update(dbUpdates);

                // redirect
                window.location = "hospitalConfirmation.php?doctorUsername=" + d_username;

            }

            // writes doctor data to database and shows success message
            // p_ stands for parameter, otherwise json object will have the keys in the same name
            function writeDoctorData(p_username, p_email, p_firstName, p_lastName, p_password) {

                // a doctor object
                var doctorObj = {

                    email: p_email,
                    firstname: p_firstName,
                    lastname: p_lastName,
                    password: p_password

                };

                // write to database
                var updates = {};
                updates['/doctors/' + p_username] = doctorObj;

                firebase.database().ref().update(updates);

                // show success message
                // showSuccessMessage();

                //window.location = "finalStepCareTaker.php";

            }

            // writes doctor hospital data
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
                var updates2 = {};
                updates2['/doctorHospitals/' + p_username + "_" + p_name] = doctorHospitalObj;

                firebase.database().ref().update(updates2);

                // redirect
                // window.location = "hospitalConfirmation.php?doctorUsername=" + p_username;

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


    <div class="contentDiv" id="container" style="width:550px;height:800px;left:45%">

        <form method="POST" name="step2">

            <h1>Sign Up </h1>
            <a>Be a part of our community</a>
            <br/>
            <div id="myProgress">
                <div id="myBar"></div>
            </div>


            <p><b>Step 3 : Insert your hospital visit details</b></p>

            <img src="images/doctor-icon.png" style="height:150px; margin-left:100px;">
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
            <br/>


            <?php
            //PASS THESE VAUES THROUGH HIDDEN FIELDS
            echo "<input type=hidden id=hiddenFirstName name=hiddenFirstName value=$firstName>";
            echo "<input type=hidden id=hiddenLastName name=hiddenLastName value=$lastName>";
            echo "<input type=hidden id=hiddenUserName name=hiddenUserName value=$userName>";
            echo "<input type=hidden id=hiddenPassword name=hiddenPassword value=$password>";
            echo "<input type=hidden id=hiddenEmail name=hiddenEmail value=$emailAddress>";
            ?>

            <input type="button" class="commonButton" name="signUpBtn" id="signUpBtn" onclick="submitDoctorData()"
                   value="Next"
                   style="float:right">

        </form>

    </div>

    <!-- footer -->

    <div style="margin-top:620px">
        <?php
        include 'websiteFooter.php';
        ?>
    </div>


    </body>
    </html>

    <?php

} // end of if else branch for PATIENT, CARETAKER & DOCTOR

?>

