<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"medphil");
$res=mysqli_query($link,"SELECT * FROM patientcaretaker");
while($row=mysqli_fetch_array($res))
{
echo $row["patientUserName"]." ".$row["caretakerUserName"];
echo "<br>";


}
?>