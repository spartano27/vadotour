<?php

include_once "core/db.php";
include_once "core/utils.php";
include_once "modelo/modeloCita.php";
include_once "modelo/modeloComentario.php";

$con = crearConexionBD();
$idUsuario = 2;

if(isset($_GET["idCita"])){
    $idCita = $_GET["idCita"];
} else{
    header("Location: vistaMisCitas.php");
}

if(isset($_POST["comentario-creado"]) && !empty($_POST["comentario-cuerpo"])){
    global $con, $idUsuario, $idCita;

    $cuerpoComentario = $_POST["comentario-cuerpo"];
    $fecha = fromTimeToDatetime(time());

    crearComentario($con, $idUsuario, $idCita, $cuerpoComentario, $fecha);
}

function reparacion(){
    global $con, $idCita;
    return getReparacionDeCita($con, $idCita);
}

function comentarios(){
    global $con, $idCita;
    return getComentariosDeCita($con, $idCita);
}