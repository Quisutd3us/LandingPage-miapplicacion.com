
<?php 

require_once('recaptchalib.php');
  $privatekey = "6LeRUzsUAAAAACGWbAsiaAsxUqGiKZZVKIQZ34J_";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("El reCAPTCHA No fue Ingresado Correctamente. Intentelo Nuevamente.");
  } else {
    // Your code here to handle a successful verification
  }

error_reporting(E_ALL);
ini_set('display_errors',1);

$error='';
$nombre='';
$email='';
$comentario='';
$telefono='';
$cuerpo='';
$enviarA='';
$asunto='';
$success ='';
$gustos="";

//validando el campo nombre
 if(empty($_POST["nombre"])){
    $error = 'Ingrese un Nombre<br>';
 }else{
    //Flitrando campo nombre
    $nombre = $_POST['nombre'];
    $nombre = trim($nombre);
    if($nombre ==""){
        $error = 'El Nombre esta Vacio<br>';
    }else{
        $nombre = filter_var($nombre,FILTER_SANITIZE_STRING);
    }
 }
//validando el campo email

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
    $error .= 'Ingrese un mensaje<br>';
}else{
    //Flitrando campo textarea
    $comentario = $_POST['comentario'];
    $comentario = filter_var($comentario,FILTER_SANITIZE_STRING);
}

// Validando el campo Preferecias

if(empty($_POST['gustos'])){
    $error .= 'Seleccione un Gusto<br>';
}else{
    $gustos = $_POST['gustos'];
    $gustos = filter_var($gustos,FILTER_SANITIZE_STRING);
}

//Validando el campo Numero
if(empty($_POST['telefono'])){
    $error .= 'Seleccione un Gusto<br>';
}else{
    $telefono = $_POST['telefono'];
    $telefono = trim($telefono);
    if($telefono ==""){
        $telefono = 'El Telefono esta Vacio<br>';
    }else{
        $telefono = filter_var($telefono,FILTER_SANITIZE_NUMBER_INT);
    }
    
}

// Creando el Email

// creando el cuerpo
$cuerpo = 'Nombre: '.$nombre.'<br>';
$cuerpo .= 'Email: '.$email.'<br>';
$cuerpo .= 'Preferencias: '.$gustos.'<br>';
$cuerpo .= 'Telefono: '.$telefono.'<br>';
$cuerpo .= 'Mensaje: '.$comentario.'<br>';

// creando el destinatario

$enviarA = 'dnarino@gmail.com';
$asunto = 'Nuevo Mensaje del Landing Page';


 if($error == ''){
    //va con datos
    $success= mail($enviarA,$asunto,$cuerpo,'de: '.$email);
    echo true;
 }else{
    // va sin datos
     echo $error;
 }


 //  conectando Bd Contacto
 @include_once('conexionMkt.php');

//  INSERT INTO `tbl_contacto` (`id`, `nombre`, `email`, `gustos`, `telefono`, `mensaje`) VALUES (NULL, 'David Salinas', 'dnarino@gmail.com', 'Musica', '3007452187', 'dasfsdafsdafasdfdsafdsafda');

 $sqlContacto = 'INSERT INTO tbl_contacto (id, nombre, email, gustos, telefono, mensaje) VALUES (NULL, :nombre, :email, :gustos, :telefono, :comentario)';

 $preparadoContacto = $conexionMkt -> prepare($sqlContacto);

 $preparadoContacto -> execute(array(':nombre'=> $nombre,':email'=> $email,':gustos'=> $gustos,':telefono'=> $telefono,':comentario'=> $comentario,));


?>