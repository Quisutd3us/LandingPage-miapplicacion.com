<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$datos="";
$usuario="";
$contrasena="";
$conexionMkt="";

// Conexion hostinger

$datos ='mysql:host=mysql.hostinger.co;dbname=u870474563_00002';
$usuario = 'u870474563_user2';
$contrasena= 'ge3m6vSSOBj6';

// conexion local

// $datos = 'mysql:host=localhost;dbname=bd_miapplicacion_mkt';
// $usuario = 'root';
// $contrasena= 'root';


try{
    $conexionMkt = new PDO($datos, $usuario , $contrasena);
    // echo 'conectado bd contacto';
}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>