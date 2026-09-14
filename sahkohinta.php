<?php
// API: Tänään ja huomenna hinnat
$apiUrl = "https://api.spot-hinta.fi/Today";

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if (!$data) {
    die("Ei saatu dataa.");
}

echo "<h2>Pörssisähkön tuntihinnat tänään</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Aloitusaika</th><th>Hinta (c/kWh, ALV sis.)</th></tr>";

foreach ($data as $row) {
    echo "<tr>";
    echo "<td>" . $row['DateTime'] . "</td>";
    echo "<td>" . number_format($row['PriceWithTax'], 2) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
