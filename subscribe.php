<?php
require_once 'config.php';
session_start();
$user = $_SESSION['username'];
$idev = $_SESSION['idevent'];
$insert = "INSERT INTO userevents ". "(id_event,username) ". "VALUES('$idev','$user')";
mysqli_query($link, $insert);
header("location: event.php?id=$idev");
?>