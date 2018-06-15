<!DOCTYPE html>
<html>
    <title>Evenimente Brasov</title>
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
    </style>
    <body>
        <?php
        require_once 'config.php';
        session_start();
        $eventtype = $_GET['type'];
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
            <?php } 
        ?>
        <br><br>
        <center>
        <h1>Evenimente : <?php echo $eventtype;?> </h1>
        <?php
            
            // Attempt select query execution
            $sql = " SELECT * FROM events WHERE type_event = '$eventtype'";
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
                                    <?php $_SESSION['idevent']=$idevent;?>
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
        <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
            <p>Created by Baies Darius-Florin</p>
        </footer>
    </body>
</html>