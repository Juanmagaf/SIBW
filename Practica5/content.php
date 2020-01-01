<?php
    class Noticia{  
        function Noticia($titulo, $fecha, $seccion, $cuerpo, $subtitulo, $identificador, $entradilla, $autor, $imagen, $pie, $video, $ultima, $visible){       
            $this->titulo = $titulo;
            $this->fecha = $fecha;
            $this->seccion = $seccion;
            $this->cuerpo = $cuerpo;
            $this->subtitulo = $subtitulo;
            $this->identificador = $identificador;
            $this->entradilla = $entradilla;
            $this->autor = $autor;
            $this->imagen = $imagen;
            $this->pie = $pie;
            $this->video = $video;
            $this->ultima = $ultima;
            $this->visible = $visible;
        }
        
        function getTitulo(){
            return $this->titulo;
        }
        function getFecha(){
            return $this->fecha;
        }        
        function getSeccion(){
            return $this->seccion;
        }
         function getCuerpo(){
            return $this->cuerpo;
        }
         function getSubtitulo(){
            return $this->subtitulo;
        }
          function getIdentificador(){
            return $this->identificador;
        }
         function getEntradilla(){
            return $this->entradilla;
        }
          function getAutor(){
            return $this->autor;
        }
          function getImagen(){
            return $this->imagen;
        }
        function getPie(){
            return $this->pie;
        }
        function getVideo(){
            return $this->video;
        }
        function getUltima(){
            return $this->ultima;
        }
        function getVisible(){
            return $this->visible;
        }
    }

    class Publicidad{  
        function Publicidad($imagen, $identificador, $texto){       
            $this->imagen = $imagen; 
            $this->identificador = $identificador;
            $this->texto = $texto;
        }
        
        function getImagen(){
            return $this->imagen;
        }
        
        function getIdentificador(){
            return $this->identificador;
        }
        
        function getTexto(){
            return $this->texto;
        }
    }

    class Usuario{  
        function Usuario($nombre, $contraseña, $correo, $tipo){       
            $this->nombre = $nombre;
            $this->contraseña = $contraseña;
            $this->correo = $correo;
            $this->tipo = $tipo;
        }
        
        function getNombre(){
            return $this->nombre;
        }
        function getContraseña(){
            return $this->contraseña;
        }        
        function getCorreo(){
            return $this->correo;
        }
        function getTipo(){
            return $this->tipo;
        }
    }

    class Comentario{  
        function Comentario($nombre, $correo, $fecha, $hora, $texto, $visible, $ip, $identificador){       
            $this->nombre = $nombre;
            $this->fecha = $fecha;
            $this->correo = $correo;
            $this->hora = $hora;
            $this->texto = $texto;
            $this->visible = $visible;
            $this->ip = $ip;
            $this->identificador = $identificador;
        }
        
        function getNombre(){
            return $this->nombre;
        }
        function getFecha(){
            return $this->fecha;
        }        
        function getCorreo(){
            return $this->correo;
        }
        function getHora(){
            return $this->hora;
        }
        function getTexto(){
            return $this->texto;
        }
        function getVisible(){
            return $this->visible;
        }
        function getIP(){
            return $this->ip;
        }
         function getIdentificador(){
            return $this->identificador;
        }
    }

    class Logo{  
        function Logo($seccion, $logo,$identificador){       
            $this->seccion = $seccion;
            $this->logo = $logo;
            $this->identificador = $identificador;
        }
        
        function getSeccion(){
            return $this->seccion;
        }
        function getLogo(){
            return $this->logo;
       
        }
        function getIdentificador(){
            return $this->identificador;
        }
    }
    class Consulta{
        
        function Consulta($conn){
             $this->conn = $conn;
        }
        
        function ArrayNoticias(){
            
            
            $GLOBALS['imprimir']=false;
            $consulta = "SELECT * from tabla_noticias ORDER BY FECHA DESC";
            
            $result =  $this->conn->query($consulta);
            
            if (!$result) {
                throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
            }
            
            $noticias=array();
            while($noticia=$result->fetch_assoc()){
                $noticias[]=new Noticia($noticia["TITULO"],$noticia["FECHA"],$noticia["SECCION"],$noticia["CUERPO"] ,$noticia["SUBTITULO"],$noticia["IDENTIFICADOR"],$noticia["ENTRADILLA"],$noticia["AUTOR"],$noticia["IMAGEN"],$noticia["PIE"], $noticia["VIDEO"], $noticia["ULTIMA"], $noticia["VISIBLE"]);          
            }
            
            return $noticias;
        }
        
        function ArrayComentarios(){
            $consulta = "SELECT * from comentarios ORDER BY IDENTIFICADOR ASC";
            
            $result =  $this->conn->query($consulta);
            
            if (!$result) {
                throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
            }
            
            $comentarios = array();
            while($comentario = $result->fetch_assoc()){
                $comentarios[] = new Comentario($comentario["NOMBRE"], $comentario["CORREO"], $comentario["FECHA"], $comentario["HORA"], $comentario["TEXTO"], $comentario["VISIBLE"], $comentario["IP"],  $comentario["IDENTIFICADOR"]);
            }
            
            return $comentarios;
        }
        
        function ArrayPublicidad(){
            $consulta = "SELECT * from publicidad ORDER BY IDENTIFICADOR ASC";
            
            $result =  $this->conn->query($consulta);
            
            if (!$result) {
                throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
            }
            
            $publicidades = array();
            while($publicidad = $result->fetch_assoc()){
                $publicidades[] = new Publicidad($publicidad["IMAGEN"], $publicidad["IDENTIFICADOR"], $publicidad["TEXTO"]);
            }
            
            return $publicidades;
        }
        
        function ArrayLogos(){
            $consulta = "SELECT * from logos ORDER BY IDENTIFICADOR ASC";
            
            $result =  $this->conn->query($consulta);
            
            if (!$result) {
                throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
            }
            
            $logos = array();
            while($logo = $result->fetch_assoc()){
                $logos[] = new Logo($logo["SECCION"], $logo["LOGO"],$logo["IDENTIFICADOR"]);
            }
            
            return $logos;
        }
       
        function GetLogoConsulta($seccion){
           
            $consulta = "SELECT * FROM logos where seccion = '".$seccion."'";
            
            $result =  $this->conn->query($consulta);
            if (!$result) {
                throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
            }
            $principal = $result->fetch_assoc();
            $logo = $principal["LOGO"];
            return $logo; 
        }
        
        function GetNoticiaPrincipal(){
            
            $consulta = "SELECT * FROM tabla_noticias where identificador =9";
            
            $result =  $this->conn->query($consulta);
            
            $principal = $result->fetch_assoc();
            $noticia = new Noticia($principal["TITULO"],$principal["FECHA"],$principal["SECCION"],$principal["CUERPO"] ,$principal["SUBTITULO"],$principal["IDENTIFICADOR"],$principal["ENTRADILLA"],$principal["AUTOR"],$principal["IMAGEN"],$principal["PIE"], $principal["VIDEO"], $principal["ULTIMA"], $principal["VISIBLE"]);
            return $noticia;
        }
        
        function GetNoticia($identificador){
           
            $consulta = "SELECT * FROM tabla_noticias where identificador = ".$identificador;
            
            $result =  $this->conn->query($consulta);
            
            $principal = $result->fetch_assoc();
            $noticia = new Noticia($principal["TITULO"],$principal["FECHA"],$principal["SECCION"],$principal["CUERPO"] ,$principal["SUBTITULO"],$principal["IDENTIFICADOR"],$principal["ENTRADILLA"],$principal["AUTOR"],$principal["IMAGEN"],$principal["PIE"], $principal["VIDEO"], $principal["ULTIMA"], $principal["VISIBLE"]);
            return $noticia;
        }
        
        function GetPublicidad($identificador){
            $consulta = "SELECT * FROM publicidad where identificador = ".$identificador;
            
            $result =  $this->conn->query($consulta);
            
            $principal = $result->fetch_assoc();
            $publicidad = new Publicidad($principal["IMAGEN"], $principal["IDENTIFICADOR"], $principal["TEXTO"]);
            return $publicidad;
        }
        
        function GetUsuario($nombre){
            $consulta = "SELECT * FROM usuarios WHERE nombre = '" . $nombre . "'";
            
            $result = $this->conn->query($consulta);
            
            $principal = $result->fetch_assoc();
            $usuario = new Usuario($principal["NOMBRE"], $principal["CONTRASEÑA"], $principal["CORREO"], $principal["TIPO"]);
            return $usuario;
        }
  
        function GenerarNoticiaImprimir($noticia){
                echo'  <div id="pagina">
                <div>
                
                <img id = "LogoCabecera" src="Imagenes/E-Sport-Logo.png">
        
                </div>
                <!-- Sección -->
                <div id = izquierda>
                     <img id = "Logos" src="'.$GLOBALS['consulta']->GetLogoConsulta($noticia->getSeccion()).'">
                </div>
            
                 <div id = "Cuerpo_imprimir">
                    <!-- Titular -->
                    <h1>'.$noticia->getTitulo().'</h1>
                    
                    <!-- Subtítulo -->
                    <h2>'.$noticia->getSubtitulo().'</h2>

                    <!-- Entradilla -->
                    <h3>'.$noticia->getEntradilla().'</h3>

                    <!-- Autor y fecha -->
                    <div id = autor-fecha>
                        <div id = "izquierda">
                            <strong>'.$noticia->getAutor().'</strong>
                        </div>
                        <div id = "derecha">
                            <i> Fecha publicación: '.$noticia->getFecha().' / Última modificación: '.$noticia->getUltima().' </i>
                        </div>
                    </div>
                    
                    <p id = foto><img id = "Imagen_Imp" src= '.$noticia->getImagen().' alt="mundial">
                        <br>'.$noticia->getPie().'
                    </p>
                    
                    <!-- Cuerpo -->
                     <div id="newspaper">
                    '.$noticia->getCuerpo().'
                    </div>
                    
                    <!-- Video -->
                    <br><p>'.$noticia->getVideo().'</p></br>

                  
                </div>

            </div>
        ';
            
              
            echo '</div>';
            
        }
        
        
        function GenerarNoticia($noticia){
            
                echo'  <div id = "Noticia">
                    <div id = "Cuerpo">
                    <!-- Titular -->
                    <h1>'.$noticia->getTitulo().'</h1>';
            
                    // Editar titular
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] == "jefe"){
                            echo '<form method="POST">
                                <textarea name="titular">'.$noticia->getTitulo().'</textarea>
                                <button type=submit">Editar</button>
                            </form>';
                            
                            if (isset($_POST["titular"])){
                                $titular = $_POST["titular"];
                                $fecha = date("Y-m-d H:i:s");
                                $identificador = $noticia->getIdentificador();
                                
                                mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET TITULO = '$titular', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                            }
                            
                        }
                    }
            
                    echo '<!-- Sección -->
                    <div id = derecha>
                       <img id = "Logos" src="'.$GLOBALS['consulta']->GetLogoConsulta($noticia->getSeccion()).'">
                    </div>

                    <!-- Subtítulo -->
                    <h2>'.$noticia->getSubtitulo().'</h2>';
            
                    // Editar subtitulo
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] == "jefe"){
                            echo '<form method="POST">
                                <textarea name="subtitulo">'.$noticia->getSubtitulo().'</textarea>
                                <button type=submit">Editar</button>
                            </form>';
                            
                            if (isset($_POST["subtitulo"])){
                                $subtitulo = $_POST["subtitulo"];
                                $fecha = date("Y-m-d H:i:s");
                                $identificador = $noticia->getIdentificador();
                                
                                mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET SUBTITULO = '$subtitulo', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                            }
                            
                        }
                    }

                    echo '<!-- Entradilla -->
                    <h3>'.$noticia->getEntradilla().'</h3>';
            
                    // Editar entradilla
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] == "jefe"){
                            echo '<form method="POST">
                                <textarea name="entradilla">'.$noticia->getEntradilla().'</textarea>
                                <button type=submit">Editar</button>
                            </form>';
                            
                            if (isset($_POST["entradilla"])){
                                $entradilla = $_POST["entradilla"];
                                $fecha = date("Y-m-d H:i:s");
                                $identificador = $noticia->getIdentificador();
                                
                                mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET ENTRADILLA = '$entradilla', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                            }
                            
                        }
                    }

                    echo '<!-- Autor y fecha -->
                    <div id = autor-fecha>
                        <div id = "izquierda">
                            <strong>'.$noticia->getAutor().'</strong>
                        </div>
                        <div id = "derecha">
                            <i> Fecha publicación: '.$noticia->getFecha().' / Última modificación: '.$noticia->getUltima().' </i>
                        </div>
                    </div>

                    <!-- Cuerpo -->

                    <p id = foto><img id = "Imagen" src="'.$noticia->getImagen().'" alt="mundial">
                    '.$noticia->getPie().'                
                    </p>';
                    
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] == "jefe"){
                            echo '<form method="POST">
                                <textarea name="Imagen">'.$noticia->getImagen().'</textarea>
                                <textarea name="Pie_Foto">'.$noticia->getPie().'</textarea>
                                <button type=submit">Editar</button>
                                
                            
                            </form>';
                            
                            if (isset($_POST["Imagen"]) && isset($_POST["Pie_Foto"]) ){
                                $foto = $_POST["Imagen"];
                                $pie = $_POST["Pie_Foto"];
                                $fecha = date("Y-m-d H:i:s");
                                $identificador = $noticia->getIdentificador();
                                
                                mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET IMAGEN = '$foto', PIE = '$pie', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                            }
                            
                        }
                    }

                    // Editar cuerpo
                    
                   echo $noticia->getCuerpo();
                    
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] == "jefe"){
                            echo '<form method="POST">
                                <textarea name="cuerpo">'.$noticia->getCuerpo().'</textarea>
                                <button type=submit">Editar</button>
                            </form>';
                            
                            if (isset($_POST["cuerpo"])){
                                $cuerpo = $_POST["cuerpo"];
                                $fecha = date("Y-m-d H:i:s");
                                $identificador = $noticia->getIdentificador();
                                
                                mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET CUERPO = '$cuerpo', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                            }
                            
                        }
                    }
                    
                    echo'
                    
                    <!-- Vídeo -->
                    <iframe id = video src="'.$noticia->getVideo().'" frameborder="0" allowfullscreen></iframe>';


                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] == "jefe"){
                            echo '<form method="POST">
                                <textarea name="video">Cambiar Vídeo: '.$noticia->getVideo().'</textarea>
                                <button type=submit">Editar</button>
                            </form>';
                            
                            if (isset($_POST["video"])){
                                $cuerpo = $_POST["video"];
                                $fecha = date("Y-m-d H:i:s");
                                $identificador = $noticia->getIdentificador();
                                
                                mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET VIDEO = '$video', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                            }
                            
                        }
                    }


                    echo'

                    <!-- Imprimir -->
                    <div id = derecha>
                        <img id = "Logo_Comentarios" onclick="BotonComentarios()" src= Imagenes/comentarios.png alt="comentarios">
                        <a href="index.php?imprimir='.$noticia->getIdentificador().'" target="_blank"><img id = "Logos" src= Imagenes/impresora_logo.png alt="imprimir"></a>
                    </div>
                </div>';
            
                     
            include 'sidebar.php';
            echo '</div>';
            
        }
        
        function GenerarGaleria($seccion){
            $noticias = $GLOBALS['consulta']->ArrayNoticias();
            
            foreach ($noticias as $noticia){
                if ($noticia->getSeccion() == $seccion){
                    echo' 
                        <p id = foto><img id = "Imagen_gal" src= '.$noticia->getImagen().' alt="mundial">
                            <br>'.$noticia->getPie().'
                        </p>
                    ';
                }
            }
        }
        
        function GenerarIndex($principal, $noticias){
            $GLOBALS['imprimir']=false;
           
            echo ' <div id="Noticias">

                <div id="noticia_principal">

                    <img id = "Logos" src="'.$GLOBALS['consulta']->GetLogoConsulta($principal->getSeccion()).'" alt="Seccion">

                    <h1><a href="index.php?not='.$principal->getIdentificador().'">'.$principal->getTitulo().'</a></h1>

                    <img id="Imagen_Portada" src="'.$principal->getImagen().'">
                </div>

                <!-- Columnas -->
                ';
            
                $i = 0;
                echo '<div id="izquierda_noticias">';

                foreach($noticias as $noticia){
                    if ($i % 3 == 0 && $i < 9 && $noticia->getVisible() == 1){
                            echo '<a href="index.php?not='.$noticia->getIdentificador().'"><h2>'.$noticia->getTitulo().'</h2></a>
                            <img id="Imagen" src="'.$noticia->getImagen().'">';
                    }
                    $i++;
                }

                echo '</div>';


                $i = 0;
                echo '<div id="centro_noticias">';

                foreach($noticias as $noticia){
                    if ($i % 3 == 1 && $i < 9 && $noticia->getVisible() == 1){
                        if($i == 4){
                            $consulta = "SELECT * FROM publicidad WHERE IDENTIFICADOR = 3";
                            $result =  $this->conn->query($consulta);
                            $publicidad = $result->fetch_assoc();
                            $publicidades = new Publicidad($publicidad["IMAGEN"], $publicidad["IDENTIFICADOR"], $publicidad["TEXTO"]);
                            echo '<p id = foto><img id = Publicidad src="'. $publicidades->getImagen() .'"alt=publicidad></p>';
                        }
                        else{
                            echo '<a href="index.php?not='.$noticia->getIdentificador().'"><h2>'.$noticia->getTitulo().'</h2></a>
                            <img id="Imagen" src="'.$noticia->getImagen().'">';
                        }
                    }
                    $i++;
                }

                echo '</div>';


                $i = 0;
                echo '<div id="derecha_noticias">';

                foreach($noticias as $noticia){
                    if ($i % 3 == 2 && $i < 9 && $noticia->getVisible() == 1){
                            echo '<a href="index.php?not='.$noticia->getIdentificador().'"><h2>'.$noticia->getTitulo().'</h2></a>
                            <img id="Imagen" src="'.$noticia->getImagen().'">';
                    }
                    $i++;
                }

                echo '</div>';
                
            echo '</div>';
        }
        
        function GenerarSeccion($seccion){
            $GLOBALS['imprimir']=false;
            $noticias = $GLOBALS['consulta']->ArrayNoticias();
           
            echo '<div id= Seccion>';
            
                echo '<div id = Lista_noticias>
            
                    <div id = subsecciones>
                        <span id = sub> <a href ="index.php?secc='.$seccion.'&subsecc=galeria"> Galería </a> </span>
                        <span id = sub> <a href ="#"> Streaming </a> </span>
                        <span id = sub> <a href ="#"> Foro </a> </span>
                    </div>';
            
                    foreach ($noticias as $noticia){
                        if ($noticia->getSeccion() == $seccion && $noticia->getVisible() == 1){
                                echo '<div id = noticia_seccion>
                                    <img id="Imagen_Seccion" src="'.$noticia->getImagen().'">
                                    <h3><a href="index.php?not='.$noticia->getIdentificador().'">'.$noticia->getTitulo().'</a></h3>

                                    <p>'.$noticia->getEntradilla().'</p>
                                </div>';
                        }
                    }

                    include 'sidebar.php';
                echo '</div>';
            echo '</div>';    
        }
        
        function GenerarFormulario($tipo){
            echo '
                <form method="POST">
                    <fieldset>
                         <li>Nombre</li>
                             <input id = name type=text name="username" required>

                           <li>Contraseña</li>
                               <input id = contraseña type=password name="passw" required>';

                            if ($tipo == 'registro'){
                                echo '<li>Correo</li>
                                    <input id = correo  name="correo" required>';
                            }

                    echo '<br><input type=submit value=Enviar>

                    </fieldset>
                </form>';
                
            if ($tipo == "inicio"){
                if(isset($_SESSION["username"]) && isset($_POST["passw"])){
                    $username = $_SESSION["username"];
                    $passw = $_POST["passw"];
                    
                    if ($username == "" || $passw == ""){
                        $mensaje = "Faltan datos";
                        echo '<script type="text/javascript">','Alerta(\''.$mensaje.'\');','</script>';
                    }
                    
                    else{
                    
                        $usuario = $GLOBALS['consulta']->GetUsuario($username);
                        $_SESSION["email"] = $usuario->getCorreo();
                        
                        $tipo = $usuario->getTipo();

                        if ($passw == $usuario->getContraseña()){
                            //mysqli_change_user ($GLOBALS['conn'], $tipo, $passw, "periodico");
                            $mensaje = "Se ha identificado como $username (Tipo: $tipo)";
                            echo '<script type="text/javascript">','Alerta(\''.$mensaje.'\');','</script>';
                        }
                        else{
                            $mensaje = "Contraseña o usuario equivocados";
                            echo '<script type="text/javascript">','Alerta(\''.$mensaje.'\');','</script>';
                        }
                    }
                }    
            }
            
            else if ($tipo == "registro"){
                if(isset($_POST["username"]) && isset($_POST["passw"]) && isset($_POST["correo"])){
                    $username = $_POST["username"];
                    $passw = $_POST["passw"];
                    $correo = $_POST["correo"];
                    
                    if ($username == null || $passw == null || $correo == null){
                        $mensaje = "Faltan datos";
                        echo '<script type="text/javascript">','Alerta(\''.$mensaje.'\');','</script>'; 
                    }
                    else{
                        mysqli_query($GLOBALS['conn'], "INSERT INTO usuarios (NOMBRE, CONTRASEÑA, CORREO, TIPO) VALUES  ('$username', '$passw', '$correo', 'registrado')");
                    }
                }
            }
          
        }
        
        function GestorComentarios(){
            $comentarios = $GLOBALS['consulta']->ArrayComentarios();
            echo '<div id = Seccion>';
                echo '<div id= Lista_Comentarios>';
                
                if (!empty($comentarios)){
                    foreach ($comentarios as $comentario){

                            echo' 

                            <div id = Comentario>
                               <strong>' . $comentario->getNombre() . '</strong>
                               <br>'. $comentario->getFecha() . '
                               <div id = derecha>'. $comentario->getHora() .'</div>

                               <p>'. $comentario->getTexto() .'</p>';
                        
                               if ($comentario->getVisible() == 0){
                                    echo '<p> Visible: No </p>';
                               }
                               else{
                                    echo '<p>Visible: Si';
                               }
                                   
                               echo '<div id = botones_derecha>
                                    <form method="POST">
                                        <button type=submit name="Eliminar" value='.$comentario->getIdentificador().'> Eliminar </button>
                                    </form>
                                    
                                    <form method="POST">
                                        <button type=submit name="Incluir" value='.$comentario->getIdentificador().'> Incluir </button>
                                    </form>
                                    
                                    <form method="POST">
                               
                                        <textarea name="texto">'.$comentario->getTexto().'</textarea>
                                        <button type=submit name="Editar" value='.$comentario->getIdentificador().'> Editar </button>
                                    </form>
                                ';
                                    echo '</div>
                            </div>
                            ';
                          
                    }
                  
                     if (isset($_POST["Editar"])){
                      
                         $identificador = $_POST["Editar"];
                        $texto = $_POST["texto"];
                          $fecha = date("Y-m-d H:i:s");
                          echo $fecha;
                        mysqli_query($GLOBALS['conn'], "UPDATE comentarios SET TEXTO = '$texto', FECHA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                    }
                    else if (isset($_POST["Eliminar"])) {
                          
                           $identificador = $_POST["Eliminar"];
                        mysqli_query($GLOBALS['conn'], "DELETE FROM comentarios WHERE IDENTIFICADOR =' $identificador' ");
                        }
                    else if (isset($_POST["Incluir"])){
                           
                            $identificador = $_POST["Incluir"];
                           
                            mysqli_query($GLOBALS['conn'], "UPDATE comentarios SET VISIBLE = 1 WHERE IDENTIFICADOR = ' $identificador '");
                    }
                    
            
                }
            
                echo '</div>';
                include 'sidebar.php';
            echo '</div>';
        }
        
        
        function GestorNoticias($tipo){
            $noticias = $GLOBALS['consulta']->ArrayNoticias();
           
            echo '<div id= Seccion>';
            
                echo '<div id = Lista_noticias>';  
            
                    foreach ($noticias as $noticia){
                        if ($noticia->getSeccion() == $tipo || $tipo == ""){
                            
                            echo '<div id = noticia_seccion>
                        
                                <img id="Imagen_Seccion" src="'.$noticia->getImagen().'">
                                <h3><a href="index.php?not='.$noticia->getIdentificador().'">'.$noticia->getTitulo().'</a></h3>

                                <p>'.$noticia->getEntradilla().'</p>';
                            
                                if ($noticia->getVisible() == 0){
                                    echo '<p> Visible: No</p>';
                                }
                                else{
                                    echo '<p> Visible: Si</p>';
                                }
                                    
                                echo '<div id = botones_derecha>
                                    <form method="POST">
                                        <button type=submit name="Eliminar" value='.$noticia->getIdentificador().'> Eliminar </button>
                                    </form>
                                    
                                    <form method="POST">
                                        <button type=submit name="Incluir" value='.$noticia->getIdentificador().'> Incluir </button>
                                    </form>
                                    
                                    <form method="POST">
                                    
                                        <textarea name="texto">'.$noticia->getTitulo().'</textarea>
                                        <button type=submit name="Editar" value='.$noticia->getIdentificador().'> Editar Título </button>
                                    </form>
                                    
                                    <form method="POST">
                                    
                                        <textarea name="seccion">'.$noticia->getSeccion().' </textarea>
                                        <button type=submit name="EditarSeccion" value='.$noticia->getIdentificador().'> Editar Sección </button>
                                    </form>
                                </div>   
                            </div>';
                        }
                        
                       
                    }
                    
                    if (isset($_POST["Editar"])){
                      
                        $identificador = $_POST["Editar"];
                        $titulo = $_POST["texto"];
                        $fecha = date("Y-m-d H:i:s");
                        mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET TITULO = '$titulo', ULTIMA = '$fecha' WHERE IDENTIFICADOR = ' $identificador '");
                    }
                    else{
                        if (isset($_POST["Eliminar"])) {
                          $identificador = $_POST["Eliminar"];
                            
                        mysqli_query($GLOBALS['conn'], "DELETE FROM tabla_noticias WHERE IDENTIFICADOR =' $identificador' ");
                    }
                        if (isset($_POST["Incluir"])) {
                            $identificador = $_POST["Incluir"];
                            mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET VISIBLE = 1 WHERE IDENTIFICADOR = ' $identificador '");
                        }
                        if (isset($_POST["EditarSeccion"])) {
                            $identificador = $_POST["EditarSeccion"];
                            $seccion = $_POST["seccion"];
                            mysqli_query($GLOBALS['conn'], "UPDATE tabla_noticias SET SECCION = '$seccion' WHERE IDENTIFICADOR = ' $identificador '");
                        }
                    }
            
                    echo '</div>';
                include 'sidebar.php'; 
            echo '</div>';    
        }
        
        function GestorPublicidad(){
            $publicidades = $GLOBALS['consulta']->ArrayPublicidad();
              echo '<div id= Seccion>';
                 echo '<div id = Lista_noticias>';  
                    
                    foreach ($publicidades as $publicidad){  
                        echo' 
                        <div id = noticia_seccion>
                            <p id = foto_publicidad><img id = "Publicidad" src= '.$publicidad->getImagen().' alt="publicidad">
                                <br>'.$publicidad->getTexto().'
                            </p>
                      
                            <div id = botones_derecha>
                                        <form method="POST">
                                            <button type=submit name="Eliminar" value='.$publicidad->getIdentificador().' > Eliminar </button>
                                        </form>

                                        <form method="POST">
                                            <textarea name="texto">'.$publicidad->getTexto().'</textarea>
                                            <button type=submit name="Editar"  value='.$publicidad->getIdentificador().' > Editar </button>
                                        </form>


                                        <form method="POST">

                                            <textarea name="imagen">'.$publicidad->getImagen().'</textarea>
                                            <button type=submit name="Editar_Foto" value='.$publicidad->getIdentificador().' > Editar Foto </button>
                                        </form>
                                          ';
                            echo '</div>';
                        echo '</div>';
                    }
            
            echo '<div id=botones_derecha>
            
                    
                       <div id = botones_derecha>
                                                
                            <form method="POST">
                                <textarea name="texto">Añadir Título</textarea>
                                <textarea name="imagen">Añadir Foto</textarea>
                                <button type=submit name="Incluir_Foto" value='.$publicidad->getIdentificador().' > Incluir Nueva Publicidad </button>
                            </form>
                      </div>
            </div>
            ';
            // Para cambiar la publicidad actual o incluir una nueva
                if (isset($_POST["Editar"])){
                        $identificador = $_POST["Editar"];
                        $texto = $_POST["texto"];
                  
                    
                        mysqli_query($GLOBALS['conn'], "UPDATE publicidad SET TEXTO = '$texto' WHERE IDENTIFICADOR = ' $identificador '");
                }
                else if(isset($_POST["Editar_Foto"])){
                        $identificador = $_POST["Editar_Foto"];
                        $imagen = $_POST["imagen"];
                        
                        mysqli_query($GLOBALS['conn'], "UPDATE publicidad SET IMAGEN = '$imagen' WHERE IDENTIFICADOR = ' $identificador '");
                }else if (isset($_POST["Eliminar"])){
                            
                        if (isset($_POST["Eliminar"])) {
                        $identificador = $_POST["Eliminar"];
                            
                        mysqli_query($GLOBALS['conn'], "DELETE FROM publicidad WHERE IDENTIFICADOR =' $identificador' ");
                            
                        }
                }else if (isset($_POST["Incluir_Foto"])){
                     $identificador = $_POST["Incluir_Foto"];
                     $texto = $_POST["texto"];
                     $imagen = $_POST["imagen"];
                     $identificador += 1;
                    
                     mysqli_query($GLOBALS['conn'], "INSERT INTO publicidad (TEXTO, IDENTIFICADOR, IMAGEN) VALUES  ('$texto','$identificador', '$imagen')");
                    
                    
                }
                    
                    
                    echo '</div>';
                        include 'sidebar.php'; 
               echo '</div>';
            
        }
         function GestorSecciones(){
            $logos = $GLOBALS['consulta']->ArrayLogos();
              echo '<div id= Seccion>';
                 echo '<div id = Lista_noticias>';  
                    
                    foreach ($logos as $logo){  
                        echo' 
                        <div id = noticia_seccion>
                            <p id = foto_publicidad><img id = "Publicidad" src= '.$logo->getLogo().' alt="logo">
                             
                            </p>
                            <h3>'.$logo->getSeccion().'</h3>
                      
                        <div id = botones_derecha>
                                                
                                                
                                    <form method="POST">
                                        <button type=submit name="Eliminar" value='.$logo->getIdentificador().' > Eliminar </button>
                                    </form>
                                                
                                    <form method="POST">
                                        
                                        <textarea name="imagen">'.$logo->getLogo().'</textarea>
                                        <button type=submit name="Editar_Foto" value='.$logo->getIdentificador().'> Editar Foto </button>
                                    </form>
                                     <form method="POST">
                                        <textarea name="texto">'.$logo->getSeccion().'</textarea>
                                        <button type=submit name="Editar" value='.$logo->getIdentificador().'> Editar Nombre Seccion </button>
                                    </form>
                                       ';
                        
                        echo '</div>';
                        echo '</div>';
                    }
            
            echo '<div id=botones_derecha>
                       <div id = botones_derecha>
                                                
                            <form method="POST">
                                <textarea name="texto">Añadir Título</textarea>
                                <textarea name="imagen">Añadir Logo</textarea>
                                <button type=submit name="Incluir_Logo" value='.$logo->getIdentificador().' > Incluir Nueva Sección </button>
                            </form>
                      </div>
            </div>
            ';
             
            // Para cambiar las secciones actual o incluir una nueva
                if (isset($_POST["Editar"])){
                        $identificador = $_POST["Editar"];
                        $texto = $_POST["texto"];
                                     
                        mysqli_query($GLOBALS['conn'], "UPDATE logos SET SECCION = '$texto' WHERE IDENTIFICADOR = '$identificador'");
                }
                else if(isset($_POST["Editar_Foto"])){
                        $identificador = $_POST["Editar_Foto"];
                        $imagen = $_POST["imagen"];
                        
                        mysqli_query($GLOBALS['conn'], "UPDATE logos SET LOGO = '$imagen' WHERE IDENTIFICADOR = '$identificador'");
                }else if (isset($_POST["Eliminar"])){
                        $identificador = $_POST["Eliminar"];   
                    
                        mysqli_query($GLOBALS['conn'], "DELETE FROM logos WHERE IDENTIFICADOR = '$identificador'");
                }else if (isset($_POST["Incluir_Logo"])){
                     $identificador = $_POST["Incluir_Logo"];
                     $texto = $_POST["texto"];
                     $imagen = $_POST["imagen"];
                     $identificador += 1;
                    
                     mysqli_query($GLOBALS['conn'], "INSERT INTO logos (SECCION, LOGO, IDENTIFICADOR) VALUES  ('$texto', '$imagen', '$identificador')");                
                }
                    
                    
                    echo '</div>';
                        include 'sidebar.php'; 
               echo '</div>';
            
        }
        

        function NuevaNoticia(){
                    
                    echo'  <div id = "Noticia">
                        <div id = "Cuerpo">

                        <h2> Nueva Noticia </h2>

                        <form method="POST">
                            <h3>Título</h3>
                            <textarea name="Titular"> Añadir Titular </textarea>

                            <h3>Subtítulo</h3>
                            <textarea name="Subtitulo"> Añadir Subtitulo</textarea>

                            <h3>Entradilla</h3>
                            <textarea name="Entradilla"> Añadir Entradilla </textarea>

                            <h3>Imagen</h3>
                            <textarea name="Imagen"> Añadir Imagen </textarea>

                            <h3>Pie de foto</h3>
                            <textarea name="Pie"> Añadir Pie de Foto </textarea>

                            <h3>Cuerpo</h3>
                            <textarea name="Cuerpo"> Añadir Cuerpo </textarea>

                            <h3>Vídeo</h3>
                            <textarea name="Video"> Añadir Video </textarea>

                            <button type=submit>Enviar</button>

                          </form>


                        </div>';

           
                     if (isset($_POST["Titular"]) && isset($_POST["Subtitulo"]) && isset($_POST["Entradilla"]) && isset($_POST["Imagen"]) && isset($_POST["Pie"]) &&isset($_POST["Cuerpo"]) && isset($_POST["Video"])){
                         
                        $Titular = $_POST["Titular"];
                        $Subtitulo = $_POST["Subtitulo"];
                        $Entradilla = $_POST["Entradilla"];
                        $Imagen = $_POST["Imagen"];
                        $Pie = $_POST["Pie"];
                        $Cuerpo = $_POST["Cuerpo"];
                        $Video = $_POST["Video"];

                        $Autor = $_SESSION["username"];
                        $Fecha = date("Y-m-d H:i:s");
                        
                        
                        $result = mysqli_query($GLOBALS['conn'] ,"SELECT MAX(IDENTIFICADOR) FROM tabla_noticias");
                        $row = mysqli_fetch_row($result);
                        $maximo_id = $row[0];
                        $maximo_id += 1;
            
            
                        mysqli_query($GLOBALS['conn'], "INSERT INTO tabla_noticias (TITULO, IDENTIFICADOR, FECHA, ULTIMA,CUERPO,SUBTITULO,ENTRADILLA,AUTOR,IMAGEN,PIE,VIDEO,VISIBLE)VALUES('$Titular','$maximo_id','$Fecha','$Fecha','$Cuerpo','$Subtitulo', '$Entradilla','$Autor', '$Imagen','$Pie','$Video',0)");
                     }
                    
                include 'sidebar.php';
                echo '</div>';

             }
             
/*
         function OrganizadorIndex(){
         
              echo'  <div id = "Noticia">
                        <div id="Noticias">

                    <div id="noticia_principal">

                        <img id = "Logos" " alt="Seccion">

                        <h1><</h1>

                        <>
                    </div>

                    <!-- Columnas -->
                    ';

                    $i = 0;
                    echo '<div id="izquierda_noticias">';

                    foreach($noticias as $noticia){
                        if ($i % 3 == 0 && $i < 9 && $noticia->getVisible() == 1){
                                echo '<a href="index.php?not='.$noticia->getIdentificador().'"><h2>'.$noticia->getTitulo().'</h2></a>
                                <img id="Imagen" src="'.$noticia->getImagen().'">';
                        }
                        $i++;
                    }

                    echo '</div>';


                    $i = 0;
                    echo '<div id="centro_noticias">';

                    foreach($noticias as $noticia){
                        if ($i % 3 == 1 && $i < 9 && $noticia->getVisible() == 1){
                            if($i == 4){
                                $consulta = "SELECT * FROM publicidad WHERE IDENTIFICADOR = 3";
                                $result =  $this->conn->query($consulta);
                                $publicidad = $result->fetch_assoc();
                                $publicidades = new Publicidad($publicidad["IMAGEN"], $publicidad["IDENTIFICADOR"], $publicidad["TEXTO"]);
                                echo '<p id = foto><img id = Publicidad src="'. $publicidades->getImagen() .'"alt=publicidad></p>';
                            }
                            else{
                                echo '<a href="index.php?not='.$noticia->getIdentificador().'"><h2>'.$noticia->getTitulo().'</h2></a>
                                <img id="Imagen" src="'.$noticia->getImagen().'">';
                            }
                        }
                        $i++;
                    }

                    echo '</div>';


                    $i = 0;
                    echo '<div id="derecha_noticias">';

                    foreach($noticias as $noticia){
                        if ($i % 3 == 2 && $i < 9 && $noticia->getVisible() == 1){
                                echo '<a href="index.php?not='.$noticia->getIdentificador().'"><h2>'.$noticia->getTitulo().'</h2></a>
                                <img id="Imagen" src="'.$noticia->getImagen().'">';
                        }
                        $i++;
                    }

                    echo '</div>';

                echo '</div>';
            }

               
                //include 'sidebar.php';
                echo '</div>';
        
    }*/
    }
    

    $consulta = New Consulta($conn);
    
        switch($secc){
            case "league of legends":
                if ($subsecc == 'galeria'){
                    $consulta->GenerarGaleria($secc);
                }
                else{
                    $consulta->GenerarSeccion('league of legends');
                }
                break;
            case "counter":
                if ($subsecc == 'galeria'){
                    $consulta->GenerarGaleria($secc);
                }
                else
                    $consulta->GenerarSeccion('counter');
                
                break;
            case "starcraft":
                if ($subsecc == 'galeria'){
                    $consulta->GenerarGaleria($secc);
                }
                else
                    $consulta->GenerarSeccion('starcraft');  
                
                break;
            case "iniciar_sesion":
                $consulta->GenerarFormulario('inicio');  
                
                break;
            case "registro":
                $consulta->GenerarFormulario('registro');  
                
                break;
            case "gestor_comentarios":
                $consulta->GestorComentarios();  
                
                break;
            case "gestor_noticias":
                $consulta->GestorNoticias($tipo);  
                
                break;
            case "gestor_publicidad":
                $consulta->GestorPublicidad();  
                
                break;
            case "nueva_noticia":
                $consulta->NuevaNoticia();  
                
                break;
            case "gestor_secciones":
                $consulta->GestorSecciones();  
                
                break;
           /* case "organizador_index":
                $consulta->OrganizadorIndex();  
                
                break;*/
            default:
                // No hay sección
                if($not > 0 && $imprimir == 0){
                    $pequena = $consulta->GetNoticia($not);
                    $consulta->GenerarNoticia($pequena);
                }else if($imprimir == 0  && $not == 0) {
                    $principal = $consulta->GetNoticiaPrincipal();
                    $noticias = $consulta->ArrayNoticias();
                    $consulta->GenerarIndex($principal, $noticias);
                }else{
                    $pequena = $consulta->GetNoticia($imprimir);
                    $consulta->GenerarNoticiaImprimir($pequena);
                }
                break;
        }
    ?>
        