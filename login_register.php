<link rel="stylesheet" href="style.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<?php
if (isset($_POST['refresh'])) {
    echo "<span style='color: #FF0000 ;'>Registering failed, maybe username already exists in database?</span>";
}
if (isset($_POST['refresh2'])) {
    echo "<span style='color: #FF0000 ;'>Login failed, are you sure you properly filled out username and password?</span>";
}
?>
<form action="login.php" method="POST" id="form">
        <label for="fname">username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="fpasswd">password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" class='button-34' value="Login" id="submit" name="submit">
</form><br>
<form action="register.php" method="POST" id="form2">
        <label for="fname">username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="fpasswd">password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" class='button-34' value="Register" id="submit" name="submit">
</form><br>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='home' id='submit2' name='submit'>
</form>
