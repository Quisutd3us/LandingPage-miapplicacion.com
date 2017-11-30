
<?php 
$error ='';

//validando el campo nombre
if(empty($_POST['nombre'])){
    $error = 'Ingrese un Nombre<br>';
}else{
    //Flitrando campo nombre
    $nombre = $_POST['nombre'];
    $nombre = filter_var($nombre,FILTER_SANITIZE_STRING);
}

if(empty($_POST['email'])){
    $error.='Ingrese un Email<br>';
}else{
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error.= 'Ingrese un Email Valido de la forma dnarino@gmail.com<br>';
    }else{
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }
}

if(empty($_POST['comentario'])){
    $error .= 'Ingrese un comentario<br>';
}else{
    //Flitrando campo textarea
    $comentario = $_POST['comentario'];
    $comentario = filter_var($comentario,FILTER_SANITIZE_STRING);
}

// Creando el Email

// creando el cuerpo
$cuerpo = 'Nombre: '.$nombre.'/n';
$cuerpo .= 'Email: '.$email.'/n';
$cuerpo .= 'Mensaje: '.$mensaje.'/n';


// creando el destinatario

$enviarA = 'dnarino@gmail.com';
$asunto = 'Nuevo Mensaje del Landing Page';


if($error == ''){
    $success= mail($enviarA,$asunto,$cuerpo,'de: '.$email);
    echo 'exito';
}else{
    echo $error;
}

?>