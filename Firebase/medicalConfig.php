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
// include("dbConnect.php");

$userName = $_GET["patient"];
$medicineName = $_GET["medicine"];
$dosageGap = $_GET["dosageGap"];
$bottleId = $_GET["bottleId"];

$data = '<' . $bottleId . '>' . $userName . " " . $medicineName . " " . $dosageGap . " 4 5 " . '<' . '/' . $bottleId . '>' . "\r\n";
$ret = file_put_contents('userConfig.txt', $data, FILE_APPEND | LOCK_EX);
if ($ret === false) {
    die('There was an error writing this file');
}


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<form>";
echo "<h1 style=color:black> Welcome to MedPhil Community </h1>";
echo "<br/>";
echo "<h1> Successfully Added Your Details </h1>";
echo "<br/>";
echo "<center><input type=button class= commonButton value =Back onclick=document.location.href='index.php'></center>";
echo "</form>";

?>

</body>
</html>