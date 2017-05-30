<html>
<head>
    <title>Sign-up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>
    <script>
        // Initialize Firebase
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
        var mydb = firebase.database();

        var obj = mydb.ref().child("patients").child("senthu16").child("address");

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
<body onload=progress(1,20)>

<?php
include("websiteHeader.php");
?>

<div id="container">

    <form method="POST" name="step1" action="connectionAction.php">

        <h1>Sign Up </h1>

        <a>Be a part of our community</a>

        <br/>
        <div id="myProgress">
            <div id="myBar"></div>
        </div>


        <p><b>Step 1 : Insert your details</b></p>

        <center><img align=center src="images/patient.png"></center>

        <br/><br/>

        <a class="formText" id="fullName" name="fullName"> Full Name <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="text" class="inputs" name="firstName" id="firstName" size="30" placeholder="FirstName" required>
        &nbsp; &nbsp;

        <input type="text" class="inputs" name="lastName" id="lastName" size="30" placeholder="Last Name" required><br/><br/>

        <a class="formText" id="txtUserName" name="txtUserName"> UserName <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="text" class="inputs" name="userName" id="userName" size="30" required><br/><br/>

        <a class="formText" id="txtPassword" name="txtPassword"> Password <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="password" class="inputs" name="password" id="password" size="30" required><br/><br/>

        <a class="formText" name="txtEmail" id="txtEmail"> Email Address <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;

        <input type="email" class="inputs" name="email" id="email" size="30" required><br/><br/>

        <input type="submit" style="float : right" class="commonButton" name="nextStep" id="nextStep" value="Next">

    </form>


</div>

<div style="margin-top:850px">
    <?php
    include 'websiteFooter.php';
    ?>
</div>

</body>
</html>