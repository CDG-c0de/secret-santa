<link rel="stylesheet" href="style.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<?php
include "connection.php";
session_start();
if (!isset($_SESSION['username'])){
    echo "<form action='index.php' method='POST' id='form_refresh'>";
    echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
    echo "</form>";
    echo "<script>document.getElementById('form_refresh').submit()</script>";
}
if (isset($_SESSION['username'])) {
    $yes = $_SESSION['username'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `id`=$yes"));
    echo "Current user: " . $result['naam'];
}
if ($result['naam'] != "admin") {
    header("location:index.php");
}
?>
<form action="inserter_g_php.php" method="POST" id="form">
        <label for="fname">Key (optional):</label>
        <input type="text" id="key" name="key"><br>
        <label for="fname">Description (optional):</label>
        <input type="text" id="des" name="des"><br><br>
        <label for="fname">Participant to assign gift:</label>
        <div class='select'>
        <select name='user' id='user'>
        <?php
            $res = mysqli_query($link, "SELECT * FROM `Participants`");
            while($row = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $row['id'] . '">' . $row['naam'] . '</option>';
            }
        ?>
        </select>
        </div>
        <br>
        <input type='submit' class='button-34' value='insert' id='submit' name='submit'>
</form><br>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='home' id='submit' name='submit'>
</form>