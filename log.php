<link rel="stylesheet" href="style.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<?php
    session_start();
    $usrname = $_SESSION['username'];
    include "connection.php";
    $result = mysqli_query($link, "SELECT * FROM `Log`") or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['type'] != "stole" && $row['type'] != "gave") {
            $usr_from_id = $row['user_from'];
            $user_from = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `id`=$usr_from_id"))['naam'];
            $ip = $row['type'];
            $time = $row['time'];
            echo "<span style='color: #85c1e9 ;'>$ip </span>";
            echo "logged in as ";
            echo "<span style='color: #27ae60 ;'>$user_from </span>";
            echo "at ";
            echo "<span style='color: #85c1e9 ;'>$time</span><br>";
        }
        else {
            $gift_id = $row['gift'];
            $des = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Gifts` WHERE `id`=$gift_id"))['des'];
            $usr_from_id = $row['user_from'];
            $user_from = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `id`=$usr_from_id"))['naam'];
            $usr_to_id = $row['user_to'];
            $user_to = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `id`=$usr_to_id"))['naam'];
            echo "<span style='color: #27ae60 ;'>$user_from </span>";
            echo $row['type'] . " ";
            echo "<span style='color: #85c1e9 ;'>$des </span>";
            if ($row['type'] == "stole") {
                echo "from ";
            }
            if ($row['type'] == "gave") {
                echo "to ";
            }
            echo "<span style='color: #27ae60 ;'>$user_to </span>";
            echo "at ";
            $time = $row['time'];
            echo "<span style='color: #85c1e9 ;'>$time</span><br>";
        }
    }
?>
<br>
<form action='log.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='refresh' id='submit' name='submit'>
</form>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='home' id='submit' name='submit'>
</form>