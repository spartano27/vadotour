<?php

include_once "core/db.php";
include_once "modelo/modeloCliente.php";

$con = crearConexionBD();

$error1= '';
$error2= '';
$error3= '';
$error4= '';
$error5= '';
$error6= '';
$error7= '';
$error8= '';
$error9= '';
$error10= '';
$error11= '';


if (isset($_REQUEST['Registrarse'])){
    $correcto = 1;

$valor1 = $_REQUEST['email'];
$valor2 = $_REQUEST['password'];
$valor3 = $_REQUEST['password2'];
$valor4 = $_REQUEST['nombre'];
$valor5 = $_REQUEST['apellidos'];
$valor6 = $_REQUEST['dni'];
$valor7 = $_REQUEST['nacimiento'];
$valor8 = $_REQUEST['provincia'];
$valor12 = $_REQUEST['localidad'];
$valor9 = $_REQUEST['cp'];
$valor10 = $_REQUEST['direccion'];
$valor11 = $_REQUEST['telefono'];

if (!preg_match('/^.*\@.*\..*$/i', $_REQUEST['email'])){
    $correcto = 0;
    $error1 = "
    <span class = 'error'> Correo electrónico inválido.</span>";
    $valor1='';
    }


if (!preg_match('/^.{5,30}$/', $_REQUEST['password'])){
    $correcto = 0;
    $error2 = "
    <span class = 'error'> Contraseña inválida.</span>";
    $valor2='';
    }

if ($_REQUEST['password'] != $_REQUEST['password2']){
    $correcto = 0;
    $error3 = "
    <span class = 'error'> Las contraseñas no coinciden.</span>";
    $valor3='';
    }

if (!preg_match('/^[a-zA-Zíóúéáñ]{1,30}$/', $_REQUEST['nombre'])){
    $correcto = 0;
    $error4 = "
    <span class = 'error'> Nombre inválido.</span>";
    $valor4 = '';
    }

if (!preg_match('/^[a-zA-ZíóúéáñÍÓÚÉÁÑ ]{1,60}$/', $_REQUEST['apellidos'])){
    $correcto = 0;
    $error5 = "
    <span class = 'error'> Apellidos inválidos.</span>";
    $valor5 = '';
    }

if (!preg_match('/^\d{8}[a-z]$/i', $_REQUEST['dni'])){
    $correcto = 0;
    $error6 = "
    <span class = 'error'> DNI inválido.</span>";
    $valor6 = '';
    }

if (!preg_match('/^[a-zA-ZíóúéáñÍÓÚÉÁÑ ]{1,30}$/', $_REQUEST['localidad'])){
    $correcto = 0;
    $error7 = "
    <span class = 'error'> Localidad inválida.</span>";
    $valor12= '';
    }

if (!preg_match('/^[a-zA-ZíóúéáñÍÓÚÉÁÑ ]{1,30}$/', $_REQUEST['provincia'])){
    $correcto = 0;
    $error8 = "
    <span class = 'error'> Provincia inválida.</span>";
    $valor8= '';
    }

if (!preg_match('/^[0-9]{5}$/', $_REQUEST['cp'])){
    $correcto = 0;
    $error9 = "
    <span class = 'error'> Código Postal inválido.</span>";
    $valor9= '';
    }

if (!preg_match('/^.{1,30}$/', $_REQUEST['direccion'])){
    $correcto = 0;
    $error10 = "
    <span class = 'error'> Dirección inválida.</span>";
    $valor10= '';
    }

if (!preg_match('/^[0-9]{9}$/', $_REQUEST['telefono'])){
    $correcto = 0;
    $error11 = "
    <span class = 'error'> Teléfono inválido.</span>";
    $valor11= '';
   }
if($correcto == 1){
    $datosUsuario = ["nombre" => $_REQUEST['nombre'], "apellidos" => $_REQUEST['apellidos'], "email" => $_REQUEST['email'], "password" => $_REQUEST['password']];
    $datosCliente = ["dni" => $_REQUEST['dni'], "nacimiento" => $_REQUEST['nacimiento'], "localidad" => $_REQUEST['localidad'], "provincia" => $_REQUEST['provincia'], "cp" => $_REQUEST['cp'], "direccion" => $_REQUEST['direccion'], "telefono" => $_REQUEST['telefono'] ];
    registroCliente($con, $datosUsuario, $datosCliente);
}
echo $error1. $error2. $error3. $error4. $error5. $error6. $error7. $error8. $error9. $error10. $error11;
echo 

}