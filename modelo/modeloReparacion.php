<?php

include_once 'modeloVehiculo.php';

function getReparacionesCliente(PDO $con, array $id_veh_cliente,int $estado){
	//devuelve todas las reparaciones de todos los vehiculos
	//devuelve un array de arrays donde $reparaciones[idveh][filareparacion][columnareparacion]


	if($estado==0){		
	    $cont = 0;
	    $reparaciones=[];
	    foreach ($id_veh_cliente as $id){
	        $reparaciones[$cont] = getReparacion($con, $id[0]);
	        $cont++;
	    }
	}else{
		$cont = 0;
	    $reparaciones=[];
	    foreach ($id_veh_cliente as $id){
	        $reparaciones[$cont] = getReparacion($con, $id[0],$estado);
	        $cont++;
	}
}
    return $reparaciones;

}



function getReparacion(PDO $con, int $id_veh_cliente,int $estado=0){
	//devuelve todas las reparaciones de un vehiculo en concreto
	//retorna un array $reparaciones[fila][columna]


	if($estado==0){
 		   $stmt = $con->prepare("SELECT * FROM REPARACION WHERE ID_VEHICULO = ?");
		}
	else{
 		   $stmt = $con->prepare("SELECT * FROM REPARACION WHERE ID_VEHICULO = ? AND ID_EST_REP=?");

		}
    $id_vehiculo_array[0] = $id_veh_cliente;

    if ($estado!=0) {
    $id_vehiculo_array[1] = $estado;
    	
    }

    $stmt ->execute($id_vehiculo_array);
    $reparaciones = $stmt->fetchAll();
    return $reparaciones;
}




function getEstados(PDO $con){
    $stmt = $con->prepare("SELECT ID_EST_REP, ESTADO FROM ESTADO_REPARACION");
    $stmt ->execute();
    $estados = $stmt->fetchAll();
    return $estados;
}

function getEstadoByID(PDO $con, int $id_REP){
	

	 $stmt = $con->prepare("SELECT ID_EST_REP FROM REPARACION where ID_REP = ?");
	 $IDREPArray[0]=$id_REP;
    $stmt ->execute($IDREPArray);
    $IDestado = $stmt->fetchAll();
    



	 $stmt = $con->prepare("SELECT ESTADO FROM ESTADO_REPARACION where ID_EST_REP = ?");
	 $estArray[0]=$IDestado[0][0];
    $stmt ->execute($estArray);
    $estados = $stmt->fetchAll();
    return $estados;
}
