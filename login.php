<?php

session_start();
require_once __DIR__ . '/config.php';



// si config.php ne fournit pas $skipass_db, on le crée
if (!isset($skipass_db) || !($skipass_db instanceof mysqli)) {
    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
}

if ($skipass_db->connect_errno) {
    die("Erreur connexion BDD : " . $skipass_db->connect_error);
}

if ($_SESSION['logged_in']) {
    header("Location: dashboard.php");
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="top_banner">
        <h1>Se connecter</h1>
        <h2>Saisir vos informations</h2>
    </div>
    <div class="form_div">
			<form action="script_login.php" method="post">
                <div class="form_item">
					<label for="login">Login : </label>
					<input type="text" name="login"/>
				</div>
                <br/>
                <div class="form_item">
					<label for="password">Mot de passe : </label>
					<input type="password" name="password"/>
				</div>
                <br/>
				<div class="form_buttons">
					<input type="submit" name="login_employee" value="Se connecter"/>
				</div>
			</form>
		</div> 
    <a href="index.html">Menu</a>
</body>
</html>