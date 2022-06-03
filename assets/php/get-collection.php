<?php

# getCollection
function getCollection($connection, $collection, $data)
{

    # Container
    $container = '';

    # Fehler
    $error_msg = [];


    # ist die PHP-Erweiterung "mongodb" vorhanden
    if (extension_loaded("mongodb")) {

        try {
            # startet den Manager zum Aufbau einer Verbindung
            $manager = new MongoDB\Driver\Manager($connection);

            # Abfrage
            $query = new MongoDB\Driver\Query([]);

            # Auswahl der Collection und Daten / Dokumente
            $cursor = $manager->executeQuery("" . $collection . '.' . $data . "", $query);

            # Ergebnis
            foreach ($cursor as $object) {
                #var_dump($object);

                $container .= $object->name . '<br>';
                $container .= $object->price . '<br>';

                if (isset($object->category)) {
                    $container .= $object->category . '<br>';
                } else {
                    array_push($error_msg, $object->_id . ' (keine Kategorie)');
                }
                $container .= '<br><br>';
            }
        } catch (MongoConnectionExeption $e) {
            var_dump($e);
        }
    } else {
        array_push($error_msg, 'PHP-MongoDB-Erweiterung installieren');
    }

    # Ausgabe der Fehlermeldungen
    if (count($error_msg) >= 1) {

        echo 'Fehler : ' . count($error_msg) . '<br>';

        foreach ($error_msg as $value) {
            echo $value . '<br>';
        }
    }

    # Ausgabe der Ergebnisse
    echo '<br>' . $container . '<br>';
}
