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
    echo "<span style='color: #FF0000 ;'>Stealing failed, are you sure you properly filled out the form?</span>";
}
?>
<form action="steal_php.php" method="POST" id="form">
        <label for="fname">Gift to steal:</label>
        <div class='select'>
        <select name='gift' id='gift'>
        <?php
            $res = mysqli_query($link, "SELECT * FROM `Gifts`");
            while($row = mysqli_fetch_assoc($res)) {
                $tempid = $row['id'];
                $yes = $_SESSION['username'];
                $temp = mysqli_query($link, "SELECT P.id, P.naam FROM Participants P WHERE P.id IN (SELECT L.par_id FROM Link L WHERE L.gift_id = $tempid AND L.par_id != $yes) ");
                while ($row2 = mysqli_fetch_assoc($temp)) {
                    $bruh = $row2['naam'];
                    echo '<option value="' . $row['id'] . '">' . 'key: ' . $row['code'] . ' des.: ' . $row['des'] . ' user: ' . $bruh . '</option>';
                }
            }
        ?>
        </select>
        </div>
        <br>
        <input type='submit' class="button-34" value='steal' id='submit' name='submit'>
</form><br>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class="button-34" value='home' id='submit' name='submit'>
</form>