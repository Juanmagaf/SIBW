<?php
if($GLOBALS['imprimir'] == false){
            echo '
                <div id= "pie">
                            <div id="derecha">
                            <a href="https://www.gmail.com" target="_blank"><img id="Logos" src="Imagenes\email_logo.jpg" alt="eMail"></a>';
    
                            $noticia = $GLOBALS['consulta']->GetNoticia($not);
                            $titulo = $noticia->getTitulo();
    
                            echo '<img id = "Logos" onclick="Twitter(\''.$titulo.'\')" src= Imagenes/twitter_logo.jpg alt="twitter">

                            <a href="https://www.facebook.com" target="_blank"><img id="Logos" src="Imagenes\facebook_logo.jpg" alt="facebook"></a>   

                        </div>  
                      <br><a href="#">Juan Raúl Moreno Tamayo / Juan Manuel González-Aurioles Fernández</a> 
                </div>
            ';
    }else{
        echo '';
    }
?>
