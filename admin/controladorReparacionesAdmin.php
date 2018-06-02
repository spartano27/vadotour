<?php

include_once "modelo/modeloReparacion.php";

if( isset($_POST["siguiente-estado-2"]) ){
    $idRep = $_POST["id-reparacion"];
    $idVeh = $_POST["id-vehiculo-cliente"];
    updateReparacionAddVehiculo($conex, $idRep, $idVeh);
    updateReparacionEstado($conex, $idRep, 2);
}

if( isset($_POST["siguiente-estado-5"]) ){
    $idRep = $_POST["id-reparacion"];
    if(isset($_POST["fecha-estimada"])){
        $fechaEstimada = fromTimeToDate(strtotime($_POST["fecha-estimada"]));
        updateReparacionAddFechaEstimada($conex, $idRep, $fechaEstimada);
    }
    updateReparacionEstado($conex, $idRep, 5);
}

if( isset($_POST["siguiente-estado-6"]) ) {
    $idRep = $_POST["id-reparacion"];
    $fechaFinalizacion = fromTimeToDate(time());
    updateReparacionFechaFinalizacion($conex, $idRep, $fechaFinalizacion);
    updateReparacionEstado($conex, $idRep, 6);
}

if( isset($_POST["siguiente-estado-7"]) ) {
    $idRep = $_POST["id-reparacion"];
    updateReparacionEstado($conex, $idRep, 7);
}

if( isset($_POST["siguiente-estado-8"]) ) {
    $idRep = $_POST["id-reparacion"];
    updateReparacionEstado($conex, $idRep, 8);
}

if( isset($_POST["siguiente-estado-9"]) ) {
    $idRep = $_POST["id-reparacion"];
    $fechaFinalizacion = fromTimeToDate(time());
    updateReparacionFechaFinalizacion($conex, $idRep, $fechaFinalizacion);
    updateReparacionEstado($conex, $idRep, 9);
}

if( isset($_POST["borrar-reparacion"]) ){
    $idRep = $_POST["id-reparacion"];
    deleteReparacion($conex, $idRep);
}

function getReparaciones(){
    global $conex;
    return getTodasReparaciones($conex);
}

function getVehiculos(int $idUsuario){
    global $conex;
    return getTodosVehiculosCliente($conex, $idUsuario);
}