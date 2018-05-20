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

    $condiciones = [];
    $filtrosOrdenados = [];

    if(isset($filtros['ID_USUARIO'])){
        $condiciones[] = 'ID_USUARIO = ?';
        $filtrosOrdenados[] = $filtros['ID_USUARIO'];
    }
    if(isset($filtros['ID_TIPO_CITA'])){
        $condiciones[] = 'ID_TIPO_CITA = ?';
        $filtrosOrdenados[] = $filtros['ID_TIPO_CITA'];
    }
    if(!empty($filtros['FECHA'])){
        $condiciones[] = "FECHA = TO_DATE(?, 'dd-mm-yyyy')";
        $filtrosOrdenados[] = $filtros['FECHA'];
    }
    if(isset($filtros['ACEPTADA'])){
        $condiciones[] = 'ACEPTADA = ?';
        $filtrosOrdenados[] = $filtros['ACEPTADA'];
    }
    if(isset($filtros['ANULADO'])){
        $condiciones[] = 'ANULADO = ?';
        $filtrosOrdenados[] = $filtros['ANULADO'];
    }
    if(isset($filtros['FECHA_INICIO'])){
        $condiciones[] = "FECHA >= TO_DATE(?, 'yyyy-mm-dd')";
        $filtrosOrdenados[] = $filtros['FECHA_INICIO'];
    }

    if(isset($filtros['FECHA_FIN'])){
        $condiciones[] = "FECHA <= TO_DATE(?, 'yyyy-mm-dd')";
        $filtrosOrdenados[] = $filtros['FECHA_FIN'];
    }

    $sql = "SELECT ID_CITA, ID_USUARIO, ID_TIPO_CITA, FECHA, DURACION, ACEPTADA, ANULADO, NOTA
            FROM cita";

    // Agrega las condiciones de WHERE en función de los filtros seleccionados.
    if($condiciones){
        $sql .= " WHERE ".implode(" AND ", $condiciones);
    }

    $sql .= " ORDER BY FECHA DESC";

    $stmt = $con->prepare($sql);
    $stmt->execute($filtrosOrdenados);
    $citas = $stmt->fetchAll();

    return $citas;
}
