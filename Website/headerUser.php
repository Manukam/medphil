
<div class="topDiv" >
  <br/><br/>
  <div class="headingDiv">
    <h1>Sign Up </h1>
  </div>
  <br/>
</div>


<div class="headerImgDiv">
  <img src="images/logo.png" width="18%">

</div>

<div class="headerLoginDiv" style="text-align: right">
  <!-- <a style="color:#013248; font-size: 16px; font-family:MontserratReg; line-height:11px;">Gowthamy Vaseekaran</a><br/>
  <a style="color:#013248; font-size: 12px; font-family:Montserrat">DOCTOR</a>
  <input type="submit" name="logout" id="logout" value="Logout" -->

  <?php
  session_start();
  if(isset($_SESSION["session1"])){
    //echo"<div class=loggedInUserDiv><p align=right>".$_SESSION["session1"]."</p></div>";
    echo"<div class=notLoggedInUserDiv >";

    echo"<a style=font-size:200%> &nbsp;</a>";
    echo"<a style=color:#013248;font-size:16px;font-family:MontserratReg;line-height:11px;>".$_SESSION["session1"]." </font></a> ";
    echo"<input type=button class=loginButton value=LogOut onclick=document.location.href='index.php' style=margin-left:95px>";
    echo"</div>";

  }else{
    echo"<div class=headerLoginDiv>";
    echo"  <form method=POST name=login action=loginValidationAction.php>";
    echo"<input type=text class = inputs style=border-radius : 3.7px; padding : 3px; name=userName id=userNamee placeholder=Username size=20>";
    echo"&nbsp; &nbsp;";
    echo"    <input type=password class =inputs style=border-radius : 3.7px; padding : 3px; name=password id=password placeholder=Password size=20>";
    echo "<br/>";
    echo"    <input type=submit class=loginButton style=float:right name=commonButton id=loginBtn value=Login>";
    echo "  </form>";
    echo"  </div>";

  }
  ?>

</div>

</div>
