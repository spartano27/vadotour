<?php


include_once "core/db.php";
include_once "modelo/modeloCliente.php";
$con = crearConexionBD();

$idUsuario = $_SESSION["id_usuario"];
$datosusuario = getUsuarioPorId($con, $idUsuario);

$pass = $datosusuario[3];

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

if (isset($_REQUEST['Cambiardatos'])){
    $correcto = 1;

    $valor2 = $_REQUEST['password-nueva'];
    $valor3 = $_REQUEST['password'];
    $valor4 = $_REQUEST['nombre'];
    $valor5 = $_REQUEST['apellidos'];
    $valor6 = $_REQUEST['dni'];
    $valor8 = $_REQUEST['provincia'];
    $valor12 = $_REQUEST['localidad'];
    $valor9 = $_REQUEST['cp'];
    $valor10 = $_REQUEST['direccion'];
    $valor11 = $_REQUEST['telefono'];


    if(!empty($_REQUEST['password-nueva'])){
        if (!preg_match('/^.{5,30}$/', $_REQUEST['password-nueva'])){
            $correcto = 0;
            $error2 = "
            <span class = 'error'> Contraseña inválida.</span>";
            $valor2='';
        }

        if ($pass != md5($_REQUEST['password'])){
            $correcto = 0;
            $error3 = "
            <span class = 'error'> La contraseña actual no coincide con la contraseña dada.</span>";
            $valor3='';
        }
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

    if (!empty($_REQUEST['telefono']) && !preg_match('/^[0-9]{9}$/', $_REQUEST['telefono'])){
        $correcto = 0;
        $error11 = "
        <span class = 'error'> Teléfono inválido.</span>";
        $valor11= '';
    }

    if($correcto == 1){
        if(empty($_REQUEST['password-nueva'])){
            $newPass = $pass;
        }else{
            $newPass = md5($_REQUEST['password-nueva']);
        }

        $datosUsuario = [$_REQUEST['nombre'], $_REQUEST['apellidos'], $newPass, $idUsuario];
        $datosCliente = [$_REQUEST['dni'], $_REQUEST['localidad'], $_REQUEST['provincia'], $_REQUEST['cp'], $_REQUEST['direccion'], $_REQUEST['telefono'], $idUsuario];
        updateCliente($con, $datosUsuario, $datosCliente);
    }
    echo $error1. $error2. $error3. $error4. $error5. $error6. $error7. $error8. $error9. $error10. $error11;
}

// Se requieren estos datos despues de hacer las comprobaciones por si se actualizan, para coger los actualizados.
$datoscliente = getCliente($con, $idUsuario);
$datosusuario = getUsuarioPorId($con, $idUsuario);

$dni = $datoscliente[0];
$localidad = $datoscliente[1];
$provincia = $datoscliente[2];
$cp = $datoscliente[3];
$telefono = $datoscliente[5];
$direccion = $datoscliente[6];

$nombre = $datosusuario[0];
$apellidos = $datosusuario[1];
$email = $datosusuario[2];
$pass = $datosusuario[3];
