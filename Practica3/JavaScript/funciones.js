function CrearComentario() {
    var d = new Date();
    var fecha = d.getUTCDate() + "/" + d.getMonth() + "/" + d.getFullYear();
    var hora = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
    var nombre = document.getElementById("name").value;
    var correo = document.getElementById("correo").value;
    var comentario = document.getElementById("comment").value;
    
    if (nombre == "" || correo == "" || comentario == "") {
        alert("Faltan datos");
        return false;
    } else {
        // Nombre
        var nodo_nombre = document.createElement("H");
        var texto_nombre = document.createTextNode(nombre);
        nodo_nombre.style.fontWeight = "bold";
        nodo_nombre.appendChild(texto_nombre);
        document.getElementById("nuevo_comentario").appendChild(nodo_nombre);
        document.getElementById("nuevo_comentario").appendChild(document.createElement("BR"));

        // Fecha
        var nodo_fecha = document.createElement("H");
        var texto_fecha = document.createTextNode(fecha);
        nodo_fecha.appendChild(texto_fecha);
        document.getElementById("nuevo_comentario").appendChild(nodo_fecha);

        // Hora
        var nodo_hora = document.createElement("H");
        var texto_hora = document.createTextNode(hora);
        nodo_hora.style.float = "right";
        nodo_hora.appendChild(texto_hora);
        document.getElementById("nuevo_comentario").appendChild(nodo_hora);


        // Texto
        var nodo_comentario = document.createElement("P");
        var texto_comentario = document.createTextNode(comentario);
        nodo_comentario.appendChild(texto_comentario);
        document.getElementById("nuevo_comentario").appendChild(nodo_comentario);


        // Estilo
        var div = document.createElement("div");
        div.style.borderBottom = "solid black 1px";
        div.style.marginBottom = "5%";
        document.getElementById("nuevo_comentario").appendChild(div);


        document.getElementById("name").value = "";
        document.getElementById("correo").value = "";
        document.getElementById("comment").value = "";
    }
}
                
                
                
function BotonComentarios() {
    if (document.getElementById("Comentarios").style.visibility == 'visible') {
        document.getElementById("Comentarios").style.visibility = 'hidden';
        document.getElementById("Lateral").style.visibility = 'visible';
        document.getElementById("Logo_Comentarios").style.backgroundColor = '';
    } else {
        document.getElementById("Comentarios").style.visibility = 'visible';
        document.getElementById("Lateral").style.visibility = 'hidden';
        document.getElementById("Logo_Comentarios").style.backgroundColor = 'aqua';
    }
}

function BotonGaleria() {
       window.open("HOLA");
}
    
    
    

function Prohibidas() {
    var texto = document.getElementById("comment").value;
    var palabras = ["tonto", "perro", "pablo", "muerte", "satan", "idiota", "noob", "puta", "zorra", "retrasado"];
    
    for (i = 0; i < palabras.length; i++) {
        var n = palabras[i].length;
        
        texto = texto.replace(RegExp(palabras[i], "gi"), "*".repeat(n));
        document.getElementById("comment").value = texto;
    }
}