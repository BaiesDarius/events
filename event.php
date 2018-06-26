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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
    .pb-cmnt-container {
      font-family: Lato;
      margin-top: 100px;s
    }
    div.comment{
      border: 1px solid black;
    }
    div.info{
      margin-bottom:50px;
    }
    div.margin{
      padding-top: 50px;
      padding-right: 30px;
      padding-bottom: 50px;
      padding-left: 80px;
    }
    .pb-cmnt-textarea {
        resize: none;
        padding: 20px;
        height: 130px;
        width: 100%;
        border: 1px solid #F2F2F2;
    }
    </style>
    <style type="text/css">
        #content {
            width:250px;
            height:150px;
    }
    IMG.displayed {
        display: block;
        margin-left: auto;
        margin-right: auto;
        padding:1px;
        border:1px solid #021a40; }
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
    <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Autentificare</a>
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
$gasit = false;
$sql = "SELECT * FROM events WHERE id_event = $idevent";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
    $gasit = true;
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
            <?php echo "' class ='displayed w3-round w3-image w3-opacity-min' alt='Table Setting' width=330 height=300/>" ?>
        </div>

        <div id="info" class="w3-col m6 w3-padding-large w3-hide-small" border="thin solid black">
          <h1 class="w3-center"><u><?php echo $title;?></u></h1><br>
          <h5 class="w3-medium w3-center"><b>Tipul evenimentului: </b><?php echo $type;?></h5><br>
          <p class="w3-large"><b>Descriere:</b>   <?php echo $description; ?></p><br>
          <p class="w3-large"><b>Locatia:</b> <?php echo $location;?></p><br>
          <p class="w3-large"><b>Data evenimentului:</b> <?php echo $date;?></p><br>
          <p class="w3-large"><b>Numar de telefon:</b> <?php echo $phone;?></p><br>
          <br><br><br>
              <?php
                  if(isset($_SESSION['username'])){
                  $user = $_SESSION['username'];
                  $_SESSION['idevent'] = $idevent; 
                  $issubscribed = "SELECT * FROM userevents WHERE id_event = '$idevent' AND username = '$user'";
                  if($user != "admin"){
                    if($resultsubscribe = mysqli_query($link, $issubscribed)){
                        if(mysqli_num_rows($resultsubscribe) > 0){ ?>
                          <center>
                          <form action="/events/unsubscribe.php" method="post">
                            <input type="submit" class="btn btn-danger" value="Sterge de la favorite">
                          </form>
                        </center>

                      <?php
                        }
                          else{
                        ?>
                          <center>
                          <form action="/events/subscribe.php" method="post">
                            <input type="submit" class="btn btn-primary" value="Adauga la favorite">
                          </form>
                          </center>
                      <?php } 
                      }
                  }
                  else{?>
                      <center>
                      <form action="/events/deleteevent.php" method="post">
                            <input type="submit" class="btn btn-danger" value="Sterge eveniment">
                      </form>
                      </center><br>
                      <center>
                      <form action="/events/updateevent.php" method="post">
                            <input type="submit" class="btn btn-info" value="Actualizeaza eveniment">
                      </form>
                      </center>
                  <?php }
        }?>
            </div>
        </div>
      <?php
    }
    else echo "cacat";
    mysqli_free_result($result);
}
else{?>
  <div class="container-fluid">
    ...
  </div>
<?php
}
?>
<?php
  if(isset($_SESSION['username']) && $gasit==true){
    ?>
    <div class="container pb-cmnt-container">
    <div class="row" align="left">
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-info">
                <div class="panel-body">
                    <textarea placeholder="Adauga un comentariu." name="comment" class="pb-cmnt-textarea" form="comment"></textarea>
                    <form action="addcomment.php" class="form-inline" id="comment" method="POST">
                        <input type="submit" name="submit" class="w3-button w3-blue w3-hover-green" value="Trimite comentariu">
                    </form>
                 </div>
            </div>
        </div>
     </div>
</div>
<?php
   }
  
    ?>
    <br>
    <?php
    $sql = "SELECT * FROM comments WHERE id_event='$idevent' ORDER BY comment_time DESC";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){ ?>
            <div class="col-md-6 col-md-offset-1">
              <h1>Comentarii:</h1><br>
            </div>
            <?php
            while($row = mysqli_fetch_array($result)){
                $username = $row['username'];
                $comment = $row['comment'];
                $date = $row['comment_time'];
                ?>
                <div  class="row" align="left">
                  <div  id="comment" class="col-md-6 col-md-offset-1">
                    <div class="panel panel-info">
                      <header><b>Utilizator:</b> <?php echo $username;?> - <span> <b>Data: </b><?php echo $date?></span></header><br>
                      <p><?php echo $comment;?></p>

                    </div>
                  </div>
                </div>
            <?php
            }
            // Free result set
            mysqli_free_result($result);
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }?>
<?php if($gasit == false){?> <br><br>
        <div class="col-md-6 col-md-offset-4">
          <h1>Acest eveniment nu există!</h1><br>
        </div>
<?php } ?>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p>Created by Baies Darius-Florin</p>
</footer>
</body>
</html>