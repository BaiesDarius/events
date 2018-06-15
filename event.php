<!DOCTYPE html>
<html>
<head>
  <title>Evenimente Brasov</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
  IMG.displayed {
    display: block;
    margin-left: auto;
    margin-right: auto }
  </style>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){?>
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue">Acasa</a>
    <a href="categories.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Categorii</a>
    <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Login</a>
    <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Inregistrare</a>
  </div>
</div>
<?php
}
else
if(isset($_SESSION['username']) && $_SESSION['username'] == "admin"){
    ?>
    <div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue">Acasa</a>
    <a href="admin.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Adauga eveniment</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Iesire</a>
  </div>
</div>
<?php
}
else{
?>

<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Acasa</a>
    <a href="categories.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Categorii</a>
    <a href="myevents.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Evenimentele mele</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Iesire</a>
  </div>
</div>
<?php } ?>

<?php 
require_once 'config.php';
$idevent = $_GET['id'];
$sql = "SELECT * FROM events WHERE id_event = $idevent";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    $title = $row['title_event'];
    $description = $row['description_event'];
    $location = $row['location_event'];
    $date = $row['date_event'];
    $phone = $row['phone_event'];
    $image = $row['imagepath_event'];
    $type = $row['type_event'];?>
    <div class="w3-row w3-padding-64" id="about">
        <div class="w3-col m6 w3-padding-large w3-hide-small">
            <?php echo "<img src='"?>
            <?php echo $image;?>
            <?php echo "' class ='displayed w3-round w3-image w3-opacity-min' alt='Table Setting' width=400 height=300/>" ?>
            </div>

            <div class="w3-col m6 w3-padding-large">
              <h1 class="w3-center"><u><?php echo $title;?></u></h1><br>
              <h5 class="w3-medium w3-center">Tipul evenimentului: <?php echo $type;?></h5><br>
              <p class="w3-large">Descriere:   <?php echo $description; ?></p>
              <p class="w3-large">Locatia: <?php echo $location;?></p>
              <p class="w3-large">Data evenimentului: <?php echo $date;?></p>
              <p class="w3-large">Numar de telefon: <?php echo $phone;?></p>
              <br><br>
              <?php
                  if(isset($_SESSION['username'])){
                  $user = $_SESSION['username'];
                  $_SESSION['idevent'] = $idevent; 
                  $issubscribed = "SELECT * FROM userevents WHERE id_event = '$idevent' AND username = '$user'";
                  if($user != "admin"){
                    if($resultsubscribe = mysqli_query($link, $issubscribed)){
                        if(mysqli_num_rows($resultsubscribe) > 0){ ?>
                          <form action="/events/unsubscribe.php" method="post">
                          <center>
                          <input type="submit" class="btn btn-danger" value="Sterge de la favorite">
                          </center>
                        </form>

                      <?php
                        }
                          else{
                        ?><form action="/events/subscribe.php" method="post">
                          <center>
                          <input type="submit" class="btn btn-primary" value="Adauga la favorite">
                          </center>
                        </form>
                      <?php } 
                      }
                  }
                  else{?>
                      <form action="/events/deleteevent.php" method="post">
                          <center>
                            <input type="submit" class="btn btn-danger" value="Sterge eveniment">
                          </center>
                      </form>
                  <?php } ?>
        </div>
  </div>
  <?php
    }
}
}
?>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p>Created by Baies Darius-Florin</p>
</footer>
</body>
</html>