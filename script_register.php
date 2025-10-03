<?php

    require_once __DIR__ . '/config.php';

    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $login = $_POST["login"];
    $password = $_POST["password"];

    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
    
    $sha_password=sha1($password);

    $sql_query = "INSERT INTO employees (first_name, last_name, login, password)
            VALUES ('$first_name', '$last_name', '$login', '$sha_password')";

    echo"<div class=\"message-container\">";
    if (!$skipass_db->query($sql_query)) {
        echo "SQL ERROR : " . $skipass_db->error;
    } else {
        echo "Employé " . $first_name . " " .$last_name . " ajouté avec grand succès 👍";
    }

    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
    echo "<a href=\"index.html\">Menu</a>";

    echo "</div>";

    exit;
?>