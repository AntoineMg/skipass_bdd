<?php
	require_once __DIR__ . '/config.php';
	session_start();
	$cssFile = getenv('THEME_CSS') ?: 'css/style1.css';


	if (empty($_SESSION['logged_in'])) {
		header("Location: login.php");
		exit;
	}
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
        <div class="top_banner">
			<h1>Tableau de Bord</h1>
			<h2><?php echo "Bienvenue " . htmlspecialchars($_SESSION['login']); ?></h2>
			<h2><?php echo "Votre role est " . htmlspecialchars($_SESSION['role']); ?></h2>
		</div>
		<?php
			if ($_SESSION['role']=="administrator") {
		?>
		<a href="new_card.php">Inserer nouvelle carte</a>
			<?php
		}
		?>
		<a href="display_cards.php">Afficher cartes</a>
		<a href="script_logout.php">Déconnexion</a>
    </body>