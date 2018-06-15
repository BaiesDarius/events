<?php
require_once 'config.php';
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $imagepath = $_POST['imagepath'];
    $insert = "INSERT INTO events (title_event,type_event,description_event,location_event,date_event,phone_event,imagepath_event) VALUES('$title','$type','$description','$location','$date','$phone','$imagepath')";
    mysqli_query($link, $insert);
    header("location: admin.php");
}
?>