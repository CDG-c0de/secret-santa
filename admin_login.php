<?php
include "connection.php";
session_start();
if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Admin`")) or die(mysqli_error($link));
    if (password_verify($password, $result['passwd'])) {
        $result2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT id FROM `Participants` WHERE `naam` = 'admin'")) or die(mysqli_error($link));
        $_SESSION['username'] = $result2['id'];
        header("location:index.php");
    }
    else {
        header("location:index.php");
    }
}
else {
    header("location:index.php");
}
?>