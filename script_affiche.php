<html>
<?php
require_once __DIR__ . '/config.php';

$skipass_db = new mysqli("127.0.0.1", "root", "", "skipass_porret_morier");
$query = "SELECT * FROM carte";
$result = $skipass_db->query($query);
$enreg = $result->fetch_row();
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Select</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="top_banner">
		<h1>Select Carte</h1>
		<h2>POURQUOI ELLE EXISTE ?</h2>
	</div>
	<table border="1">
		<tr>
			<td> Cartes enregistrees </td>
		</tr>

	<?php
do {
	?>
	<tr>
		<td>
			<?php
            echo $enreg[1];
            ?>
		</td>
		<td>
			<?php
            echo $enreg[2];
			?>
		</td>


		<td>

			<?php
            echo $enreg[3];
			?>
		</td>
	</tr>
	<?php
    $enreg = $result->fetch_row();
} while ($enreg != NULL); 
?>
	<a href="Menu.html">Menu </a>
</body>
</html>