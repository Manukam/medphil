<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">
		<style>
		h1{

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

if(isset($_POST['delete']))
{
 $cnt=array();

 $cnt=count($_POST['checkbox']);

 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_POST['checkbox'][$i];
     $query="DELETE  FROM patientdoctor where patientUserName='$del_id'";
     //mysql_query($query);
     $result=mysqli_query($con,$query);
          		if(!$result){
                			die(mysqli_error($con));
                 		}else{
                  			echo "<br/>";
                				echo "<br/>";
                  				echo "<br/>";
                 					echo "<br/>";



  }
}
echo"<h1> Successfully Deleted  from your site </h1>";
                				echo "<br/>";
                 			echo"<input type=button class= commonButton style='margin-left:650px' value =Back onclick=document.location.href='doctorHomePage.php'>";
}else{

}
 ?>
</body>
</html>
