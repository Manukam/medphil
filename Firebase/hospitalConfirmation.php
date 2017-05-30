<?php

// insert doctor hospital details

$username = $_GET['doctorUsername'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign-up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>

        // redirects to add more hospitals page with the doctor's username through GET request
        function addMoreHospitals(doctorUsername) {
            window.location = "addMoreHospitals.php?doctorUsername=" + doctorUsername + "&addMore=true";
        }

    </script>
</head>
<body>
<?php
include("websiteHeader.php");
?>


<form method="POST" name="step2">
    <br/><br/>
    <img src="images/hospital.png" style="width:200px;margin-left:600px">
    <h1>
        <center>Do you want to add more hospitals</center>
    </h1>
    <?php echo "<input type=hidden name=hiddenUserName value=$username>"; ?>
    <br/>


    <?php
    echo "<input type=hidden name=hiddenUserName value=$username>";
    ?>

    <table align="center">
        <tr>
            <td align="center">
                <?php
                // add more hospitals button
                echo "<input type=button class=commonButton name=commonButton id=commonButton onclick=addMoreHospitals('" . $username . "') value='Add More Hospitals'
           >";
                ?>
            </td>
</form>

<form method="POST" name="step3" action="finalStepDoctor.php">
    <?php echo "<input type=hidden name=hiddenUserName value=$username>"; ?>

    <td>
        <input type="submit" class="commonButton" name="commonButton" id="commonButton" value="Continue"
        >
    </td>
    </tr>
    </table>


</form>

</body>
</html>

