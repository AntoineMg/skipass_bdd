<?php
	session_start();

	if (empty($_SESSION['logged_in'])) {
		header("Location: login.php");
		exit;
	}

    if ($_SESSION['role']!="administrator") {
		header("Location: dashboard.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Formulaire Ajout Carte</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
        <div class="top_banner">
			<h1>Ajout Carte</h1>
			<h2><?php echo "Connecté en tant que " . htmlspecialchars($_SESSION['login']); ?></h2>
		</div>
        <div class="form_div">
			<form action="script_insert.php" method="post">
				<div class="form_item">
					<label for="num_carte">Numéro de Carte : </label>
					<input type="number" name="num_carte"/>
				</div>
				<br/>
                <div class="form_item">
					<label for="valid_start_date">Date de début de validité : </label>
					<input type="date" name="valid_start_date"/>
				</div>
                <br/>
                <div class="form_item">
					<label for="valid_end_date">Date de fin de validité : </label>
					<input type="date" name="valid_end_date"/>
				</div>
                <br/>
				<div class="form_buttons">
					<input type="submit" name="add_card" value="Ajouter la carte"/>
				</div>
			</form>
		</div> 
		<a href="index.html">Menu </a>
	</body>
</html>