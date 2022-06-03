<?php
# init
# include("ini/inc.php");

# Collection und Daten
$collection = 'tutorial';
$data = 'products';

# Funktion getCollection laden
include("assets/php/get-collection.php");

# Ergebnis
getCollection($connection, $collection, $data);
