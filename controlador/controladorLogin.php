<?php
session_start();
	

	//si el usuario pulsa el botón de cerrar sesión la sesión se destruye
	if (isset($_REQUEST['cerrar'])) {
		session_destroy();
		header("Location:vistaHome.php");

		echo $_SESSION['logueado'];
		echo $_SESSION['nombre'];
		echo "???";
	}

	
	if (isset($_REQUEST['entrar'])) {
		$user=$_REQUEST['usuario']; $pass=$_REQUEST['clave'];

		$userarray[0]=$user;

		//consulto si hay algun usuario con el email recibido
		$stmt = $conex->prepare( 'select * from USUARIO where EMAIL=? ');
		$stmt->execute($userarray);
		$usuarioBD = $stmt->fetchAll();

	

		//Si usuarioBD está vacío no hay ningún usuario con ese email

		if(empty($usuarioBD)){
			echo "<span class='error'> No existe el usuario</span>";

		}
		//en el caso de que el usuario exista y la clave no coincida mostrará un error
		// $usuarioBD[0][4] es la contraseña almacenada en la BBDD
		elseif ($usuarioBD[0][4]!=$_REQUEST['clave']) {
			echo "<div class='error_usu'>La clave introducida no es correcta</div>";
			
		}
		else{
			$_SESSION['logueado']=1;
			$_SESSION['nombre']=$usuarioBD[0][1];


		
		}}

		?>