<?php
require_once 'config.php';
session_start();
$idev = $_SESSION['idevent'];
$delete = "DELETE FROM events WHERE id_event = '$idev'";
mysqli_query($link, $delete);
header("location: index.php");
?>