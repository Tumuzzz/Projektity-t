<?php
// JSON-objekti henkilöstä
$henkilo = '{
  "nimi": "Matti Meikäläinen",
  "ikä": 30,
  "osoite": "Esimerkkikatu 1, 00100 Helsinki"
}';

// JSON-taulukko kirjoista
$kirjat = '[
  {
    "nimi": "Tämä on kirja 1",
    "kirjailija": "Kirjailija A",
    "julkaisuvuosi": 2020
  },
  {
    "nimi": "Tämä on kirja 2",
    "kirjailija": "Kirjailija B",
    "julkaisuvuosi": 2021
  },
  {
    "nimi": "Tämä on kirja 3",
    "kirjailija": "Kirjailija C",
    "julkaisuvuosi": 2022
  }
]';

// Muutetaan JSON-objekti PHP-taulukoksi
$henkiloArray = json_decode($henkilo, true);
$kirjatArray = json_decode($kirjat, true);

// Tulostetaan henkilön tiedot
echo "Henkilön tiedot:\n";
echo "Nimi: " . $henkiloArray['nimi'] . "\n";
echo "Ikä: " . $henkiloArray['ikä'] . "\n";
echo "Osoite: " . $henkiloArray['osoite'] . "\n\n";

// Tulostetaan kirjat
echo "Kirjalista:\n";
foreach ($kirjatArray as $kirja) {
    echo "Nimi: " . $kirja['nimi'] . ", ";
    echo "Kirjailija: " . $kirja['kirjailija'] . ", ";
    echo "Julkaisuvuosi: " . $kirja['julkaisuvuosi'] . "\n";
}
?>