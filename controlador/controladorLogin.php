<?php
include_once 'modelo/modeloUsuario.php';

session_start();

	//si el usuario pulsa el botón de cerrar sesión la sesión se destruye
	if (isset($_REQUEST['cerrar'])) {
		session_destroy();
		header("Location:vistaHome.php");

		
	}

	
	if (isset($_REQUEST['entrar']) || isset($_REQUEST['entrarAdmin'])) {
		$user=$_REQUEST['usuario']; $pass=$_REQUEST['clave'];

	

		//consulto si hay algun usuario con el email recibido

		$usuarioBD=getUsuarioBD($conex,$user);
		$claveEncript=md5($_REQUEST['clave']);

		
		//Si usuarioBD está vacío no hay ningún usuario con ese email

		if(empty($usuarioBD)){
			echo "<span class='error'> No existe el usuario</span>";

		}
		else if (!isset($_REQUEST['entrarAdmin'])&&$usuarioBD[0][5]==1) {
			echo "<span class='error'> El usuario administrador no puede iniciar sesión desde esta página</span>";
			
		}
		//en el caso de que el usuario exista y la clave no coincida mostrará un error
		// $usuarioBD[0][4] es la contraseña almacenada en la BBDD

		elseif ($usuarioBD[0][4]!=$claveEncript) {
			echo "<div class='error_usu'>La clave introducida no es correcta</div>";
			
		}
		else{
			$_SESSION['logueado']=1;
			$_SESSION['nombre']=$usuarioBD[0][1];
			$_SESSION['id_usuario']=$usuarioBD[0][0];
			$_SESSION['es_admin']=$usuarioBD[0][5];

		header("Location:vistaHome.php");
		
		}}

		?>