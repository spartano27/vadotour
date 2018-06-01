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

function updateVehCliente(PDO $conex, $modelo,$marca,$id_usu,$anyo,$matricula,$idVeh){
	$stmt = $conex->prepare("UPDATE VEHICULO SET MODELO=?,FECHA_ANYO = TO_DATE(?,'yyyy/mm/dd'),MARCA=? WHERE ID_VEHICULO = ?");
	$arrayDatos[0]=$modelo;
	$arrayDatos[1]=$anyo;
	$arrayDatos[2]=$marca;
	$arrayDatos[3]=$idVeh;
    $stmt ->execute($arrayDatos);

  
	
	$stmt = $conex->prepare("UPDATE VEHICULO_CLIENTE SET MATRICULA=? WHERE ID_VEHICULO = ?  ");
	
	$arrayDV[0]=$matricula;
	$arrayDV[1]=$idVeh;

	

	 $stmt ->execute($arrayDV);

}

function deleteVehCliente(PDO $conex, $idVeh){
	$stmt = $conex->prepare("DELETE FROM VEHICULO_CLIENTE where ID_VEHICULO = ? ");
	$arrayDV[0]=$idVeh;
	 $stmt ->execute($arrayDV);

	 	$stmt = $conex->prepare("DELETE FROM VEHICULO where ID_VEHICULO = ? ");
	$arrayDV[0]=$idVeh;
	 $stmt ->execute($arrayDV);

}