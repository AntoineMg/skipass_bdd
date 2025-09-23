<?php
    $card_number = $_POST["num_carte"];
    $valid_start_date = $_POST["valid_start_date"];
    $valid_end_date = $_POST["valid_end_date"];

    $skipass_db = new mysqli("127.0.0.1","root","","skipass_porret_morier");

    mysqli_query( $skipass_db,"INSERT INTO 'carte' ('idCarte','numCarte','dateDebutValide','dateFinValide') VALUES
        (1,$card_number, $valid_start_date, $valid_end_date);
    ");

    echo($skipass_db->connect_error());
?>