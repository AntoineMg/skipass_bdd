<?php
//Recup env
    $env_file = __DIR__ . '/.env'; 

    // Lit le fichier si il existe
    if (file_exists($env_file)) {
        foreach (file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            // Ignore les commentaires
            if (strpos(trim($line), '#') === 0) continue;

            // Sépare clé=valeur
            list($key, $value) = explode('=', $line, 2);
            putenv("$key=$value");  // Définit la variable pour le script PHP
        }
    }

    $db_host = getenv('DB_HOST');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASS');
    $db_name = getenv('DB_NAME');
    $db_port = getenv('DB_PORT');

?>