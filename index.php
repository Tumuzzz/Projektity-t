<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Etusivu</title>
    <link rel="stylesheet" href="tyyli.css">
</head>

<body>

<h1>Palautesovellus</h1>
<form method="post" action="">
    <label>Etunimi:</label>
    <input type="text" name="fname" required><br><br>

    <label>Sukunimi:</label>
    <input type="text" name="lname" required><br><br>

    <input type="submit" value="Tallenna">
</form>

<p>Tällä sovelluksella voit kirjautua ja antaa palautetta.</p>

<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    echo "<p>Olet kirjautunut käyttäjänä " . $_SESSION["nimi"] . ".</p>";
} else {
    echo "<p>Et ole kirjautunut sisään.</p>";
}
?>

<p><a href="login.php">Kirjaudu</a></p>
<p><a href="feedback.php">Palautelomake</a></p>
<p><a href="logout.php">Kirjaudu ulos</a></p>

<?php
$fname = $_POST['fname'] ?? null;
$lname = $_POST['lname'] ?? null;

if ($fname && $lname) {
    setcookie("fname", $fname, time() + 36000);
    setcookie("lname", $lname, time() + 36000);

    // Päivitetään sivu, jotta evästeet ovat heti käytettävissä
    header("Location: index.php");
    exit;
}

echo "" . ($_COOKIE['fname'] ?? '') . "<br>";
echo " " . ($_COOKIE['lname'] ?? '') . "<br>";
?>


</body>
</html>





