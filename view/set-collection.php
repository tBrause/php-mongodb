<?php
# save single request
if (!isset($correct)) {
    die();
}

# Collection und Daten
$collection = 'fruits';
$data = 'long';

$name = ["name", "price", "categorie", "views", "ratings"];
$name_arrays = ["user", "stars"];

# Funktion setCollection laden
require("assets/php/set-collection.php");

# Ergebnis
# getCollection($connection, $collection, $name, $name_arrays, $data, $error_msg);
