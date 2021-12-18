<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $usrname = $_SESSION['username'];
        include "connection.php";
        if (isset($_POST['submit']) && isset($_POST['gift'])) {
            $gift = htmlspecialchars(mysqli_real_escape_string($link, $_POST['gift']));
            $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT P.id, P.naam FROM Participants P WHERE P.id IN (SELECT L.par_id from Link L WHERE L.gift_id=$gift)"));
            mysqli_query($link, "UPDATE `Link` SET `par_id`=$usrname WHERE `gift_id`=$gift") or die(mysqli_error($link));
            $thing = $result['id'];
            $datetime = date("Y-m-d H:i:s");
            mysqli_query($link, "INSERT INTO `Log`(`user_from`, `user_to`, `type`, `gift`, `time`) VALUES ('$usrname', '$thing', 'stole', '$gift', '$datetime')") or die(mysqli_error($link));
            echo "<form action='summary.php' method='POST' id='form_refresh'>";
            echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
            echo "</form>";
            echo "<script>document.getElementById('form_refresh').submit()</script>";
        }
        else {
            echo "<form action='steal.php' method='POST' id='form_refresh'>";
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