<?php


if(isset($_REQUEST['filtrar'])){
	if ($_REQUEST['filtro']=='vehiculos') {
		
	
	$id_veh_cliente = [];
	$id_veh_cliente[0][0] = $_REQUEST['vehiculos'];
	}
	else{
	
	$estados=$_REQUEST['estadoss'];
	
	}

	?>

	<a href="vistaMisReparaciones.php">Eliminar filtros</a>

	<?php
}

?>