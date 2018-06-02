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

function createReparacion(PDO $con, int $idCita){
    $stmt = $con->prepare("INSERT INTO REPARACION(ID_CITA, ID_EST_REP)
                                    VALUES (?,?)");
    $stmt->execute([$idCita, 1]);
}

function getTodasReparaciones(PDO $con){
    $stmt = $con->prepare("SELECT R.ID_REP, R.ID_CITA, R.ID_EST_REP, R.ID_VEHICULO, R.VALORACION, R.FECHA_FINALIZACION, R.FECHA_ESTIMADA_FINALIZACION, R.FECHA_COMIENZO,
                                    E.ESTADO, V.MODELO, VC.MATRICULA, C.NOTA, U.ID_USUARIO, U.NOMBRE
                                    FROM REPARACION R
                                    JOIN ESTADO_REPARACION E on R.ID_EST_REP = E.ID_EST_REP
                                    JOIN CITA C on R.ID_CITA = C.ID_CITA
                                    JOIN USUARIO U on U.ID_USUARIO = C.ID_USUARIO
                                    LEFT JOIN VEHICULO_CLIENTE VC on R.ID_VEHICULO = VC.ID_VEHICULO
                                    LEFT JOIN VEHICULO V on R.ID_VEHICULO = V.ID_VEHICULO
                                    ORDER BY ID_REP DESC");
    $stmt->execute();
    $reparaciones = $stmt->fetchAll();
    return $reparaciones;
}

function updateReparacionAddVehiculo(PDO $con, int $idReparacion, int $idVehiculo){
    $stmt = $con->prepare("UPDATE REPARACION
                                    SET ID_VEHICULO = ?
                                    WHERE ID_REP = ?");
    $stmt->execute([$idVehiculo, $idReparacion]);
}

function updateReparacionAddFechaEstimada(PDO $con, int $idReparacion, string $fechaEstimada){
    $fechaActual = fromTimeToDate(time());
    $stmt = $con->prepare("UPDATE REPARACION
                                    SET FECHA_COMIENZO = TO_DATE(?, 'yyyy-mm-dd HH24:MI:SS'),
                                     FECHA_ESTIMADA_FINALIZACION = TO_DATE(?, 'yyyy-mm-dd HH24:MI:SS')
                                    WHERE ID_REP = ?");
    $stmt->execute([$fechaActual, $fechaEstimada, $idReparacion]);
}

function updateReparacionEstado(PDO $con, int $idReparacion, int $siguienteEstado){
    $stmt = $con->prepare("UPDATE REPARACION
                                    SET ID_EST_REP = ?
                                    WHERE ID_REP = ?");
    $stmt->execute([$siguienteEstado, $idReparacion]);
}

function updateReparacionFechaFinalizacion(PDO $con, int $idRep, string $fechaFinalizacion){
    $stmt = $con->prepare("UPDATE REPARACION
                                    SET FECHA_FINALIZACION = TO_DATE(?, 'yyyy-mm-dd HH24:MI:SS')
                                    WHERE ID_REP = ?");
    $stmt->execute([$fechaFinalizacion, $idRep]);
}

function deleteReparacion(PDO $con, int $idReparacion){
    $stmt = $con->prepare("DELETE FROM REPARACION
                                    WHERE ID_REP = ?");
    $stmt->execute([$idReparacion]);
}