<?php
# no single request
if (!isset($correct)) {
    die();
}

/**
 * 
 * getCollection 
 * 
 */

function getCollection($connection_cluster, $collection, $data, $error_msg)
{

    # Container
    $container = '';

    # ist die PHP-Erweiterung "mongodb" vorhanden
    if (extension_loaded("mongodb")) {

        try {
            # startet den Manager zum Aufbau einer Verbindung
            $manager = new MongoDB\Driver\Manager($connection_cluster);

            # Abfrage
            $query = new MongoDB\Driver\Query([]);

            # Auswahl der Collection und Daten / Dokumente
            $cursor = $manager->executeQuery("" . $collection . '.' . $data . "", $query);

            # Ergebnis, Daten zu Objekten
            foreach ($cursor as $object) {
                var_dump($object);
                #echo $object->count();
                #var_dump($object->count());

                $container .= $object->id . '<br>';
                $container .= $object->Name . '<br>';

                $container .= '<br><br>';
            }
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
}
