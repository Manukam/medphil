<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/CSS" href="style.CSS">
<style>
* {box-sizing:border-box}
body {font-family: Verdana,sans-serif;}
.mySlides {display:none}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 13px;
  width: 13px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}

h3{
    font-family: "MontserratReg";
    color: #013248;
    margin-left: 50px;
    text-align: center;
    letter-spacing : 2.0px;
}

h2{
    font-family: "MontserratReg";
    color: #19baaa;
    margin-left: 50px;
    text-align: center;
    letter-spacing : 2.0px;
}
</style>
</head>
<body>
  <?php
    include("websiteHeader.php");
  ?>

  <br/>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 5</div>
  <img src="images/doctor.jpg" style="width:100% ; height:400px">

</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 5</div>
  <img src="images/drug.jpg" style="width:100%;height:400px">

</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 5</div>
  <img src="images/drugsBottle.jpg" style="width:100%;height:400px">

</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 5</div>
  <img src="images/pill.jpg" style="width:100%;height:400px">

</div>

<div class="mySlides fade">
  <div class="numbertext">5 / 5</div>
  <img src="images/MedPhil.png" style="width:100%; height:400px">

</div>





</div>
<br>

<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>

</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>
<br/>
<div class="container">
  <h3>MedPhil smart wireless pill bottles are currently being used by patients in pharmaceutical and research engagements.
    These bottles collect and send all adherence data in real-time. The system automatically analyzes this information and populates
    the data on our secure dashboard. If doses are missed, patients can receive customizable alerts and
    interventions - using automated text messages. Please Join with us.
  </h3>
<br/>
  <h2> WE CARE FOR YOUR HEALTH </h2>

</div>

<?php
  include("websiteFooter.php");
?>

</body>
</html>
