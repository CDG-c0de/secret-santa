<link rel="stylesheet" href="style.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<?php
if (isset($_POST['refresh'])) {
    echo "<span style='color: #FF0000 ;'>Inserting failed, are you sure you properly filled out the form?</span>";
}
?>
<form action="inserter_php.php" method="POST" id="form">
        <label for="fname">name:</label>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" class='button-34' value="CHOOSE YOUR PLAYER!" id="submit" name="submit">
</form><br>
<form action='index.php' method='POST' id='form'>
    <input type='submit' class='button-34' value='home' id='submit2' name='submit'>
</form>
