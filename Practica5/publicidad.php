<?php
    
    $consulta = "SELECT * FROM tabla_noticias where identificador = 4";
            
    $result = $GLOBALS['conn']->query($consulta);

    $principal = $result->fetch_assoc();
?>