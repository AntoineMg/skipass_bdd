<?php
    require_once __DIR__ . '/config.php';
    session_start();
    $cssFile = getenv('THEME_CSS') ?: 'css/style1.css';

    $login = $_POST["login"];
    $password = $_POST["password"];
    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);

    $result = $skipass_db->query("SELECT * FROM employees WHERE login = '$login'");
    if ($result && $row = $result->fetch_assoc()) {
        $db_hash_password = $row['password'];
        if (password_verify($password,$db_hash_password)) {
            //INFOS SESSION
            //recup nom prenom
            $_SESSION['firstname']=$row['first_name'];
            $_SESSION['lastname']=$row['last_name'];

            //recup role
            $role_id = $row['role_id'];
            $role_result = $skipass_db->query("SELECT * FROM roles WHERE role_id ='$role_id'");
            $role_row = $role_result->fetch_assoc();
            $_SESSION['role'] = $role_row["role_name"];
            
            $_SESSION['login'] = $login;
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
        } else {
            echo"<div class=\"message-container\">";
            echo "Mdp incorrect";
        }
    } else {
        echo"<div class=\"message-container\">";
        echo "Login introuvable";
    }    


    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$cssFile\">";
    echo "<a href=\"login.php\">Retour au login</a>";

    echo "</div>";

    exit;
?>