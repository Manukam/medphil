<html>
<head>
    <title>Sign-up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        h1 {
            color: #19baaa;
            text-align: center;
        }

    </style>


</head>
<body>

<?php
include("websiteHeader.php");
?>


<?php

$userName = $_GET["doctorUsername"];

echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<form method=POST name=careTakerSelectForm action=finalStepDoctor.php>";
echo "<h1 style=color:black> Welcome to MedPhil Community </h1>";
// display success messsage with username
echo "<br/>";
echo "<h1> Successfully Added Your Details </h1>";
echo "<br/>";
echo "<input type=hidden name=hiddenUserName value=$userName>";
echo "<table align=center>";
echo "<tr>";
echo "<td>";
echo "<input type=submit class= commonButton value ='Add More Patients'>";
echo "</td>";
echo "<td>";
echo "<input type=button class= commonButton value ='Finish Procedure' onclick=document.location.href='index.php'>";
echo "</td>";
echo "</tr>";
echo "</table>";

?>

</body>
</html>