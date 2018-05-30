<?php

function getComentariosDeCita(PDO $con, int $idCita){
    $stmt = $con->prepare("SELECT C.COMENTARIO, C.FECHA, C.TITULO, 
                                           U.NOMBRE, U.APELLIDOS, U.EMAIL, U.ES_ADMIN
                                    FROM COMENTARIO C
                                    LEFT JOIN USUARIO U ON U.ID_USUARIO = C.ID_USUARIO
                                    WHERE C.ID_CITA = ?
                                    ORDER BY C.FECHA DESC");
    $stmt->execute([$idCita]);
    $comentarios = $stmt->fetchAll();

    return $comentarios;
}

function crearComentario(PDO $con, int $idUsuario, int $idCita, string $cuerpoComentario, string $fecha){

    $parametros = [$idUsuario, $idCita, $cuerpoComentario, $fecha];

    $stmt = $con->prepare("INSERT INTO COMENTARIO (ID_CITA, ID_USUARIO, TITULO, COMENTARIO, FECHA) 
                                                VALUES (?,?,'',?,TO_DATE(?, 'yyyy-mm-dd HH24:MI:SS'))");
    $stmt->execute($parametros);

}
