<!DOCTYPE html>
<html>
<head>
<title>Categorii</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<style type="text/css">
    #content {
        width:250px;
        height:150px;
}
html { 
background: url(images/Brasov.jpg) no-repeat center center fixed; 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
.w3-row{
    margin-top: 100px;
}
IMG.displayed {
    display: block;
    margin-left: auto;
    margin-right: auto }
</style>
</head>
<body>
<?php
// Initialize the session
session_start();
 
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){?>
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Acasa</a>
    <a href="categories.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Categorii</a>
    <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Login</a>
    <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Inregistrare</a>
  </div>
</div>
<?php
}
else{
?>

<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
  <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Acasa</a>
  <a href="categories.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Categorii</a>
    <a href="myevents.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Evenimentele mele</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Iesire</a>
  </div>
</div>
<?php } ?>
<div class="w3-row">
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Concerte">
        <img class = "displayed" src="images/concerte.png">
        </a href>
    </div>
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Teatru">    
        <img class = "displayed" src="images/teatru.png">
        </a href>
    </div>
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Festival">
        <img class = "displayed" src="images/festival.png">
        </a href>
    </div>
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Expozitie">
        <img class = "displayed" src="images/expozitii.png">
        </a href>
    </div>
</div>
<div class="w3-row">
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Filme">
        <img class = "displayed" src="images/filme.png">
        </a href>
    </div>
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Seminar">  
        <img class = "displayed" src="images/seminarii.png">
        </a href>
    </div>
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Sport">
        <img class = "displayed" src="images/sport.png">
        </a href>
    </div>
    <div class="w3-quarter w3-container">
        <a href="eventtype.php?type=Voluntariat">
        <img class = "displayed" src="images/voluntariat.png">
        </a href>
    </div>
</div>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p style="color:white">Created by Baies Darius-Florin</p>
</footer>
</body>
</html>