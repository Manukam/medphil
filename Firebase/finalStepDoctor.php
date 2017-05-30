<?php
$userName = $_POST["hiddenUserName"];
?>

<!DOCTYPE>
<html>
<head>
    <title>Sign-up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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

        // patients table
        var patientsTable = db.ref('patients/');

        // to display selection box options
        var selectBox = "";

        // sync patients table once
        patientsTable.once("value").then(
            function (snapshot) {

                // add to availabe patients selectBox
                addToPatientsList(snapshot.toJSON());

                // show available patients
                showPatients(selectBox);

            }
        );


        // FUNCTIONS /////////////////////////////////////////////////////////////////////////////

        // iterates through each patient object and adds each patient's username to selectBox, if no doctor assigned
        function addToPatientsList(jsonPatients) {

            // for each caretaker object
            for (var username in jsonPatients) {

                // if object has this key (username)
                if (jsonPatients.hasOwnProperty(username)) {

                    // if no doctor is assigned
                    if (jsonPatients[username]['doctor'] == "") {

                        // add key(username) to list
                        addPatients(username);

                    }

                }
            }
        }

        // adds patient with given username, to the list
        function addPatients(username) {

            // add as a select option
            selectBox = selectBox.concat("<option value=" + username + ">" + username + "</option>");

        }

        // displays all the patients who are not having a doctor within a select element in the HTML body
        function showPatients(options) {

            // if no patients are selectable
            if (selectBox == "") {

                // display no patients and 'Continue' button
                document.getElementById("patientSelection").innerHTML =

                    "There is no patient available without a doctor. Please try again later<br/>" +
                    "<br/><input type=button id=btnAddPatient name=btnAddPatient class=commonButton onclick=submitAssignDoctor() value=Next>";

            } else {

                // at least one patient is available

                // display select box and 'Add' button
                document.getElementById("patientSelection").innerHTML =
                    "<select id=patientSelection_selected class=inputs name=patientSelection >" + options + "</select>" +
                    "<br><br><input type=button id=btnAddPatient name=btnAddPatient class=commonButton onclick=submitAssignDoctor() value=Next>";
            }

        }

        // gets patient doctor assign data after submission, for writing into database
        function submitAssignDoctor() {

            var dr_username = document.getElementById('hiddenUserName').value;

            // if at least one patient is selectable
            if (!(selectBox == "")) {
                // get selection
                var pt_username = document.getElementById('patientSelection_selected').value;
                // write data to database
                assignDoctor(pt_username, dr_username);
            }

            // redirect
            window.location = "assignDoctor.php?doctorUsername=" + dr_username;

        }


        // writes doctors name against the patients 'doctor' key
        function assignDoctor(patientUsername, doctorUsername) {

            //db.ref().child('patients').child(patientUsername).child('doctor').setValue(doctorUsername);

            var updates = {};
            updates['/patients/' + patientUsername + '/doctor/'] = doctorUsername;

            firebase.database().ref().update(updates);

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

<body onload="progress(70,100)">
<?php
include("websiteHeader.php");
?>
<div class="contentDiv" id="container" style="width:450px">
    <form method="POST" name="careTakerSelectForm" action="assignDoctor.php">
        <h1>Sign Up </h1>

        <a>Be a part of our community</a>
        <br/>
        <div id="myProgress">
            <div id="myBar"></div>
        </div>


        <p><b>Step 4 : Add your patients</b></p>
        <img src="images/doctor-icon.png" style="height:150px; margin-left:100px;">
        <br/><br/>

        <!--to display patient selection box ///////////////////////////////////////-->
        <div id="patientSelection"></div>

        <?php

        echo "<input type=hidden name=hiddenUserName id = hiddenUserName value=$userName>";

        ?>


    </form>
</div>


<div style="margin-top:530px">
    <?php
    include 'websiteFooter.php';
    ?>
</div>


</body>

</html>
