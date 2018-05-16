<?php

include_once "core/db.php";
include_once "modelo/modeloCita.php";

$con = crearConexionBD();

$filtros = ["ID_USUARIO" => 2];

// Se ha pulsado el boton de filtrar
if (isset($_POST["filtrar"])){

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

if(isset($_POST["mostrar-todas"])){
    unset($_POST["filtrar"]);
    unset($_POST["tipo-cita"]);
    unset($_POST["aceptada"]);
    unset($_POST["anulada"]);
}


function citasFiltradas(){
    global $con, $filtros;
    return getCitasFiltradasDB($con, $filtros);
}

?>