<?php

    require_once __DIR__ . '/config.php';
    $cssFile = getenv('THEME_CSS') ?: 'css/style1.css';

    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $login = $_POST["login"];
    $password = $_POST["password"];

    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
    
    //methode de hash bcrypt => plus safe que sha
    $hash_password = password_hash($password, PASSWORD_DEFAULT);     

    $sql_query = "INSERT INTO employees (first_name, last_name, login, password)
            VALUES ('$first_name', '$last_name', '$login', '$hash_password')";

    echo"<div class=\"message-container\">";
    if (!$skipass_db->query($sql_query)) {
        echo "SQL ERROR : " . $skipass_db->error;
    } else {
        echo "Employé " . $first_name . " " .$last_name . " ajouté avec grand succès 👍";  
    }

    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$cssFile\">";
    echo "<a href=\"index.php\">Menu</a>";

    echo "</div>";

    exit;
?>