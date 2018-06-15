<?php
require_once 'config.php';
session_start();
$user = $_SESSION['username'];
$idev = $_SESSION['idevent'];
$delete = "DELETE FROM userevents WHERE id_event = '$idev' AND username = '$user'";
mysqli_query($link, $delete);
header("location: event.php?id=$idev");
?>