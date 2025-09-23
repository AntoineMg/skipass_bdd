<?php
    $card_number = $_POST["num_carte"];
    $valid_start_date = $_POST["valid_start_date"];
    $valid_end_date = $_POST["valid_end_date"];

    $skipass_db = mysqli("127.0.0.1","root","","skipass_porret_morier");

    $skipass_db.query("INSERT INTO 'carte' ('numCarte','dateDebutValide','dateFinValide' VALUES
        ($card_number, $valid_start_date, $valid_end_date);
    )")

?>