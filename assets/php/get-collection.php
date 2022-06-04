<?php

/**
 * 
 * Funktion : getCollection
 * holt die Werte aus der Datenbank
 * 
 * 
 */

function getCollection($connection, $collection, $name, $name_arrays, $data)
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

            # Ergebnis, Daten zu Objekten
            foreach ($cursor as $object) {
                #var_dump($object);

                # Objekte nach Vorgabe : $name = ["name", "price", ...
                foreach ($name as $value) {
                    if (isset($object->$value)) {

                        # Arrays im Objekt
                        if (gettype($object->$value) == "array") {

                            # Objekte in Array
                            foreach ($object->$value as $array) {

                                # Array nach Vorgabe : $name_arrays = ["user", "stars", ...
                                foreach ($name_arrays as $arrays) {
                                    if (isset($array->$arrays)) {
                                        # Objekt in Container
                                        $container .= $arrays . ' : ' . $array->$arrays . '<br>';
                                    } else {
                                        array_push($error_msg, $object->name . ' ' . $object->_id . ' ' . $arrays . '');
                                    }
                                }
                            }
                        } else {

                            # Objekt in Container
                            $container .= $value . ' : ' . $object->$value . '<br>';
                        }
                    } else {

                        # Fehlermeldung in Array
                        array_push($error_msg, $object->name . ' ' . $object->_id . ' ' . $value . '');
                    }
                }
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
