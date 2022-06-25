<?php
# save single request
if (!isset($correct)) {
    die();
}

/**
 * 
 * Funktion : getCollection
 * holt die Werte aus der noSQL-Datenbank
 * 
 * 
 */


# Container
$container = '';

$connection = 'mongodb+srv://gutesewetter:Ennosgrande666@cluster0.9qvto.mongodb.net';



# ist die PHP-Erweiterung "mongodb" vorhanden
if (extension_loaded("mongodb")) {

    try {
        # startet den Manager zum Aufbau einer Verbindung
        $manager = new MongoDB\Driver\Manager($connection_cluster);

        $bulk = new MongoDB\Driver\BulkWrite();
        $bulk->insert(['x' => 2]);

        #$manager->executeBulkWrite($collection . $data, $bulk);

        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
        $result = $manager->executeBulkWrite('' . $collection . '.' . $data . '', $bulk, $writeConcern);

        printf("Inserted %d document(s)\n", $result->getInsertedCount());

        # Abfrage
        #$query = new MongoDB\Driver\Query([]);

        # Auswahl der Collection und Daten / Dokumente
        # $cursor = $manager->executeQuery("" . $collection . '.' . $data . "", $query);
        #$cursor = $manager->executeReadWriteCommand("" . $collection . '.' . $data . "", $query);



    } catch (MongoConnectionExeption $error) {
        var_dump($error);
    }
} else {
    array_push($error_msg, 'PHP-MongoDB-Erweiterung installieren');
}

# Ausgabe der Fehlermeldungen
if (count($error_msg) >= 1) {

    echo '<h3>Fehlende Werte : ' . count($error_msg) . '</h3>';

    foreach ($error_msg as $value) {
        echo $value . '<br>';
    }
}

# Ausgabe der Ergebnisse
echo '<h3>Ergebnisse :</h3>';
echo '' . $container . '<br>';
