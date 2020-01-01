<?php
    if($GLOBALS['imprimir'] == false){
        echo'
            <div id="cabecera">
                <img id = "LogoCabecera" src="Imagenes/E-Sport-Logo.png">
                    <div id="LogosCabecera">
                        <a href="index.php?"><img id="LogosEstilo" src="Imagenes/Home.png"></a>
                        <a href="index.php?secc=league of legends"><img id="LogosEstilo" src="Imagenes/LoL.png"></a>
                        <a href="index.php?secc=counter"><img id="LogosEstilo" src="Imagenes/CSGO.png"></a>
                        <a href="index.php?secc=starcraft"><img id="LogosEstilo" src="Imagenes/SC2.png"></a>
                        
                </div>
                    <div id="Login">';
                    if(isset($_SESSION['username'])){
                        echo '<h4>Usuario: '.$_SESSION['username'].' - <a href=logout.php>Cerrar sesión</a></h4>';
                    }
                    else{
                        echo '<h4><a href="index.php?secc=iniciar_sesion"> Iniciar Sesión </a> - <a href="index.php?secc=registro"> Registrarse </a> - ¿Ha  olvidado la contraseña?</h4>';
                    }
                    echo '</div>
                    
                    <div id="Buscador">';
                    if(isset($_SESSION['username'])){
                        $tipo = $_SESSION['username'];
                    }
                    else{
                        $tipo = "user";
                    }
        
                        echo '<input type="search" name="buscador" placeholder="Buscar..." onkeyup="Buscador(this.value, \''.$tipo.'\')" autocomplete="off">
                        <span id="txtHint"></span>';
                    echo '</div>
            </div>';
    }else{
        echo '';
    }
?>
