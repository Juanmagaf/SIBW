<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Portada</title>
        <link rel="stylesheet" type="text/css" href="Estilo/Css.css" />
        <script type = "text/javascript" src = "JavaScript/funciones.js"></script>
    </head>
    <body>
        <?php
            
            $servername = "localhost";
            $username = "editor_jefe";
            $password = "password";
            $dbname = "periodico";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            //mysqli_change_user ($conn, "editor_jefe", "password", "periodico");
            mysqli_set_charset($conn,"utf8");
        
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            //echo "Connected successfully";
        
            
        ?>
        
    </body>
</html>