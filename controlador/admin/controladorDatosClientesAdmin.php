<?php

include_once "core/db.php";
$conex= crearConexionBD();
include_once 'modelo/modeloCliente.php';
include_once 'modelo/modeloVehiculo.php';

$clientes = getClientes($conex);

if(isset($_REQUEST['add'])){
	$vehiculosCliente= getVehiculosCliente($conex,getIDVehiculosCliente($conex,$_REQUEST['idUsuario']));

}


if (isset($_REQUEST['addVeh'])){
	addVehCliente($conex, $_REQUEST['modelo'],$_REQUEST['marca'],$_REQUEST['idUsuario'],$_REQUEST['anyo'],$_REQUEST['matricula']);

}

if(isset($_REQUEST['modVeh'])){
	$modForm=1;


}
if (isset($_REQUEST['addVeh1'])) {
	updateVehCliente($conex,$_REQUEST['modelo'],$_REQUEST['marca'],$_REQUEST['idUsuario'],$_REQUEST['anyo'],$_REQUEST['matricula'],$_REQUEST['idVeh']);
}

if(isset($_REQUEST['elimVeh'])){
	deleteVehCliente($conex,$_REQUEST['idVeh']);
}