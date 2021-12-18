<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $usrname = $_SESSION['username'];
        include "connection.php";
        if (isset($_POST['submit']) && isset($_POST['gift']) && isset($_POST['per'])) {
            $gift = htmlspecialchars(mysqli_real_escape_string($link, $_POST['gift']));
            $per = htmlspecialchars(mysqli_real_escape_string($link, $_POST['per']));
            mysqli_query($link, "UPDATE `Link` SET `par_id`=$per WHERE `gift_id`=$gift") or die(mysqli_error($link));
            $datetime = date("Y-m-d H:i:s");
            mysqli_query($link, "INSERT INTO `Log`(`user_from`, `user_to`, `type`, `gift`, `time`) VALUES ('$usrname', '$per', 'gave', '$gift', '$datetime')") or die(mysqli_error($link));
            echo "<form action='summary.php' method='POST' id='form_refresh'>";
            echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
            echo "</form>";
            echo "<script>document.getElementById('form_refresh').submit()</script>";
        }
        else {
            echo "<form action='give.php' method='POST' id='form_refresh'>";
            echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
            echo "</form>";
            echo "<script>document.getElementById('form_refresh').submit()</script>";
        }
    }
    else {
        echo "<form action='index.php' method='POST' id='form_refresh'>";
        echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
        echo "</form>";
        echo "<script>document.getElementById('form_refresh').submit()</script>";
    }
?>