<?php
    session_start();
    if (isset($_SESSION['username'])) {
        include "connection.php";
        $key = htmlspecialchars(mysqli_real_escape_string($link, $_POST['key']));
        $des = htmlspecialchars(mysqli_real_escape_string($link, $_POST['des']));
        $user_id = htmlspecialchars(mysqli_real_escape_string($link, $_POST['user']));
        if (isset($_POST['submit'])) {
                mysqli_query($link, "INSERT INTO `Gifts`(`code`, `des`) VALUES ('$key', '$des')") or die(mysqli_error($link));
                $gift_id1 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Gifts` WHERE `code` = '$key' AND `des` = '$des'"));
                $gift_id = $gift_id1['id'];
                mysqli_query($link, "INSERT INTO `Link`(`par_id`, `gift_id`) VALUES ('$user_id', '$gift_id')") or die(mysqli_error($link));
                echo "<form action='summary.php' method='POST' id='form_refresh'>";
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
<form action='index.php' method='POST' id='form'>
    <input type='submit' value='home' id='submit' name='submit'>
</form>