<?php
# save single request
if (count(get_included_files()) >= 1) {
    die();
}

# ist die PHP-Erweiterung "mongodb" vorhanden
if (!extension_loaded("mongodb")) {
    die('Bitte die PHP-MongoDB-Erweiterung installieren');
}
