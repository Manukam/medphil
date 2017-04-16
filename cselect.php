<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"medphil");
$res=mysqli_query($link,"SELECT * FROM caretakers");
while($row=mysqli_fetch_array($res))
{
echo $row["firstName"]." ".$row["lastName"]." ".$row["userName"]." ".$row["password"]." ".$row["mobileNo"]." ".$row["address"]." ".$row["email"];
echo "<br>";
}
?>