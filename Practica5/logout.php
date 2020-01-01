<?php
    session_start();
    session_destroy();
    echo 'Sesión cerrada. <a href="index.php?">Volver</a>';
?>