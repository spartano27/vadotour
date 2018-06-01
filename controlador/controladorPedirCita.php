<?php

include_once "core/db.php";
include_once "core/utils.php";
include_once "modelo/modeloCita.php";

$con = crearConexionBD();

$idUser = 2;

function huecosOcupadosProximaSemana(){
    global $con;
    // en ahora se le restan 10 semanas para las pruebas
    $ahora = fromTimeToDate(time() -  10*(7 * 24 * 60 * 60));
    $semanaSiguiente = fromTimeToDate(time() +  (7 * 24 * 60 * 60));
    return getHuecosOcupadosEntre($con, $ahora, $semanaSiguiente);
}

if(isset($_REQUEST["crearCita"])){

    $fecha = $_REQUEST["fecha"];
    $hora = $_REQUEST["horas"];
    $minutos = $_REQUEST["minutos"];

    $tipoCita = $_REQUEST["tipoCita"];
    $nota = $_REQUEST["nota"];

    $fechaYHora = $fecha . " " . $hora . ":" . $minutos . ":00";

    createCita($con, $idUser, strtotime($fechaYHora), $tipoCita, $nota);

}