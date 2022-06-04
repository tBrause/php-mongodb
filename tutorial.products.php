<?php
# init
# include("ini/inc.php");

# Collection und Daten
$collection = 'tutorial';
$data = 'products';

$name = ["name", "price", "categorie", "views", "ratings"];
$name_arrays = ["user", "stars"];

# Funktion getCollection laden
require("assets/php/get-collection.php");

# Ergebnis
getCollection($connection, $collection, $name, $name_arrays, $data, $error_msg);
