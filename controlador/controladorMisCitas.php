<?php

include_once "core/db.php";
include_once "modelo/modeloCita.php";

$con = crearConexionBD();


$filtros = ["ID_USUARIO" => 2];

function getCitasFiltradas(){
    global $con, $filtros;
    return getCitasFiltradasDB($con, $filtros);
}

?>