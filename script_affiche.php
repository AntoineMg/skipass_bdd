<?php

    $skipass_db = new mysqli("127.0.0.1","root","","skipass_porret_morier");
    
    $query = "SELECT * FROM carte";
    $result = $skipass_db->query($query);
    $enreg = $result->fetch_row();

    do{
        echo $enreg[0];
        echo $enreg[1];
        echo $enreg[2];
        echo $enreg[3];
        $enreg = $result->fetch_row();
    }while($enreg!= NULL);

?>