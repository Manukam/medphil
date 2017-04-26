<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">
		<style>
		h1{
			color: #19baaa;
			text-align: center;
		}

		</style>


</head>
<body>

<?php
include("headerUser.php");
 ?>

<?php
include("dbConnect.php");
$userName=$_POST["userName"];
$medicineName=$_POST["medicineName"];
$dosageGap=$_POST["dosageGap"];
$notifyItreration=$_POST["notifyItreration"];
$warnDosage=$_POST["warnDosage"];
$bottleId=$_POST["bottleId"];
$query="UPDATE  patientmedicine SET dosageGap='$dosageGap',notifyIterations='$notifyItreration', warnDosage='$warnDosage',bottleId='$bottleId' WHERE patientUserName='$userName' AND medicineName='$medicineName'";
$result=mysqli_query($con,$query);
if(!$result){
  die(mysqli_error($con));
}else{

//  $fh = fopen('data.txt');
// include("dbConnect.php");
//    $fileQuery="SELECT * FROM patientmedicine";
//  $result=mysqli_query($con, $fileQuery);
//   while ($row = mysqli_fetch_array($result)) {
//     $num = mysqli_num_fields($result) ;
//     $last = $num - 1;
//     for($i = 0; $i < $num; $i++) {
//           //fwrite($fh, $row[$i]);
// //$data = "\r\n".'<'.$bottleId[$i].'>'." ".$userName[$i]." " . $medicineName[$i]." ".$doseageGap[$i]." //".$notifyItreration[$i]." ".$warnDosage[$i]." ".'<'.'/'.$bottleId[$i].'>' . "\n";
//              $ret = file_put_contents('data.txt', $row[$i]."\r\n", FILE_APPEND | LOCK_EX);
//
//         if ($i != $last) {
//              //fwrite($fh, json_encode($row[$i]));
// //$data1 = "\r\n".'<'.$bottleId.'>'." ".$userName." " . $medicineName." ".$doseageGap." ".$notifyItreration." //".$warnDosage." ".'<'.'/'.$bottleId.'>' . "\n";
// $ret = file_put_contents('data.txt', $row[$i], FILE_APPEND | LOCK_EX);
//         }
//     }
//      fwrite($fh, "\n");
// }
// fclose($fh);



echo"<br/>";
echo"<h1 style=color:black>Hi '$userName'<h1/>";
					echo "<br/>";
			echo"<h1> Successfully Updated '$medicineName' to your site </h1>";
				echo "<br/>";
			echo"<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='patientHomePage.php'>";

}
?>
</body>
</html>
