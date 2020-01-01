
<?php
            if ($GLOBALS['secc'] != null){
                $seccion = $GLOBALS['secc'];
            }
            
            if ($GLOBALS['conn'] != null){
                $con = $GLOBALS['conn'];
            }
            if ($GLOBALS['not'] != null){
                $consulta = "SELECT * FROM tabla_noticias where IDENTIFICADOR = '" . $GLOBALS['not'] . "'";
                $result =  $this->conn->query($consulta);
                $principal = $result->fetch_assoc();
                $seccion = $principal["SECCION"];
            }
            
            $consulta1 = "SELECT * FROM tabla_noticias where seccion = '". $seccion ."' ORDER BY fecha DESC";
        
            $result1 =  $this->conn->query($consulta1);
            
            $noticias = array();
        
            while($noticia=$result1->fetch_assoc()){
                $noticias[]=new Noticia($noticia["TITULO"],$noticia["FECHA"],$noticia["SECCION"],$noticia["CUERPO"] ,$noticia["SUBTITULO"],$noticia["IDENTIFICADOR"],$noticia["ENTRADILLA"],$noticia["AUTOR"],$noticia["IMAGEN"],$noticia["PIE"],$noticia["VIDEO"], $noticia["ULTIMA"], $noticia["VISIBLE"]);
            }
            $noticias == 0;
            
            echo '<div id = Lateral>';

            if (isset($_SESSION["username"])){
                if ($_SESSION["username"] == "jefe"){
                    echo '
                    
                        <h2> Menú Jefe</h2>
                        <li><a href = "index.php?secc=gestor_comentarios"> <strong> Gestor de comentarios </strong> </a> </li>
                        <li><a href = "index.php?secc=gestor_noticias"> <strong> Gestor de noticias </strong> </a></li>';
                        if ($GLOBALS['secc'] == 'gestor_noticias'){
                            echo '
                                <a href = "index.php?secc=gestor_noticias&tipo=league of legends"> - Noticias LOL </a> <p></p>
                                <a href = "index.php?secc=gestor_noticias&tipo=counter"> - Noticias Counter </a> <p></p>
                                <a href = "index.php?secc=gestor_noticias&tipo=starcraft"> - Noticias Starcraft </a> <p></p>
                            ';
                        }
                        echo'<li> <a href = "index.php?secc=gestor_publicidad"> <strong> Gestor de publicidad </strong> </a> </li>
                            <li> <a href = "index.php?secc=gestor_secciones"> <strong> Gestor de secciones y subsecciones </strong></a> </li>
                            <li> <strong> Organizador de la página de inicio </strong> </li> <p></p><p></p>';
                }
                
                if ($_SESSION["username"] == "redactor" || $_SESSION["username"] == "jefe" ){
                    echo '
                        <h2> Menú Redactor</h2>
                        <li><a href = "index.php?secc=nueva_noticia"> <strong> Añadir nueva Noticia </strong> </a><p></p> </li>';
                       
                }
            }

            echo '<div id = Hass>
            <strong><big>Noticias relacionadas</big></strong>';
            $i = 1;
            foreach ($noticias as $noticia){
                if ($i <= 2){
                    $consulta2 = "SELECT * FROM publicidad WHERE IDENTIFICADOR = " . $i;
                    $result2 =  $this->conn->query($consulta2);
                    $publicidad = $result2->fetch_assoc();
                    $publicidades = new Publicidad($publicidad["IMAGEN"], $publicidad["IDENTIFICADOR"], $publicidad["TEXTO"]);

                    if ($noticia->getIdentificador() != $GLOBALS['not']){
                        echo '<h2><a href="index.php?not='.$noticia->getIdentificador().'">'.$noticia->getTitulo().'</a></h2>
                        <p id = foto><img id = Imagen src="'. $noticia->getImagen() .'"alt=imagen></p>';

                    }
                    echo '<p id = foto><img  id = Publicidad src="'. $publicidades->getImagen() .'"alt=publicidad></p>';


                }
                $i++;
            }
            echo '</div>';

            echo '<div id = Comentarios>';

            $comentarios = $GLOBALS['consulta']->ArrayComentarios();

            if (!empty($comentarios)){
                foreach ($comentarios as $comentario){
                    if ($comentario->getVisible() == 1){
                        echo' 

                        <div id = Comentario>
                           <strong>' . $comentario->getNombre() . '</strong>
                           <p></p>'. $comentario->getFecha() . '
                           <div id = derecha>'. $comentario->getHora() .'</div>

                           <p>'. $comentario->getTexto() .'</p>
                        </div>';
                    }
                }
            }



            echo '<form method="POST">
                       <li>Comentario</li>

                           <textarea id = comment onkeyup=Prohibidas() name="texto"></textarea>

                           <button id=Enviar name = "Enviar" type=submit value=Enviar>Enviar</button>
                </form>';

            // Definir identificador para que funcione
            $identificador = $comentario->getIdentificador();

            // Guardar comentario en la base de datos
            if(isset($_POST["texto"]) && isset($_POST["Enviar"]) ){
                if (isset($_SESSION["username"])){

                    $name = $_SESSION["username"];
                    $correo = $_SESSION["email"];
                    $texto = $_POST["texto"];
                    $hora = date('H:i:s');
                    $fecha = date("Y-m-d");
                    $ip = '10.0.2.5';

                    $identificador += 1;

                    mysqli_query($con, "INSERT INTO comentarios (NOMBRE, CORREO, FECHA, HORA, TEXTO, IP,IDENTIFICADOR) VALUES  ('$name', '$correo', '$fecha', '$hora', '$texto', '$ip', '$identificador')");

                }
                else{
                    $mensaje = "Debe estar registrado para enviar comentarios";
                    echo '<script type="text/javascript">','Alerta(\''.$mensaje.'\');','</script>';
                }
            }

                
      
            echo '</div>';
?>