<link rel="stylesheet" href="style.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<?php
session_start();
include "connection.php";
if (isset($_SESSION['username'])) {
    $yes = $_SESSION['username'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `id`=$yes"));
    echo "Current user: " . $result['naam'] . "<br>";
}
else {
    echo "<form action='index.php' method='POST' id='form_refresh'>";
    echo "<input type='hidden' id='refresh' name='refresh' value='refresh'>";
    echo "</form>";
    echo "<script>document.getElementById('form_refresh').submit()</script>";
}
if (isset($_POST['refresh'])) {
    echo "<span style='color: #FF0000 ;'>Gifting failed, are you sure you properly filled out the form?</span>";
}
?>
<form action="give_php.php" method="POST" id="form">
        <label for="fname">Gift to give:</label>
        <div class='select'>
        <select name='gift' id='gift'>
        <?php
            $yes = $_SESSION['username'];
            $res = mysqli_query($link, "SELECT G.id, G.code, G.des FROM Gifts G WHERE G.id IN (SELECT L.gift_id FROM Link L WHERE L.par_id = $yes)");
            while($row = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $row['id'] . '">' . 'key: ' . $row['code'] . ' des.: ' . $row['des'] . '</option>';
            }
        ?>
        </select>
        </div>
        <label for="fname">Person to gift:</label>
        <div class='select'>
        <select name='per' id='per'>
        <?php
            $usrid = $_SESSION['username'];
            $res = mysqli_query($link, "SELECT * FROM `Participants` WHERE `id` != $usrid");
            while($row = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $row['id'] . '">' . $row['naam'] . '</option>';
            }
        ?>
        </select>
        </div>
        <br>
        <input type='submit' class="button-34" value='give' id='submit' name='submit'>
</form><br>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class="button-34" value='home' id='submit' name='submit'>
</form>