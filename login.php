<?php
session_start();

$nimi = "";
$ryhma = "";
$virhe = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nimi = $_POST["nimi"];
    $ryhma = $_POST["ryhma"];
    $salasana = $_POST["salasana"];

    if ($nimi != "" && $ryhma != "" && $salasana == "php123") {

        $_SESSION["nimi"] = $nimi;
        $_SESSION["ryhma"] = $ryhma;
        $_SESSION["loggedin"] = true;

        header("Location: index.php");
        exit();

    } else {
        $virhe = "Kirjautuminen epäonnistui.";
    }
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
<meta charset="UTF-8">
<title>Kirjautuminen</title>
</head>
<body>

<h1>Kirjautuminen</h1>

<p style="color:red;"><?php echo $virhe; ?></p>

<form method="post">

Nimi:<br>
<input type="text" name="nimi" value="<?php echo $nimi; ?>"><br><br>

Opiskelijaryhmä:<br>
<input type="text" name="ryhma" value="<?php echo $ryhma; ?>"><br><br>

Salasana:<br>
<input type="password" name="salasana"><br><br>

<input type="submit" value="Kirjaudu">

</form>

</body>
</html>