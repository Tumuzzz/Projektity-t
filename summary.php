<?php

date_default_timezone_set('Europe/Helsinki');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nimi = htmlspecialchars($_POST['nimi'] ?? '');
    $ryhma = htmlspecialchars($_POST['ryhma'] ?? '');
    $aihe = htmlspecialchars($_POST['aihe'] ?? '');
    $palaute = htmlspecialchars($_POST['palaute'] ?? '');
    $arvosana = htmlspecialchars($_POST['arvosana'] ?? '');
    $vastauspyynto = htmlspecialchars($_POST['vastauspyynto'] ?? 'Ei');
    $sahkoposti = htmlspecialchars($_POST['sahkoposti'] ?? '');
    
    
    $lahetysaika = date('d.m.Y H:i:s');
} else {
    
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Palautteen yhteenveto</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .summary-box { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px; max-width: 600px; }
        ul { list-style-type: none; padding: 0; }
        li { margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dashed #eee; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #0066cc; }
    </style>
</head>
<body>
    <div class="summary-box">
        <h1>Kiitos palautteestasi!</h1>
        <p>Palautteesi on vastaanotettu onnistuneesti. Tässä on yhteenveto lähettämistäsi tiedoista:</p>
        
        <ul>
            <li><strong>Käyttäjän nimi:</strong> <?php echo $nimi; ?></li>
            <li><strong>Opiskelijaryhmä:</strong> <?php echo $ryhma; ?></li>
            <li><strong>Palautteen aihe:</strong> <?php echo $aihe; ?></li>
            <li><strong>Palauteteksti:</strong> <br><?php echo nl2br($palaute); ?></li>
            <li><strong>Arvosana:</strong> <?php echo $arvosana; ?></li>
            <li><strong>Vastauspyyntö:</strong> <?php echo $vastauspyynto; ?></li>
            <?php if (!empty($sahkoposti)): ?>
                <li><strong>Sähköpostiosoite:</strong> <?php echo $sahkoposti; ?></li>
            <?php endif; ?>
            <li><strong>Lähetysaika:</strong> <?php echo $lahetysaika; ?></li>
        </ul>
        
        <a class="back-link" href="index.php">← Takaisin pääsivulle</a>
    </div>
</body>
</html>