<?php

function getCliente(PDO $con, int $id_Usuario){
    $stmt = $con->prepare("SELECT * FROM CLIENTE WHERE ID_USUARIO = ?");
    $stmt->execute([$id_Usuario]);
    $cliente = $stmt->fetchAll();
    return $cliente[0];
}

function getClientes(PDO $conex){
	$stmt = $conex->prepare("SELECT * FROM USUARIO NATURAL JOIN CLIENTE  ");
    $stmt ->execute();
    $clientes = $stmt->fetchAll();
    return $clientes;
}

function registroCliente(PDO $con, array $datosUsuario, array $datosCliente){
    $stmt = $con->prepare("INSERT INTO USUARIO(NOMBRE, APELLIDOS, EMAIL, CONTRASENA) 
                                    VALUES (?, ?, ?, ?)");
    $stmt->execute($datosUsuario);
    $stmt2 = $con->prepare("SELECT ID_USUARIO FROM USUARIO WHERE EMAIL = ?");
    $stmt2->execute([$datosUsuario[2]]);
    $id = $stmt2->fetchAll()[0]["ID_USUARIO"];
    $stmt3 = $con->prepare("INSERT INTO CLIENTE (DNI, LOCALIDAD, PROVINCIA, DIRECCION, CP, TELEFONO, ID_USUARIO) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $datosCliente[] = $id;
    $stmt3 ->execute($datosCliente);
}

function updateCliente(PDO $con, array $datosUsuario, array $datosCliente){
    $stmt = $con->prepare("UPDATE USUARIO
                                    SET NOMBRE = ?, APELLIDOS = ?, CONTRASENA = ?
                                    WHERE ID_USUARIO = ?");
    $stmt->execute($datosUsuario);
    $stmt2 = $con->prepare("UPDATE CLIENTE
                                    SET DNI = ?, LOCALIDAD = ?, PROVINCIA = ?, CP = ?, DIRECCION = ?, TELEFONO = ?
                                    WHERE ID_USUARIO = ?");
    $stmt2->execute($datosCliente);
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