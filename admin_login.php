<?php
include "connection.php";
session_start();

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Admin`")) or die(mysqli_error($link));
    if (password_verify($password, $result['passwd'])) {
        $result2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT id FROM `Participants` WHERE `naam` = 'admin'")) or die(mysqli_error($link));
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
    else {
        header("location:index.php");
    }
}
else {
    header("location:index.php");
}
?>