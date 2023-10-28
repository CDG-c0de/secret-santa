<?php
include "connection.php";
session_start();

if (isset($_POST['submit'])) {
    $username = htmlspecialchars(mysqli_real_escape_string($link, $_POST['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `naam` = '$username'"));
    if ($result) {
        echo "<form action='login_register.php' method='POST' id='form_refresh'>";
        echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
        echo "</form>";
        echo "<script>document.getElementById('form_refresh').submit()</script>";
    } else {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($link, "INSERT INTO `Participants`(`naam`, `passwd`) VALUES ('$username', '$hashed_pass')") or die(mysqli_error($link));
        $result2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `naam` = '$username'"));
        $usridgot = $result2['id'];
        $_SESSION['username'] = $usridgot;   
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }    
        else {  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        $datetime = date("Y-m-d H:i:s");
        mysqli_query($link, "INSERT INTO `Log`(`user_from`, `type`, `time`) VALUES ('$usridgot', '$ip', '$datetime')") or die(mysqli_error($link)); 
        header("location:index.php");
    }
}
else {
    header("location:index.php");
}
?>