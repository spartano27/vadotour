<?php

function crearConexionBD() {

    $host = 'oci:dbname=oracle.cswz5hnb0cgs.eu-west-2.rds.amazonaws.com/ORCL';
    $usuario = "rdsmaster";
    $password = "a1e72dc9d9";

    $conexion = new PDO($host, $usuario, $password, array(PDO::ATTR_PERSISTENT => true));
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexion;

    try {
        $conexion = new PDO($host, $usuario, $password, array(PDO::ATTR_PERSISTENT => true));
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch(PDOException $e) {
        $_SESSION['excepcion'] = $e -> GetMessage();
        header("Location: excepcion.php");
    }
}

function cerrarConexionBD($conexion) {
    $conexion = null;
}