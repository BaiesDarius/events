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

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-blue">Home</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Link 4</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-blue w3-center" style="padding:64px 16px">
  <h1 class="w3-margin w3-jumbo">Evenimente Brasov</h1>
  <p class="w3-xlarge">Fii la curent cu toate evenimentele care au loc in orasul Brasov. Printre multe altele aici poti gasi informatii despre concerte, festivaluri, piese de teatru si filme.</p>
</header>
<?php
    $link = mysqli_connect("localhost", "root", "", "events");
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    // Attempt select query execution
    $sql = "SELECT * FROM events";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){ ?>
            <div class="w3-row-padding w3-padding-16 w3-center w3-border">
            <?php
            $count = 1;
            while($row = mysqli_fetch_array($result)){
                $title = $row['title_event'];
                $description = $row['description_event'];
                $location = $row['location_event'];
                $date = $row['date_event'];
                $phone = $row['phone_event'];
                $image = $row['imagepath_event'];
                $type = $row['type_event'];
                $count = $count + 1;
                ?>
                    <div class="w3-quarter w3-content">
                        <?php echo "<img src='"?>
                        <?php echo $image;?>
                        <?php echo "'width=200 height=250/>" ?>
                        <h3>
                        <?php echo $title;?>
                        </h3>
                        <div id=content>
                        <?php echo $description; ?>
                        </div>
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
                <?php
                if ($count % 5 == 0){
                    ?>
                    </div>
                    <div class="w3-row-padding w3-padding-16 w3-center w3-border">
                <?php } ?> 

                
            <?php
            }
            // Free result set
            mysqli_free_result($result);
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
?>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p>Created by Baies Darius-Florin</p>
</footer>

</body>
</html>
