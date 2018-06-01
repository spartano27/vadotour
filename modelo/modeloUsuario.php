<?php


function getUsuarioPorId(PDO $con, int $id_Usuario){
    $stmt = $con->prepare("SELECT NOMBRE, APELLIDOS, EMAIL, CONTRASENA FROM USUARIO WHERE ID_USUARIO = ?");
    $stmt->execute([$id_Usuario]);
    $usuario = $stmt->fetchAll();
    return $usuario[0];
}

function getUsuarioBD($conex,$email){
		$stmt = $conex->prepare( 'select * from USUARIO where EMAIL=? ');
		$userarray[0]=$email;
		$stmt->execute($userarray);
		$usuarioBD = $stmt->fetchAll();

		return $usuarioBD;
}