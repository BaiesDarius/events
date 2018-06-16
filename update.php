<?php
require_once 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $idevent = $_SESSION['idevent'];
    echo $idevent;
    $title = $_POST['title'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $imagepath = $_POST['imagepath'];
    $update = "UPDATE events  SET title_event = '$title', type_event = '$type', description_event = '$description', location_event = '$location', date_event = '$date', phone_event = '$phone', imagepath_event = '$imagepath' WHERE id_event = $idevent";
    mysqli_query($link, $update);
    header("location: event.php?id=$idevent");
}
?>