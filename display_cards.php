<?php

	session_start();

	if (empty($_SESSION['logged_in'])) {
		header("Location: login.php");
		exit;
	}

require_once __DIR__ . '/config.php';

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
  <title>Select</title>
  <link rel="stylesheet" type="text/css" href="assets/style.css">
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
      <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <?php foreach ($fields as $f): ?>
        <td><?= htmlspecialchars($row[$f->name]) ?></td>
      <?php endforeach; ?>

      <!-- on transmet la valeur de la 1e colonne ( clé primaire) -->
      <?php

        if ($_SESSION['role']=="administrator") {
      ?>
      <td>
        <form method="post" action="script_delete.php" onsubmit="return confirm('Supprimer cette ligne ?');">
          <input type="hidden" name="id" value="<?= htmlspecialchars($row[$fields[0]->name]) ?>">
          <input type="submit" value="Supprimer">
        </form>
      </td>
    </tr>
    <?php
        }
    ?>
    <?php endwhile; ?>
  </table>

  <br>
  <a href="dashboard.php">Retour au tableau de bord</a>
</body>
</html>

<?php
$result->free();
$skipass_db->close();


