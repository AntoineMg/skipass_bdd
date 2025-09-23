<?php
    $card_number = $_POST["num_carte"];
    $valid_start_date = $_POST["valid_start_date"];
    $valid_end_date = $_POST["valid_end_date"];

    $skipass_db = new mysqli("127.0.0.1","root","","skipass_porret_morier");

    
    $sql = "INSERT INTO carte (numCarte, dateDebutValide, dateFinValide)
            VALUES ('$card_number', '$valid_start_date', '$valid_end_date')";

    if (!$skipass_db->query($sql)) {
        echo "Erreur SQL : " . $skipass_db->error;
    } else {
        echo "Insertion réussie ✅";
    }

?>