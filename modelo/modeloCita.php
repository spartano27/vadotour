<?php

$tipos = [];


function getTiposCitasDB(){

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

    $sql = "SELECT ID_CITA, ID_USUARIO, ID_TIPO_CITA, FECHA, DURACION, ACEPTADA, ANULADO, NOTA
            FROM cita";

    // Agrega las condiciones de WHERE en función de los filtros seleccionados.
    if($condiciones){
        $sql .= " WHERE ".implode(" AND ", $condiciones);
    }

    $stmt = $con->prepare($sql);
    $stmt->execute($filtrosOrdenados);
    $citas = $stmt->fetchAll();

    return $citas;
}
