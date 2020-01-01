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
            session_start();
        
            require_once 'conexion.php';
        
            if(isset($_GET["not"])){
                $not = $_GET["not"];
            } else
                $not = 0;
            if(isset($_GET["secc"])){
               $secc = $_GET["secc"];
            }  else   
                $secc = "principal";
        
            if(isset($_GET["subsecc"])){
               $subsecc = $_GET["subsecc"];
            }  else   
                $subsecc = false;
        
            if(isset($_GET["imprimir"])){
               $imprimir = $_GET["imprimir"];
            }  else   
                $imprimir = false;
        
            if(isset($_GET["opcion"])){
                $opcion = $_GET["opcion"];
            }  else   
                $opcion = "";
        
            if(isset($_GET["tipo"])){
                $tipo = $_GET["tipo"];
            }  else   
                $tipo = "";
        
  
            if(isset($_POST['username'])){
                $_SESSION['username'] = $_POST['username'];       
            }
            
            if(isset($_POST['email'])){
                $_SESSION['email'] = $_POST['email'];
            }
            
        
            echo "<div id=pagina>";
                require 'header.php';
                require 'content.php';
                
                include 'footer.php';
            echo "</div>";
        
            mysqli_close($conn);
        ?>
        
    </body>
</html>