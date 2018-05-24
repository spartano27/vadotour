<?php 

include_once "core/db.php";
$conex= crearConexionBD();

if (!$conex) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}



include_once 'controlador/controladorLogin.php';



?>
<head>

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>




<div id="header">
	<img id="logo" src="images/logo.jpg">

	<?php

if (isset($_SESSION['logueado'])) {
	echo "<div id='MiCuenta'>";
	echo "<span class='wcme'>Bienvenido a VadoTour, ".$_SESSION['nombre']."</span>";

	?>

	<form action="" method="POST">
		<input type="submit" name="cerrar" value="Cerrar sesión">
	</form>
	</div>
<!-- menú horizontal -->
	<ul id="menu">
	  <li><a href="vistaHome.php" class="active">Inicio</a></li>
	  <li><a href="#">Elemento 2</a></li>
	  <li><a href="#">Elemento 3</a></li>
	  <li><a href="#">Elemento 4</a></li>
	</ul>
	<!-- fin menú -->
<?php
}
else{
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
			<input type="submit" name="entrar" value="Entrar">
		</p>

		</form>
<?php }?>

<hr>

</div>