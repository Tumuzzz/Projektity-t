<?php

// Aseta oma API-avaimesi tähän
$apiKey = "14dc1b1dcf57f3bf81b8993bc1197bc2" ;
$city = "Kuopio"; // Voit vaihtaa kaupungin nimen
$url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

// Alustetaan cURL-yhteys
$ch = curl_init();

// Asetetaan cURL:n asetukset
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Suoritetaan GET-pyyntö
$response = curl_exec($ch);

// Tarkistetaan, onko pyyntö onnistunut
if ($response === false) {
    echo "Virhe: " . curl_error($ch);
} else {
    // Jäsennellään JSON-datayhteys
    $data = json_decode($response, true);

    // Tarkistetaan, että data on saatavilla
    if (isset($data['main'])) {
        $temperature = $data['main']['temp']; // Temperaturen saaminen
        $weatherDescription = $data['weather'][0]['description']; // Sään kuvaus
        $cityName = $data['name']; // Kaupungin nimi

        // Tulostetaan tiedot näytölle
        echo "Kaupunki: " . $cityName . "<br>";
        echo "Lämpötila: " . $temperature . " °C<br>";
        echo "Sää: " . ucfirst($weatherDescription) . "<br>";
    } else {
        echo "Säätietoja ei löytynyt.";
    }
}

// Suljetaan cURL-yhteys
curl_close($ch);
?>