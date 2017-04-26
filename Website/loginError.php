<!DOCTYPE>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

		<!DOCTYPE>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Login</title>
			<link rel="stylesheet" type="text/CSS" href="style.CSS">
		</head>
		<body>
		<?php
			include 'websiteHeader.php';
		 ?>


		    <div id="container" style="margin-left:-80px; margin-top:-170px">
		    <form method="POST" name="login" action="loginValidationAction.php">
					<h1> Login </h1>
					<a style="color:#19baaa;">Welecome to MedPhil </a><br/><br/>
<p style="color:red" >Incorrect password. Try again </br></p>
		    <a class="formText" name="txtUserName" id="txtUserName" >Username</a>
		    <input type="text" class="inputs" name="userName" id="userName" size="30" placeholder="Username"> <br/> <br/>
		    <a class="formText" name="txtPassword" id="txtPassword">Password</a>&nbsp;
		    <input type="password" class="inputs" name="password" id="password" size="30" placeholder="Password"><br/><br/>
		    <input type="submit" class="loginButton" id="loginBtn" value="Login" style="margin-left:200px">
				<input type="reset" class="loginButton" value="Reset" style="margin-top:-30px;margin-left:100px"><br/><br/>
					<a style="color:#19baaa;">Don't you have an account?</a>
					<a class="navBarUpperText" style="color: #216bbd" href=home.php> Signup </a>

		    </form>

		    </div>


		<div style="margin-top:450px">
				<?php
				include'websiteFooter.php';
				 ?>
		</div>

		</body>

		</html>
