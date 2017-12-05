
<?php 

error_reporting(E_ALL);
ini_set('display_errors',1);

$errorMkt='';
$emailMkt='';


//validando el campo email

if(empty($_POST['mktEmail'])){
    $errorMkt='Ingrese un Email<br>';
}else{
    $emailMkt = $_POST['mktEmail'];
    if(!filter_var($emailMkt, FILTER_VALIDATE_EMAIL)){
        $errorMkt.= 'Ingrese un Email Valido de la forma nombre@correo.com<br>';
    }else{
        $errorMkt = filter_var($errorMkt, FILTER_SANITIZE_EMAIL);
    }
}



// Creando el Email

// creando el cuerpo
$cuerpo = 'Email: '.$emailMkt.'<br>';

// creando el destinatario

$enviarA = 'dnarino@gmail.com';
$asunto = 'Tienes un nuevo suscriptor';




 if($errorMkt == ''){
    //va con datos
    mail($enviarA,$asunto,$cuerpo,'de: '.$emailMkt);
    echo true;
 }else{
    // va sin datos
     echo $errorMkt;
 }

//  conectando Bd Marketing
 @include_once('conexionMkt.php');
 // INSERT INTO `tbl_form_marketing` (`id`, `email`) VALUES (NULL, 'dnarino@gmail.com');

 $sqlMkt = 'INSERT INTO tbl_form_marketing (id, email) VALUES (NULL, :emailMkt)';
 $preparadoMkt = $conexionMkt -> prepare($sqlMkt);
 $preparadoMkt -> execute(array(':emailMkt'=> $emailMkt));
?>