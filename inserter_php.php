<?php
    include "connection.php";
    if (isset($_POST['submit'])) {
        $user = htmlspecialchars(mysqli_real_escape_string($link, $_POST['name']));
        $user2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `naam` = '$user'"));
        if($user2["naam"] == $user) {
            echo "<form action='inserter.php' method='POST' id='form_refresh'>";
            echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
            echo "</form>";
            echo "<script>document.getElementById('form_refresh').submit()</script>";
        }
        else {
            mysqli_query($link, "INSERT INTO `Participants`(`naam`) VALUES ('$user')") or die(mysqli_error($link));
            echo "<form action='summary.php' method='POST' id='form_refresh'>";
            echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
            echo "</form>";
            echo "<script>document.getElementById('form_refresh').submit()</script>";
        }
    }
?>