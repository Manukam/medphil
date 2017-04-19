<html>
<head>
	<title>Sign-up</title>
    <link rel="stylesheet" type="text/CSS" href="style.CSS">

</head>
<body>

	<?php
		include("websiteHeader.php");
	?>

   <div  id="container">

    <form method="POST" name="step1" action="connectionAction.php">

        <h1>Sign Up </h1>

    <a>Be a part of our community</a>
    <br/>
        <p><b>Step 1: Insert your details</b></p>
			<img src="images/patient.png" style="margin-left:0px;width:550px">

				<br/><br/>

        <a class="formText" id="fullName" name="fullName"> Full Name<font color="red">*</font></a><br/>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="text" class="inputs" name="firstName" id="firstName" size="30" placeholder="FirstName" required> &nbsp; &nbsp;
        <input type="text" class="inputs" name="lastName" id="lastName" size="30" placeholder="Last Name" required><br/><br/>
        <a class="formText" id="txtUserName" name="txtUserName"> UserName <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="text" class="inputs" name="userName" id="userName" size="30" placeholder="UserName" required><br/><br/>
        <a class="formText" id="txtPassword" name="txtPassword"> Password<font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="password" class="inputs" name="password" id="password" size="30" placeholder="Password" required><br/><br/>
        <a class="formText" name="txtEmail" id="txtEmail"> Email Address <font color="red">*</font></a><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        <input type="email" class="inputs" name="email" id="email" size="30" placeholder="someone@gmail.com" required><br/><br/>
        <input type="submit" style="float : right" class="commonButton" name="nextStep" id="nextStep" value="Next" >

    </form>





</div>

<div style="margin-top:850px">
<?php
include 'websiteFooter.php';
 ?>
</div>

</body>
</html>
