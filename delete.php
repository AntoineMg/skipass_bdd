<?php
require_once __DIR__ . '/config.php';
header('lolo');
// connexion si besoin
if (!isset($skipass_db) || !($skipass_db instanceof mysqli)) {
    $skipass_db = new mysqli($db_host,$db_user,$db_pass,$db_name, $db_port);
}
if ($skipass_db->connect_errno) {
    die("Erreur connexion : " . $skipass_db->connect_error);
}

if (!isset($_POST['id'])) {
    header('Location: test.php'); // retourne à la liste si aucun id
    exit;
}

$id_raw = $_POST['id'];
// Détecter si l'id est numérique
$is_int = ctype_digit(strval($id_raw));
$id = $is_int ? (int)$id_raw : $id_raw;

// Récupère le nom de la première colonne de la table (pour construire la WHERE)
// Ceci évite d'avoir besoin du nom exact de la colonne côté client.
$res = $skipass_db->query("SHOW COLUMNS FROM `carte`");
if (!$res) {
    die("Impossible de lire la structure de la table: " . $skipass_db->error);
}
$col = $res->fetch_assoc();
if (!$col) {
    die("Table 'carte' vide ou erreur.");
}
$pk_field = $col['Field'];
// sécurité: n'autorise que des noms simples
if (!preg_match('/^[A-Za-z0-9_]+$/', $pk_field)) {
    die("Nom de colonne invalide.");
}

$sql = "DELETE FROM `carte` WHERE `$pk_field` = ?";
$stmt = $skipass_db->prepare($sql);
if (!$stmt) {
    die("Prepare failed: (" . $skipass_db->errno . ") " . $skipass_db->error);
}

$type = $is_int ? 'i' : 's';
if (!$stmt->bind_param($type, $id)) {
    die("bind_param failed: (" . $stmt->errno . ") " . $stmt->error);
}
if (!$stmt->execute()) {
    die("execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$stmt->close();
$skipass_db->close();

header("Location: test.php");
exit;