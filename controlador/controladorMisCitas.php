<?php

include_once "core/db.php";
include_once "modelo/modeloCita";

$con = crearConexionBD();


$filtros = ["clientId" => 1];

function getCitasFiltradas(){
    global $con, $filtros;
    return getCitasFiltradasDB($con, $filtros);
}

?>