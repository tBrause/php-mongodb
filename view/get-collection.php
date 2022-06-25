<?php
# save single request
if (!isset($correct)) {
    die();
}

# Collection und Daten
$collection = 'vissio';
$data = 'device';

# Funktion getCollection laden
require("assets/php/get-collection.php");

# Ergebnis
getCollection($connection_cluster, $collection, $data, $error_msg);
