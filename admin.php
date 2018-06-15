<!DOCTYPE html>
<html>
<head>
<title>Adaugare eveniment</title>
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
</style>
<?php
    session_start();
    if($_SESSION['username'] != "admin"){
     header("location: index.php");
    exit;
}
?>
<style>
input[type=text], select, datetime-local {
    width: 25%;
    height: 45px;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 25%;
    background-color: #2196f3;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue">Acasa</a>
    <a href="admin.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-blue">Adauga eveniment</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Iesire</a>
  </div>
</div>
<br><br>
<center>
    <div class="wrapper">
        <h2>Adauga un eveniment</h2>
        <form action="addevent.php" method="POST">
            <div class="form-group">
                <label>Titlul evenimentului: </label><br>
                <input type="text" name="title" value="" required>
            </div>    
            <div class="form-group">
                <label>Tipul evenimentului: </label><br>
                <select name="type">
                    <option value="Concerte">Concert</option>
                    <option value="Teatru">Teatru</option>
                    <option value="Festival">Festival</option>
                    <option value="Expozitie">Expozitie</option>
                    <option value="Filme">Film</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Sport">Sport</option>
                    <option value="Voluntariat">Voluntariat</option>
                </select>
            </div>
            <div class="form-group">
                <label>Descriere: </label><br>
                <input type="text" name="description" value="" required>
            </div>
            <div class="form-group">
                <label>Locatia evenimentului: </label><br>
                <input type="text" name="location" value="" required>
            </div>
            <div class="form-group">
                <label>Data evenimentului: </label><br>
                <input type="datetime-local" name="date" value="" required>
            </div>
            <div class="form-group">
                <label>Numar de telefon: </label><br>
                <input type="text" name="phone" value="" required>
            </div>
            <div class="form-group">
                <label>Imagine (numele): </label><br>
                <input type="text" name="imagepath" required value="images/">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="w3-button" value="Adauga eveniment">
            </div>
        </form>
    </div>    
</center>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p>Created by Baies Darius-Florin</p>
</footer>
</body>
</html>