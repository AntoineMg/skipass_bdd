<?php

session_start();

require_once __DIR__ . '/config.php';

$card_number = $_POST["num_carte"];
$valid_from = $_POST["valid_from"];
$valid_to = $_POST["valid_to"];

$skipass_db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

$sql_query = "INSERT INTO cards (card_num, valid_from, valid_to)
            VALUES ('$card_number', '$valid_from', '$valid_to')";

echo "<div class=\"message-container\">";

if (!$skipass_db->query($sql_query)) {
    echo "SQL ERROR : " . $skipass_db->error;
} else {
    echo "🤖 Carte n°" . $card_number . " ajoutée avec grand succès 👍";
}
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/style.css\">";
echo "<a href=\"new_card.php\">Retour</a>";

echo "</div>";
