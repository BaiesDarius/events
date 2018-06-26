<!DOCTYPE html>
<html>
<title>Evenimente Brasov</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,900' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
.moving-letters {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    margin: auto;
    height: 200px;
  }
.title {
    position: relative;
    font-weight: 500;
    font-size: 3em;
  }
  
  .title .text-wrapper {
    position: relative;
    display: inline-block;
    padding-top: 0.2em;
    padding-right: 0.05em;
    padding-bottom: 0.1em;
    overflow: hidden;
  }
  
  .title .letter {
    display: inline-block;
    line-height: 1em;
    transform-origin: 0 0;
  }
</style>
<style type="text/css">
    #content {
        width:250px;
        height:150px;
}
</style>
<body>
<?php
// Initialize the session
session_start();
 
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){?>
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Acasa</a>
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
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Acasa</a>
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

<!-- Header -->

<header class="w3-display-container w3-content w3-center" style="max-width:2000px">
<img class="w3-image" src="images/index.jpg" alt="Me" width="2000" height="600">
<div class="w3-display-middle w3-padding-large w3-border w3-wide w3-text-light-grey w3-center">
    <h1 class="title">
        <span class="text-wrapper">
            <span class="letters">Evenimente</span><br>
            <span class="letters">Brasov</span>
        </span>
    </h1>

    <script>
    $('.title .letters').each(function(){
        $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
    });
    
    anime.timeline({loop: true})
        .add({
        targets: '.title .letter',
        rotateY: [-90, 0],
        duration: 1300,
        delay: function(el, i) {
            return 45 * i;
        }
        }).add({
        targets: '.title',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
        });
    </script>
    <?php if(!isset($_SESSION['username']) || empty($_SESSION['username'])){?>
    <p class="w3-xlarge">Fii la curent cu toate evenimentele care au loc in orasul Brasov.</p>
  <?php }
    else{?>
    <p class="w3-xlarge">Bine ai venit, <?php echo htmlspecialchars($_SESSION['username']); ?>! Fii la curent cu toate evenimentele care au loc in orasul Brasov.</p>
    <?php } ?>
  </div>
</header>
<center>
<?php
    require_once 'config.php';
    
    // Attempt select query execution
    $sql = "SELECT * FROM events ORDER BY date_event";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){ ?>
        <br>
        <div class="w3-row-padding">
            <?php
            $count = 1;
            while($row = mysqli_fetch_array($result)){
                $idevent = $row['id_event'];
                $title = $row['title_event'];
                $description = $row['description_event'];
                $location = $row['location_event'];
                $date = $row['date_event'];
                $phone = $row['phone_event'];
                $image = $row['imagepath_event'];
                $type = $row['type_event'];
                if ($count % 4 == 1){
                    echo "<div class='w3-row-padding w3-border'>";
                    echo "<br>";
                }
                ?>
                    <div class="w3-quarter w3-container w3-margin-bottom">
                        <?php echo "<img src='"?>
                        <?php echo $image;?>
                        <?php echo "'width=200 height=250/>" ?>
                        <div class="w3-container w3-white">
                            <h3>
                            <a href="event.php?id=<?php echo $idevent; ?>"><?php echo $title;?></a>
                            </h3>
                            <br>
                            <?php echo "Tip eveniment:  "?>
                            <?php echo $type;?>
                            <br>
                            <?php echo "Locatia:  "?>
                            <?php echo $location;?>
                            <br>
                            <?php echo "Data:  "?>
                            <?php echo $date;?>
                            <br>
                            <?php echo "Numar de telefon: "?>
                            <?php echo $phone;?>
                        </div>
                    </div>

            <?php
                        if ($count % 4 == 0){
                            echo "<br>";
                            echo "</div>";
                        }
                        $count = $count + 1;
            }
            // Free result set
            mysqli_free_result($result);
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
?>
</center>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p>Created by Baies Darius-Florin</p>
</footer>

</body>
</html>
