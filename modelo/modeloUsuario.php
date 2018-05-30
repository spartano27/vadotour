<?php


function getUsuarioBD($conex,$email){
		$stmt = $conex->prepare( 'select * from USUARIO where EMAIL=? ');
		$userarray[0]=$email;
		$stmt->execute($userarray);
		$usuarioBD = $stmt->fetchAll();

		return $usuarioBD;
}