<?php
    require_once __DIR__ . '/config.php';

    $card_number = $_POST["num_carte"];
    $valid_start_date = $_POST["valid_start_date"];
    $valid_end_date = $_POST["valid_end_date"];

    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
    
    $sql_query = "INSERT INTO carte (numCarte, dateDebutValide, dateFinValide)
            VALUES ('$card_number', '$valid_start_date', '$valid_end_date')";

    if (!$skipass_db->query($sql_query)) {
        echo "SQL ERROR : " . $skipass_db->error;
    } else {
        echo "🤖 Carte n°" . $card_number . " ajoutée avec grand succès 👍";
    }

?>