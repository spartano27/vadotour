<?php

include_once 'modelo/modeloVehiculo.php';
include_once "core/db.php";
$con= crearConexionBD();

function getVehConsFiltradoPorID($con,$ID_VEHICULO){
		$stmt = $con->prepare( 'select * from VEHICULO_CONCESIONARIO where $ID_VEHICULO');
		$filtrosarray[0]=$ID_VEHICULO;

		$stmt->execute($filtrosarray);

		$veh_conces = $stmt->fetchAll();	

	return $veh_conces;}

//se pulsa el boton Pedir cita
if(isset($_REQUEST["pedirCita"])){
    
    header("Location: vistaPedirCita.php");
    
    
}
