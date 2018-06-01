<?php


function getVehiculosConcesionario($conex){

		$stmt = $conex->prepare( 'select * from VEHICULO_CONCESIONARIO');
		$stmt->execute();
		$veh_conces = $stmt->fetchAll();

		return $veh_conces;
}


function getVehConsFiltrado($conex,$precio,$marca,$modelo){
		$precio = (float) $precio;
		$stmt = $conex->prepare( 'select * from VEHICULO_CONCESIONARIO where PRECIO<=? AND MARCA=? AND MODELO=?');
		$filtrosarray[0]=$precio;
		$filtrosarray[1]=$marca;
		$filtrosarray[2]=$modelo;

		$stmt->execute($filtrosarray);

		$veh_conces = $stmt->fetchAll();	

		return $veh_conces;
}

function getMarcasVehiculosConcesionario($conex){

		$stmt = $conex->prepare( 'select DISTINCT MARCA from VEHICULO_CONCESIONARIO');
		$stmt->execute();
		$mveh_conces = $stmt->fetchAll();

		return $mveh_conces;
}

function getModelosVehiculosConcesionario($conex){

		$stmt = $conex->prepare( 'select DISTINCT MODELO from VEHICULO_CONCESIONARIO');
		$stmt->execute();
		$mveh_conces = $stmt->fetchAll();

		return $mveh_conces;
}

function getIDVehiculosCliente(PDO $con, int $ID_USUARIO){
    $stmt = $con->prepare("SELECT ID_VEHICULO FROM VEHICULO_CLIENTE WHERE ID_USUARIO = ?");
    $ID_USUARIOARRAY [0] = $ID_USUARIO;
    $stmt ->execute($ID_USUARIOARRAY);
    $id_veh_cliente = $stmt->fetchAll();
    return $id_veh_cliente;
}

function getMarcayModeloVehCliente(PDO $con, int $ID_VEH){
	$stmt = $con->prepare("SELECT MARCA,MODELO FROM VEHICULO WHERE ID_VEHICULO = ?");
    $ID_VEHARRAY [0] = $ID_VEH;
    $stmt ->execute($ID_VEHARRAY);
    $veh_cliente = $stmt->fetchAll();
    return $veh_cliente;
}

function getVehiculosCliente(PDO $con, array $id_veh_cliente){
	//retorna marca y modelo de todos los vehiculos de un cliente
    $cont = 0;
    $vehiculos=[];
    foreach ($id_veh_cliente as $id){
        $vehiculos[$cont] = getVehiculo($con, $id[0]);
        $cont++;
    }

    return $vehiculos;
}


function getVehiculo(PDO $con, int $id_veh_cliente){
	//retorna modelo y marca pasandole un id veh
    $stmt = $con->prepare("SELECT MODELO, MARCA,FECHA_ANYO,ID_VEHICULO FROM VEHICULO WHERE ID_VEHICULO = ?");
    $id_vehiculo_array[0] = $id_veh_cliente;
    $stmt ->execute($id_vehiculo_array);
    $vehiculos = $stmt->fetchAll();
    return $vehiculos;
}

function getMatricula(PDO $con, int $id_veh_cliente){
	 $stmt = $con->prepare("SELECT MATRICULA FROM VEHICULO_CLIENTE where ID_VEHICULO = ?");
    $id_vehiculo_array[0] = $id_veh_cliente;
    $stmt ->execute($id_vehiculo_array);
    $matricula = $stmt->fetchAll();
    return $matricula;
}