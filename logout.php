<?php
session_start();
if (isset($_POST['logout_user'])) {
    session_destroy();
}
header("location:index.php");
?>