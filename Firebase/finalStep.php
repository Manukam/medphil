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

        // caretakers table
        var caretakersTable = db.ref('caretakers/');

        // to display selection box options
        var selectBox = "";

        // sync caretakers table once
        caretakersTable.once("value").then(
            function (snapshot) {

                // add to availabe caretakers selectBox
                addToCaretakersList(snapshot.toJSON());

                // show available caretakers
                showCaretakers(selectBox);

            }
        );

        // FUNCTIONS /////////////////////////////////////////////////////////////////////////////

        // iterates through each caretaker object and adds each caretaker's username to selectBox
        function addToCaretakersList(jsonCaretakers) {

            // for each caretaker object
            for (var username in jsonCaretakers) {

                // if object has this key (username)
                if (jsonCaretakers.hasOwnProperty(username)) {
                    // add key(username) to list
                    addCaretakers(username);
                }
            }
        }

        // adds caretaker with given username, to the list
        function addCaretakers(username) {

            // add as a select option
            selectBox = selectBox.concat("<option value=" + username + ">" + username + "</option>");

        }

        // displays all the caretakers within a select element in the HTML body
        function showCaretakers(options) {

            // if no caretakers are available
            if (selectBox == "") {

                document.getElementById("caretakerSelection").innerHTML = "No Caretakers available. Please try again later<br/>";

            } else {

                // at least one caretaker is available
                document.getElementById("caretakerSelection").innerHTML = "<select class=inputs id=caretakerSelection_selected name=caretakerSelection >" + options + "</select>";
            }
        }

        // gets patient data after submission for writing into database
        function submitPatientData() {

            var pt_username = document.getElementById('hiddenUsername').value;
            var pt_address = document.getElementById('hiddenAddress').value;

            var pt_doctor = "";
            var pt_email = document.getElementById('hiddenEmail').value;
            var pt_firstname = document.getElementById('hiddenFirstName').value;
            var pt_lastname = document.getElementById('hiddenLastName').value;
            var pt_password = document.getElementById('hiddenPassword').value;

            if (!(selectBox == "")) {
                // select caretaker
                var pt_caretaker = document.getElementById('caretakerSelection_selected').value;

                // write data to database
                writePatientData(pt_username, pt_address, pt_caretaker, pt_doctor, pt_email, pt_firstname, pt_lastname, pt_password);

            }else{
                // write to database
                writePatientData(pt_username, pt_address, "", pt_doctor, pt_email, pt_firstname, pt_lastname, pt_password);

            }



        }

        // writes patient data to database and redirect to choose medicine details page
        // p_ stands for parameter, otherwise json object will have the keys in the same name
        function writePatientData(p_username, p_address, p_caretaker, p_doctor, p_email, p_firstname, p_lastname, p_password) {

            // a patient object
            var patientObj = {

                address: p_address,
                caretaker: p_caretaker,
                doctor: p_doctor,
                email: p_email,
                firstname: p_firstname,
                lastname: p_lastname,
                password: p_password

            };

            // a patient dosage object (to create the patient dosage table for the first time
            var patientDosageObj = {

                created: "welcome"

            };

            // write to database
            var updates = {};
            updates['/patients/' + p_username] = patientObj;
            updates['/dosages/' + p_username + '_dosage'] = patientDosageObj;

            firebase.database().ref().update(updates);

            // redirect to choose medicine details
            // username is passed as GET request
            window.location = "medicineDetails.php?username=" + p_username;

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
<body onload=progress(60,80)>

<?php
//include("dbConnect.php");

// PATIENT 

// select the caretaker and write to database
@$username = $_POST["hiddenUserName"];
@$address = $_POST["patientAddress"];
@$email = $_POST["hiddenEmail"];
@$firstname = $_POST["hiddenFirstName"];
@$lastname = $_POST["hiddenLastName"];
@$password = $_POST["hiddenPassword"];

?>

<?php
include("websiteHeader.php");
?>

<div class="contentDiv" id="container" style="width:400px; height:530px;left:48%;margin-top:-170px">

    <form method="POST" name="careTakerSelectForm" action="assignCareTaker.php">
        <h1>Sign Up </h1>

        <a>Be a part of our community</a>
        <br/>
        <div id="myProgress">
            <div id="myBar"></div>
        </div>

        <?php

        // hidden fields to carry POST data
        echo "<input type=hidden id=hiddenUsername name=hiddenUsername value=$username>";
        echo "<input type=hidden id=hiddenAddress name=hiddenAddress value=$address>";
        echo "<input type=hidden id=hiddenEmail name=hiddenEmail value=$email>";
        echo "<input type=hidden id=hiddenFirstName name=hiddenFirstName value=$firstname>";
        echo "<input type=hidden id=hiddenLastName name=hiddenLastName value=$lastname>";
        echo "<input type=hidden id=hiddenPassword name=hiddenPassword value=$password>";

        ?>

        <!--///////////////////////-->

        <p><b>Step 4 : Choose your Caretaker</b></p>
        <img src="images/caretakerPic.png" alt="caretaker" style="margin-left:-50px">
        <br/><br/>

        <!--to display caretaker selection box-->
        <div id="caretakerSelection"></div>
        <br>

        <!--///////////////////////-->

        <div>

            <?php
            echo "<input type=hidden name=hiddenUserName value=$username>";
            ?>

            <!-- <input type="submit" name="submitBtn" id="submitBtn" value="Next" class="commonButton"> -->
            <input type="button" name="submitBtn" id="submitBtn" value="Next" class="commonButton"
                   onclick="submitPatientData()">
    </form>
</div>


</div>
<div style="margin-top:530px">
    <?php
    include 'websiteFooter.php';
    ?>
</div>


</body>
</html>
