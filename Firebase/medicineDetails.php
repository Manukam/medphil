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

            });

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

            document.getElementById("caretakerSelection").innerHTML = "<select id=caretakerSelection_selected name=caretakerSelection >" + options + "</select>";

        }

        // converts dosage gap and returns in seconds
        function convertDosageGap() {

            // get hh,mm & ss of dosage gap
            var dosageGap_h = document.getElementById('dosageGap_h').value;
            var dosageGap_m = document.getElementById('dosageGap_m').value;
            var dosageGap_s = document.getElementById('dosageGap_s').value;

            // calculate total seconds
            var dosageGap_secs = dosageGap_s + (dosageGap_m * 60) + (dosageGap_h * 60 * 60);

            return dosageGap_secs;
        }

        // gets medicine data after submission for writing into database
        function submitMedicineData() {

            var md_bottleId = document.getElementById('bottleId').value;
            var md_dosageGap = convertDosageGap();
            var md_medicine = document.getElementById('medicine').value;
            var md_patient = document.getElementById('hiddenUsername').value;


            // write data to database
            writeMedicineData(md_bottleId, md_dosageGap, md_medicine, md_patient);

        }

        // writes medicine data to database and redirect to medicalConfig page
        // p_ stands for parameter, otherwise json object will have the keys in the same name
        function writeMedicineData(p_bottleId, p_dosageGap, p_medicine, p_patient) {

            // a bottle object
            var bottleObj = {

                dosagegap: p_dosageGap,
                medicine: p_medicine,
                patient: p_patient

            };

            // write to database
            var updates = {};
            updates['/bottles/' + p_bottleId] = bottleObj;

            firebase.database().ref().update(updates);

            // redirect
            window.location = "medicalConfig.php?patient=" + p_patient + "&medicine=" + p_medicine + "&dosageGap=" + p_dosageGap + "&bottleId=" + p_bottleId;

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
<body onload=progress(80,100)>

<?php
include("websiteHeader.php");

// get username from get request
@$username = $_GET['username'];
?>

<div class="contentDiv" id="container" style="width:500px; margin-left:-85px">


    <form method="POST" name="careTakerSelectForm">

        <h1>Sign Up </h1>
        <a>Be a part of our community</a>
        <br/>
        <div id="myProgress">
            <div id="myBar"></div>
        </div>
        <p><b>Step 5 : Configure your medicine details</b></p>
        <img src="images/app.png" style="width:200px; margin-left:105px">
        <br/><br/>

        <!-- medicine name -->

        <a class="formText" id="txtMedicineName" name="txtMedicineName"> Medicine Name <font
                    color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;


        <input type="text" class="inputs" name="medicine" id="medicine" size="30" required><br/><br/>

        <!-- bottle id -->

        <a class="formText" id="txtBottleId" name="txtBottleId"> Bottle ID <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;


        <input type="text" class="inputs" name="bottleId" id="bottleId" size="30" required><br/><br/>

        <!-- dosage gap -->

        <a class="formText" id="txtDoseageGap" name="txtDoseageGap">Doseage Gap <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="number" min="0" max=24 class="inputs" name="dosageGap_h" id="dosageGap_h" size="30"
               placeholder="hh" required>

        <input type="number" min="0" max=60 class="inputs" name="dosageGap_m" id="dosageGap_m" size="30"
               placeholder="mm" required>

        <input type="number" min="0" max=60 class="inputs" name="dosageGap_s" id="dosageGap_s" size="30"
               placeholder="ss" required>


        <?php

        // get username from post request
        echo "<input type=hidden id=hiddenUsername name=hiddenUsername value=$username>";

        ?>

        <br/><br/>
        <!-- submit button -->

        <input type="button" style="float : right" class="commonButton" name="nextStep" id="nextStep" value="Signup"
               onclick="submitMedicineData()">

    </form>


</div>
<div style="margin-top:770px">
    <?php
    include 'websiteFooter.php';
    ?>
</div>
</body>
</html>


?>