<?php

$skipass_db = new mysqli("127.0.0.1", "root", "", "skipass_porret_morier");

$query = "SELECT * FROM carte";
$result = $skipass_db->query($query);
$enreg = $result->fetch_row();
?>
<html>
<table border="1">
    <tr>
        <td> Cartes enregistrees </td>
    </tr>

</html>
<?php
do {
?>
    <tr>
        <td>
            <?php
            echo $enreg[0];
            ?>
        </td>
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
} while ($enreg != NULL); ?>