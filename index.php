<?php
	require_once __DIR__ . '/config.php';
	session_start();
	$cssFile = getenv('THEME_CSS') ?: 'css/style1.css';

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Skipass</title>
		<link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>">
	</head>
    <body>
		<div class="snow"></div>
        <div class="top_banner">
			<h1>Service de gestion de GrandMountain</h1>
			<h2>Veuillez vous connecter ou vous inscrire</h2>
		</div>
		<a href="login.php">Se connecter</a>
		<a href="register.php">S'inscrire</a>
    </body>