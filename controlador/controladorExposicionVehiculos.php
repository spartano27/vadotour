<?php

include_once 'modelo/modeloVehiculo.php';
include_once "core/db.php";
$conex= crearConexionBD();

if (isset($_REQUEST['filtrar'])) {


	$vehiculos= getVehConsFiltrado($conex,$_REQUEST['precioMax'],$_REQUEST['marca'],$_REQUEST['modelo']);
}