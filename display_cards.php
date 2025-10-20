<?php

  require_once __DIR__ . '/config.php';
	session_start();
  $cssFile = getenv('THEME_CSS') ?: 'css/style1.css';

	if (empty($_SESSION['logged_in'])) {
		header("Location: login.php");
		exit;
	}


//creation skipass db
if (!isset($skipass_db) || !($skipass_db instanceof mysqli)) {
    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
}

if ($skipass_db->connect_errno) {
    die("Erreur connexion BDD : " . $skipass_db->connect_error);
}

//Recup cartes
$query = "SELECT * FROM cards";
if (!$result = $skipass_db->query($query)) {
    die("Erreur SELECT : " . $skipass_db->error);
}

$fields = $result->fetch_fields(); // noms de colonnes pour l'entête
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Affichage des cartes</title>
  <link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>">
</head>
<body>
  <div class="top_banner">
    <h1>Select Carte</h1>
    <h2><?php echo "Bienvenue " . htmlspecialchars($_SESSION['login']); ?></h2>
  </div>

<table border="1">
  <tr>
    <?php foreach ($fields as $f): ?>
      <th><?= htmlspecialchars($f->name) ?></th>
    <?php endforeach; ?>
    <?php if ($_SESSION['role']=="administrator"): ?>
      <th>Suppression</th>
    <?php endif; ?>
  </tr>

  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <?php foreach ($fields as $f): ?>
      <td>
        <?= htmlspecialchars($row[$f->name]) ?>
        <?php 
          //detection date
          if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $row[$f->name])): 
        ?>
          <!-- btn modif date-->
          <form method="post" action="script_modify.php" style="display:inline;">
            <input type="hidden" name="id" value="<?= htmlspecialchars($row[$fields[0]->name]) ?>">
            <input type="hidden" name="field" value="<?= htmlspecialchars($f->name) ?>">
            <input type="date" name="new_date" value="<?= htmlspecialchars($row[$f->name]) ?>">
            <input type="submit" value="✔️" title="Enregistrer">
          </form>
        <?php endif; ?>
      </td>
    <?php endforeach; ?>

    <!-- suppression -->
    <?php if ($_SESSION['role']=="administrator"): ?>
      <td>
        <form method="post" action="script_delete.php" onsubmit="return confirm('Supprimer cette ligne ?');">
          <input type="hidden" name="id" value="<?= htmlspecialchars($row[$fields[0]->name]) ?>">
          <input type="submit" value="❌">
        </form>
      </td>
    <?php endif; ?>
  </tr>
  <?php endwhile; ?>
</table>


  <br>
  <a href="dashboard.php">Retour au tableau de bord</a>
</body>
</html>

<?php
$result->free();
$skipass_db->close();


