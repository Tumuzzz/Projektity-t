<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    echo "<h2>Kirjaudu ensin sisään.</h2>";
    echo '<a href="login.php">Kirjaudu</a>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
<meta charset="UTF-8">
<title>Palautelomake</title>
</head>
<body>

<h1>Palautelomake</h1>

<form action="summary.php" method="POST">

Palautteen aihe:<br><br>

<input type="radio" name="aihe" value="Opetus"> Opetus<br>
<input type="radio" name="aihe" value="Tehtävät"> Tehtävät<br>
<input type="radio" name="aihe" value="Työrauha"> Työrauha<br>
<input type="radio" name="aihe" value="Työvälineet"> Työvälineet<br>
<input type="radio" name="aihe" value="Muu"> Muu<br><br>

Numerointi:<br><br>
<input type="radio" name="numerointi" value="1"> 1<br>
<input type="radio" name="numerointi" value="2"> 2<br>
<input type="radio" name="numerointi" value="3"> 3<br>
<input type="radio" name="numerointi" value="4"> 4<br>
<input type="radio" name="numerointi" value="5"> 5<br><br>

<input type="submit" value="Lähetä">



</form>
<form action="https://formsubmit.co/tuomas1269@gmail.com" method="POST">
    Palaute:<br><br>
    <textarea name="palaute" rows="5" cols="40" required></textarea><br><br>
    <input type="submit" value="Lähetä">
</form>




</body>
</html>