<?php
include_once "core/db.php";
$conex= crearConexionBD();
include_once 'controlador/controladorLogin.php';

if (!isset($_SESSION['logueado'])) {

?>
		<form action="" method="POST" class="form-1">

			<h3>Inicia sesión en Vadotour</h3>


			
			<p class="field">
				<input type="text" name="usuario" value="">
				
			</p>
			<p class="field">
		 		<input type="password" name="clave" value="">
			</p>
			<p class="submit">
				<input type="submit" name="entrarAdmin" value="Entrar">
			</p>

			</form>


<?php }else{
	if (isset($_REQUEST['entrar'])) {
		header("Location:vistaHome.php");
	}
		

	}
?>