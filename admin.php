<?php

header("Content-Type: text/html; charset=UTF-8");

$apiUrl = "http://localhost/products/indexx.php";

$message = "";
$error = "";


// ==================================================
// LISÄÄ TUOTE
// ==================================================

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_product"])) {

    $data = [
        "name" => $_POST["name"],
        "price" => $_POST["price"],
        "description" => $_POST["description"],
        "category" => $_POST["category"]
    ];

    $options = [
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n",
            "content" => json_encode($data),
            "ignore_errors" => true
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents(
        $apiUrl,
        false,
        $context
    );

    if ($result !== false) {
        $message = "Tuote lisätty onnistuneesti!";
    } else {
        $error = "Tuotteen lisääminen epäonnistui.";
    }
}


// ==================================================
// PÄIVITÄ TUOTE
// ==================================================

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_product"])) {

    $id = (int)$_POST["id"];

    $data = [
        "name" => $_POST["name"],
        "price" => $_POST["price"],
        "description" => $_POST["description"],
        "category" => $_POST["category"]
    ];

    $options = [
        "http" => [
            "method" => "PUT",
            "header" => "Content-Type: application/json\r\n",
            "content" => json_encode($data),
            "ignore_errors" => true
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents(
        $apiUrl . "?id=" . $id,
        false,
        $context
    );

    if ($result !== false) {
        $message = "Tuote päivitetty onnistuneesti!";
    } else {
        $error = "Tuotteen päivittäminen epäonnistui.";
    }
}


// ==================================================
// POISTA TUOTE
// ==================================================

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_product"])) {

    $id = (int)$_POST["id"];

    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
            "ignore_errors" => true
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents(
        $apiUrl . "?id=" . $id,
        false,
        $context
    );

    if ($result !== false) {
        $message = "Tuote poistettu onnistuneesti!";
    } else {
        $error = "Tuotteen poistaminen epäonnistui.";
    }
}


// ==================================================
// HAETAAN TUOTTEET
// ==================================================

$json = file_get_contents($apiUrl);

$products = json_decode($json, true);

if (!is_array($products)) {
    $products = [];
}

?>

<!DOCTYPE html>
<html lang="fi">

<head>

<meta charset="UTF-8">

<title>Tuotteiden hallinta</title>

<style>

body {
    font-family: Arial, sans-serif;
    background: #f2f2f2;
    margin: 0;
    padding: 30px;
}

.container {
    max-width: 1100px;
    margin: auto;
}

h1 {
    color: #222;
}

.box {
    background: white;
    padding: 25px;
    margin-bottom: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.message {
    background: #d4edda;
    color: #155724;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.error {
    background: #f8d7da;
    color: #721c24;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

label {
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea {
    min-height: 80px;
}

button {
    padding: 10px 16px;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

.add {
    background: #28a745;
}

.update {
    background: #007bff;
}

.delete {
    background: #dc3545;
}

.product {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
}

.product h3 {
    margin-top: 0;
}

.product-info {
    background: #f8f8f8;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
}

.actions {
    margin-top: 15px;
}

</style>

</head>

<body>

<div class="container">

<h1>Tuotteiden hallinta</h1>


<?php if ($message): ?>

<div class="message">
    <?= htmlspecialchars($message) ?>
</div>

<?php endif; ?>


<?php if ($error): ?>

<div class="error">
    <?= htmlspecialchars($error) ?>
</div>

<?php endif; ?>


<!-- ================================================= -->
<!-- LISÄÄ TUOTE -->
<!-- ================================================= -->

<div class="box">

<h2>Lisää uusi tuote</h2>

<form method="POST">

<label>Tuotteen nimi</label>

<input
    type="text"
    name="name"
    placeholder="Esim. Kahvikuppi"
    required
>


<label>Hinta</label>

<input
    type="number"
    name="price"
    step="0.01"
    placeholder="Esim. 19.99"
    required
>


<label>Kuvaus</label>

<textarea
    name="description"
    placeholder="Tuotteen kuvaus"
    required
></textarea>


<label>Kategoria</label>

<input
    type="text"
    name="category"
    placeholder="Esim. Keittiö"
    required
>


<button
    class="add"
    type="submit"
    name="add_product"
>
    Lisää tuote
</button>

</form>

</div>


<!-- ================================================= -->
<!-- TUOTTEET -->
<!-- ================================================= -->

<div class="box">

<h2>Tuotteet</h2>


<?php if (count($products) === 0): ?>

<p><strong>Tuotteita ei ole vielä.</strong></p>

<p>
Lisää ensimmäinen tuote yllä olevalla lomakkeella.
</p>

<?php else: ?>


<?php foreach ($products as $product): ?>

<div class="product">

<h3>
    <?= htmlspecialchars($product["name"]) ?>
</h3>


<div class="product-info">

<strong>ID:</strong>
<?= htmlspecialchars($product["id"]) ?>

<br><br>

<strong>Hinta:</strong>
<?= htmlspecialchars($product["price"]) ?> €

<br><br>

<strong>Kuvaus:</strong>
<?= htmlspecialchars($product["description"]) ?>

<br><br>

<strong>Kategoria:</strong>
<?= htmlspecialchars($product["category"]) ?>

</div>


<!-- ================================================= -->
<!-- PÄIVITYS -->
<!-- ================================================= -->

<h3>Muokkaa tuotetta</h3>

<form method="POST">

<input
    type="hidden"
    name="id"
    value="<?= htmlspecialchars($product["id"]) ?>"
>


<label>Nimi</label>

<input
    type="text"
    name="name"
    value="<?= htmlspecialchars($product["name"]) ?>"
    required
>


<label>Hinta</label>

<input
    type="number"
    name="price"
    value="<?= htmlspecialchars($product["price"]) ?>"
    step="0.01"
    required
>


<label>Kuvaus</label>

<textarea
    name="description"
    required
><?= htmlspecialchars($product["description"]) ?></textarea>


<label>Kategoria</label>

<input
    type="text"
    name="category"
    value="<?= htmlspecialchars($product["category"]) ?>"
    required
>


<div class="actions">

<button
    class="update"
    type="submit"
    name="update_product"
>
    Päivitä tuote
</button>

</div>

</form>


<!-- ================================================= -->
<!-- POISTO -->
<!-- ================================================= -->

<form method="POST" style="margin-top:15px;">

<input
    type="hidden"
    name="id"
    value="<?= htmlspecialchars($product["id"]) ?>"
>

<button
    class="delete"
    type="submit"
    name="delete_product"
    onclick="return confirm('Haluatko varmasti poistaa tämän tuotteen?');"
>
    Poista tuote
</button>

</form>


</div>

<?php endforeach; ?>


<?php endif; ?>

</div>

</div>

</body>

</html>
