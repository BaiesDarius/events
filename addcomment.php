<?php
require_once 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $idevent = $_SESSION['idevent'];
    $username = $_SESSION['username'];
    $comment = $_POST['comment'];
    $insert = "INSERT INTO comments (id_event,username,comment) VALUES('$idevent','$username','$comment')";
    mysqli_query($link, $insert);
    header("location: event.php?id=$idevent");
}
?>