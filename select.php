<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"medphil");
$res=mysqli_query($link,"SELECT * FROM senthu16_dosage");
while($row=mysqli_fetch_array($res))
{
echo $row["medicineName"]." ".$row["dosageTime"]." ".$row["dosageStatus"];
echo "<br>";


}
?>