<?php

function getTiposCitasDB(PDO $con){
    $stmt = $con->prepare("SELECT ID_TIPO_CITA, TIPO_CITA FROM TIPO_CITA");
    $stmt->execute();
    $tipos = [];
    foreach($stmt->fetchAll() as $tipo){
        $tipos[$tipo["ID_TIPO_CITA"]] = $tipo["TIPO_CITA"];
    }
    return $tipos;
}

function getCitasFiltradasDB(PDO $con, array $filtros){
    global $dateFormat;

    $condiciones = [];
    $filtrosOrdenados = [];

    if(isset($filtros['ID_USUARIO'])){
        $condiciones[] = 'C.ID_USUARIO = ?';
        $filtrosOrdenados[] = $filtros['ID_USUARIO'];
    }
    if(isset($filtros['ID_TIPO_CITA'])){
        $condiciones[] = 'C.ID_TIPO_CITA = ?';
        $filtrosOrdenados[] = $filtros['ID_TIPO_CITA'];
    }
    if(!empty($filtros['FECHA'])){
        $condiciones[] = "C.FECHA = TO_DATE(?, 'dd-mm-yyyy')";
        $filtrosOrdenados[] = $filtros['FECHA'];
    }
    if(isset($filtros['ACEPTADA'])){
        $condiciones[] = 'C.ACEPTADA = ?';
        $filtrosOrdenados[] = $filtros['ACEPTADA'];
    }
    if(isset($filtros['ANULADO'])){
        $condiciones[] = 'C.ANULADO = ?';
        $filtrosOrdenados[] = $filtros['ANULADO'];
    }
    if(isset($filtros['FECHA_INICIO'])){
        $condiciones[] = "C.FECHA >= TO_DATE(?, 'yyyy-mm-dd')";
        $filtrosOrdenados[] = $filtros['FECHA_INICIO'];
    }

    if(isset($filtros['FECHA_FIN'])){
        $condiciones[] = "C.FECHA <= TO_DATE(?, 'yyyy-mm-dd')";
        $filtrosOrdenados[] = $filtros['FECHA_FIN'];
    }

    $sql = "SELECT C.ID_CITA, C.ID_USUARIO, TO_CHAR(C.FECHA, 'DD-MM-YYYY HH24:MI:SS') AS FECHA, C.DURACION, C.ACEPTADA, C.ANULADO, C.NOTA,
                   TC.ID_TIPO_CITA, TC.TIPO_CITA,
                   U.NOMBRE
            FROM CITA C
            JOIN USUARIO U on C.ID_USUARIO = U.ID_USUARIO
            JOIN TIPO_CITA TC on C.ID_TIPO_CITA = TC.ID_TIPO_CITA";

    // Agrega las condiciones de WHERE en función de los filtros seleccionados.
    if($condiciones){
        $sql .= " WHERE ".implode(" AND ", $condiciones);
    }

    $sql .= " ORDER BY C.FECHA DESC";

    $stmt = $con->prepare($sql);
    $stmt->execute($filtrosOrdenados);
    $citas = $stmt->fetchAll();

    return $citas;
}

/*
 * Huecos ocupados por citas, el return es con el formato:
 * $huecos[dia][hora][minuto] = 1 si esta ocupado
 * Si no esta ocupado, esas tres claves no existen (puede que alguna si, pero las tres no)
 *
 * Se ha hecho asi para no añadir complejidad a la hora de comprobar si una hora esta ocupada o no
 *
 * formato fecha: yyyy-mm-dd
*/

function getHuecosOcupadosEntre(PDO $con,string $fechaInicio, string $fechaFin){

    $citas = getCitasFiltradasDB($con, ['FECHA_INICIO' => $fechaInicio, 'FECHA_FIN' => $fechaFin]);
    $huecosOcupados = [];

    foreach($citas as $cita){
        $fechaFormateada = date("d-H-i", strtotime($cita["FECHA"]));
        $fechaSeparada = explode("-",$fechaFormateada);

        $dia = $fechaSeparada[0];
        $horas = $fechaSeparada[1];
        $minutos = $fechaSeparada[2];

        if(empty($huecosOcupados[$dia])){
            $huecosOcupados[$dia] = [];
        }

        if(empty( $huecosOcupados[$dia] [$horas] )){
            $huecosOcupados[$dia] [$horas] = [];
        }

        if(empty($huecosOcupados[$dia] [$horas] [$minutos] )){
            $huecosOcupados[$dia] [$horas] [$minutos] = [];
        }

        $huecosOcupados[$dia][$horas][$minutos] = 1;
    }
    return $huecosOcupados;
}

function createCita(PDO $con, int $idUser, int $fecha, int $tipoCita, string $nota){

    $parametros = [$idUser, date("Y-m-d H:i:s"  , $fecha), $tipoCita, $nota];
    $stmt = $con->prepare("INSERT INTO CITA(ID_USUARIO, FECHA, ID_TIPO_CITA, NOTA) 
                                    VALUES (?, TO_DATE(?, 'yyyy-mm-dd HH24:MI:SS'), ?, ?)");
    $stmt->execute($parametros);

}

function getReparacionDeCita(PDO $con, int $idCita){



    $stmt = $con->prepare("SELECT  R.ID_REP, R.ID_EST_REP, R.FECHA_COMIENZO, R.FECHA_ESTIMADA_FINALIZACION, R.FECHA_FINALIZACION, R.VALORACION,
                                            E.ESTADO,
                                            C.NOTA, C.ANULADO, C.ACEPTADA, C.DURACION, C.FECHA, C.ID_CITA, C.ID_USUARIO,
                                            TC.ID_TIPO_CITA, TC.TIPO_CITA,
                                            VC.ID_USUARIO, VC.MATRICULA,
                                            V.FECHA_ANYO, V.MODELO
                                    FROM CITA C
                                    JOIN REPARACION R on C.ID_CITA = R.ID_CITA
                                    JOIN VEHICULO_CLIENTE VC on R.ID_VEHICULO = VC.ID_VEHICULO
                                    JOIN VEHICULO V on VC.ID_VEHICULO = V.ID_VEHICULO
                                    JOIN ESTADO_REPARACION E on R.ID_EST_REP = E.ID_EST_REP
                                    JOIN TIPO_CITA TC on C.ID_TIPO_CITA = TC.ID_TIPO_CITA
                                    WHERE C.ID_CITA= ?
                                    ORDER BY C.FECHA DESC");
    $stmt->execute([$idCita]);
    $reparacion = $stmt->fetchAll()[0];
    return $reparacion;
}

function updateCitaAceptar(PDO $con, int $idCita){
    $stmt = $con->prepare("UPDATE CITA
                                    SET ACEPTADA = 1
                                    WHERE ID_CITA = ?");
    $stmt->execute([$idCita]);
}

function updateCitaAnular(PDO $con, int $idCita){
    $stmt = $con->prepare("UPDATE CITA
                                    SET ANULADO = 1
                                    WHERE ID_CITA = ?");
    $stmt->execute([$idCita]);
}

function deleteCita(PDO $con, int $idCita){
    $stmt = $con->prepare("DELETE FROM CITA
                                    WHERE ID_CITA = ?");
    $stmt->execute([$idCita]);
}