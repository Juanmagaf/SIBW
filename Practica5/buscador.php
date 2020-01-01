<?php
    
    $con = new mysqli("localhost", "user", "password", "periodico");
    mysqli_set_charset($con, "utf8");

    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $tipo = $_GET['tipo'];
    $clave = $_GET['q'];
    $palabra = strtolower($clave);
    if ($tipo == "jefe"){
        $query = mysqli_query($con, "SELECT * FROM tabla_noticias WHERE titulo LIKE '%$palabra%' OR entradilla LIKE '%$palabra%'");
    }
    else{
        $query = mysqli_query($con, "SELECT * FROM tabla_noticias WHERE (titulo LIKE '%$palabra%' OR entradilla LIKE '%$palabra%') AND visible = 1");
    }
    $numero_filas = mysqli_num_rows($query) ;

    echo '<select onchange="location = this.value">';

    echo '<option>Sugerencias</option>';

    for($i = 0 ; $i < $numero_filas ; $i++){
        $row = mysqli_fetch_assoc($query);
        echo '<option value="index.php?not='.$row["IDENTIFICADOR"].'">'.$row["TITULO"].'</option>';
    }

    echo '</select>';

    mysqli_close($con) ;
?>