<?php

// Julkisen REST API:n osoite
$url = "https://jsonplaceholder.typicode.com/posts";

// Lähetettävä data
$data = [
    "title" => "Uusi tuote",
    "body" => "Tämä on PHP:llä lähetetty POST-pyyntö.",
    "userId" => 1
];

// Muutetaan PHP-taulukko JSON-muotoon
$jsonData = json_encode($data);

// Aloitetaan cURL
$ch = curl_init($url);

// cURL-asetukset
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Content-Length: " . strlen($jsonData)
]);

// Lähetetään POST-pyyntö
$response = curl_exec($ch);

// Tarkistetaan virhe
if (curl_errno($ch)) {

    echo "<h1>Virhe</h1>";
    echo "<p>" . htmlspecialchars(curl_error($ch)) . "</p>";

} else {

    // Muutetaan vastaus PHP-taulukoksi
    $responseData = json_decode($response, true);

    echo "<h1>POST-pyyntö onnistui!</h1>";

    echo "<h2>Lähetetty data:</h2>";

    echo "<pre>";
    print_r($data);
    echo "</pre>";


    echo "<h2>API:n vastaus:</h2>";

    echo "<pre>";
    print_r($responseData);
    echo "</pre>";
}

// Suljetaan cURL
curl_close($ch);

?>
