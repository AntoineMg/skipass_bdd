<?php

    require_once __DIR__ . '/config.php';

    $login = $_POST["login"];
    $password = $_POST["password"];
    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
    $sha_password = sha1($password);


    

    $result = $skipass_db->query("SELECT password FROM employees WHERE login = '$login'");

    if ($result && $row = $result->fetch_assoc()) {
        $db_sha_password = $row['password'];
        if ($sha_password == $db_sha_password) {
            header("Location: dashboard.html");
        } else {
            echo"<div class=\"message-container\">";
            echo "Mdp incorrect";
        }
    } else {
        echo"<div class=\"message-container\">";
        echo "Login introuvable";
    }    


    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
    echo "<a href=\"login.php\">Retour au login</a>";

    echo "</div>";

    exit;
?>