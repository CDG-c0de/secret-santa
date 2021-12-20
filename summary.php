<link rel="stylesheet" href="style.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<?php 
    include "connection.php";
    $users = mysqli_query($link, "SELECT * FROM `Participants`");
    if(mysqli_num_rows($users)) {
        while($row = mysqli_fetch_assoc($users)) {
        $name = $row['naam'];
        $par_id = $row['id'];
        echo "<span style='color: #DE3163;'>" . $name . "</span><br>";
        $gifts = mysqli_query($link, "SELECT G.id, G.code, G.des FROM Gifts G WHERE G.id IN (SELECT L.gift_id FROM Link L WHERE L.par_id = '$par_id')");
        if(mysqli_num_rows($gifts)) {
            while($row2 = mysqli_fetch_assoc($gifts)) {
                $get_des = $row2['des'];
                $get_code = $row2['code'];
                echo "<span style='color: #27ae60 ;'>key: </span>";
                echo "<span style='color: #85c1e9 ;'>" . $get_code . "</span>";
                echo "<span style='color: #27ae60 ;'> description: </span>";
                echo "<span style='color: #85c1e9 ;'>" . $get_des . "</span><br>";
            }
            echo "<br>";
        }
        else {
            echo "<br>";
        }
      }
    }
    else {
        echo "No existing users";
    }
?>
<form action='summary.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='refresh' id='submit' name='submit'>
</form>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='home' id='submit' name='submit'>
</form>