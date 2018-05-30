<?php

include_once "core/db.php";
include_once "modelo/modeloCita.php";

$con = crearConexionBD();

$filtros = ["ID_USUARIO" => 2];

// Se ha pulsado el boton de filtrar
if (isset($_POST["filtrar"])){

    if(!empty($_POST["fecha-inicio"])){
        $filtros["FECHA_INICIO"] = $_POST["fecha-inicio"];
    }

    if(!empty($_POST["fecha-fin"])){
        $filtros["FECHA_FIN"] = $_POST["fecha-fin"];
    }

    // Se elige el tipo de cita a mostrar.
    if(isset($_POST["tipo-cita"])) {

        $tipoCita = $_POST["tipo-cita"];

        // Valor -1 es para todas las citas (opcion por defecto). Por lo que solo se
        // filtra si se ha cambiado de opcion
        if($tipoCita != -1){
            $filtros["ID_TIPO_CITA"] = $tipoCita;
        }
    }

    // Se selecciona si ha sido aceptada o no.
    if(isset($_POST["aceptada"])) {

        $aceptada = $_POST["aceptada"];

        if($aceptada != -1){
            $filtros["ACEPTADA"] = $aceptada;
        }
    }

    if(isset($_POST["anulada"])) {

        $anulada = $_POST["anulada"];

        if($anulada != -1){
            $filtros["ANULADO"] = $anulada;
        }
    }
}

// Si se selecciona Mostrar Todas, se eliminan los filtros actuales
if(isset($_POST["mostrar-todas"])){

    unset($_POST["filtrar"]);
    unset($_POST["tipo-cita"]);
    unset($_POST["aceptada"]);
    unset($_POST["anulada"]);
    unset($_POST["fecha-inicio"]);
    unset($_POST["fecha-fin"]);

}

function citasFiltradas(){
    global $con, $filtros;
    return getCitasFiltradasDB($con, $filtros);
}

function todasCitas(){
    global $con;
    $filtro = ["ID_USUARIO" => 2];
    return getCitasFiltradasDB($con, $filtro);
}

function fechas(array $todasCitas,array $citasFiltradas){
    $fechas = [];

    $fechas["ultimaCita"] = date("Y-m-d", strtotime($todasCitas[0]["FECHA"]));
    $fechas["primeraCita"] = date("Y-m-d", strtotime(end($todasCitas)["FECHA"]));

    if(sizeof($citasFiltradas) > 0){
        $fechas["ultimaCitaFiltrada"] = date("Y-m-d", strtotime($citasFiltradas[0]["FECHA"]));
        $fechas["primeraCitaFiltrada"] = date("Y-m-d", strtotime(end($citasFiltradas)["FECHA"]));
    } else {
        $fechas["ultimaCitaFiltrada"] = $fechas["ultimaCita"];
        $fechas["primeraCitaFiltrada"] = $fechas["primeraCita"];
    }
    return $fechas;
}