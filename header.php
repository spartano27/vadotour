<?php 

include_once "core/db.php";
$conex= crearConexionBD();

if (!$conex) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

include_once 'controlador/controladorLogin.php';

$esCliente = isset($_SESSION["logueado"]) ? true: false;
$esAdmin = isset($_SESSION["es_admin"]) && $_SESSION["es_admin"] == 1 ? true : false;


?>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>




<header>
	<img id="logo" src="images/logo.jpg">

	<?php

	if ($esCliente) {
		echo "<div id='MiCuenta'>";
		echo "<span class='wcme'>Bienvenido a VadoTour, ".$_SESSION['nombre']."</span>";

		?>

		<form action="" method="POST">
			<input type="submit" name="cerrar" value="Cerrar sesión">
		</form>
		</div>
        <?php } else { ?>
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
    <?php } ?>
	<!-- menú horizontal -->
		<ul id="menu">
            <li><a href="vistaHome.php" class="active">Inicio</a></li>
            <li><a href="vistaExposicionVehiculos.php">Vehículos del concesionario</a></li>
            <?php
                if($esCliente && !$esAdmin){
                    echo '<li class="menu-pedir-cita"><a href="vistaPedirCita.php">Pedir Cita</a></li>';
                    echo '<li><a href="vistaMisCitas.php">Mis citas</a></li>';
                    echo '<li><a href="vistaMisReparaciones.php">Mis reparaciones</a></li>';
                }

                if($esAdmin){
                    echo '<li class="menu-item-admin"><a href="vistaDatosClienteAdmin.php">Datos de clientes</a></li>';
                    echo '<li class="menu-item-admin"><a href="vistaCitasAdmin.php">Citas de clientes</a></li>';
                    echo '<li class="menu-item-admin"><a href="vistaReparacionesAdmin.php">Reparaciones de clientes</a></li>';
                }
            ?>


		</ul>
		<!-- fin menú -->
	<hr>

</header>