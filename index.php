<?php
include "connection.php";
session_start();
if (isset($_POST['submit_user'])) {
    $usrid = $_POST['user'];
    $get_name = mysqli_fetch_assoc(mysqli_query($link, "SELECT `naam` FROM `Participants` WHERE `id` = $usrid")) or die(mysqli_error($link));
    if ($get_name['naam'] == "admin") {
        echo "<form action='admin_login.php' method='POST' id='form'>";
        echo "<label for='fname'>password:</label>";
        echo "<input type='password' id='password' name='password'><br><br>";
        echo "<input type='submit' class='button-34' value='submit' id='submit' name='submit'></form><br>";
    }
    else {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }    
        else {  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        $datetime = date("Y-m-d H:i:s");
        $usridgot = $_POST['user'];
        mysqli_query($link, "INSERT INTO `Log`(`user_from`, `type`, `time`) VALUES ('$usridgot', '$ip', '$datetime')") or die(mysqli_error($link)); 
        $_SESSION['username'] = $_POST['user'];
    }
}
if (isset($_SESSION['username'])) {
    $yes = $_SESSION['username'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `Participants` WHERE `id`=$yes"));
    echo "Current user: " . $result['naam'] . "<br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<form action='index.php' method='POST' id='form_user'>";
            echo "<div class='select'>";
            echo "<select name='user' id='user'>";
                $res = mysqli_query($link, "SELECT * FROM `Participants`");
                while($row = mysqli_fetch_assoc($res)) {
                    echo '<option value="' . $row['id'] . '">' . $row['naam'] . '</option>';
                }
            echo "</select>";
            echo "</div><br>";
            echo "<input type='submit' class='button-34' value='login to set user', id='submit_user', name='submit_user'/>";
            echo "</form><br><br><br>";
        }
        else {
            echo "<br><form action='logout.php' method='POST' id='form_user'>";
            echo "<input type='submit' class='button-34' value='logout', id='logout_user', name='logout_user'/>";
            echo "</form>";
        }
        ?>
        <form action="inserter.php" method="POST" id="form">
            <input type="submit" class="button-34" value="add your user" id="submit" name="submit">
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<br>";    
        }
        ?>
        <form action="info.php" method="POST" id="form">
            <input type="submit" class="button-34" value="Info/instructions" id="submit" name="submit">
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<br>";    
        }
        ?>
        <form action="inserter_g.php" method="POST" id="form">
            <input type="submit" class="button-34" value="insert gift (admin)" id="submit" name="submit">
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<br>";    
        }
        ?>
        <form action="summary.php">
            <input type="submit" class="button-34" value="view current standings"/>
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<br>";    
        }
        ?>
        <form action="steal.php">
            <input type="submit" class="button-34" value="steal a gift"/>
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<br>";    
        }
        ?>
        <form action="give.php">
            <input type="submit" class="button-34" value="give a gift"/>
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<br>";    
        }
        ?>
        <form action="log.php">
            <input type="submit" class="button-34" value="log"/>
        </form>
    </body>
</html>
<?php
if(isset($_POST['refresh'])) {
    echo "USERNAME WAS NOT SET, PLEASE SET USERNAME ON TOP OF PAGE!";
}
?>