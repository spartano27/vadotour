<?php

function getClientes(PDO $conex){
	$stmt = $conex->prepare("SELECT * FROM USUARIO NATURAL JOIN CLIENTE  ");
    $stmt ->execute();
    $clientes = $stmt->fetchAll();
    return $clientes;
}


function addVehCliente(PDO $conex, $modelo,$marca,$id_usu,$anyo,$matricula){
	$stmt = $conex->prepare("INSERT INTO VEHICULO (MODELO,FECHA_ANYO,MARCA) VALUES (?,TO_DATE(?,'yyyy/mm/dd'),?)  ");
	$arrayDatos[0]=$modelo;
	$arrayDatos[1]=$anyo;
	$arrayDatos[2]=$marca;
    $stmt ->execute($arrayDatos);

  	$stmt = $conex->prepare("SELECT MAX(ID_VEHICULO) FROM VEHICULO");
    $stmt ->execute();
    $idVeh =$stmt->fetchAll();

	
	$stmt = $conex->prepare("INSERT INTO VEHICULO_CLIENTE (ID_VEHICULO,ID_USUARIO,MATRICULA) VALUES (?,?,?)  ");
	$arrayDV[0]=$idVeh[0][0];
	$arrayDV[1]=$id_usu;
	$arrayDV[2]=$matricula;

	

	 $stmt ->execute($arrayDV);

}