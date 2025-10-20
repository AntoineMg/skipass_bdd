<?php
    require_once __DIR__ . '/config.php';
	session_start();
    

	if (empty($_SESSION['logged_in'])) {
		header("Location: login.php");
		exit;
	}
    if( $_SESSION['role']!="administrator"){
        header("Location: display_cards.php");
    };

require_once __DIR__ . '/config.php';

// connexion a la db
if (!isset($skipass_db) || !($skipass_db instanceof mysqli)) {
    $skipass_db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
}
if ($skipass_db->connect_errno) {
    die("Erreur connexion : " . $skipass_db->connect_error);
}

if (!isset($_POST['id'])) {
    header('Location: display_cards.php');
    exit;
}


//Recup nouvelledate 
$id = $_POST["id"];
$field = $_POST["field"];
$new_date = $_POST["new_date"];

//verif du champ
$allowed_fields = ['valid_from', 'valid_to'];
if (!in_array($field, $allowed_fields)) {
    die("SECURITY ERROR!");
}

//preparer requete sql
$sql = "UPDATE `cards` SET `$field` = ? WHERE card_id = ?";

$stmt = $skipass_db->prepare($sql);
if (!$stmt) {
    die("prepare failed: (" . $skipass_db->errno . ") " . $skipass_db->error);
}

// $new_date = string // $id = int
if (!$stmt->bind_param("si", $new_date, $id)) {
    die("bind_param failed: (" . $stmt->errno . ") " . $stmt->error);
}

if (!$stmt->execute()) {
    die("execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$stmt->close();
$skipass_db->close();

header("Location: display_cards.php");
exit;
