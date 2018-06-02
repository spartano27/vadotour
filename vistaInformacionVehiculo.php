<?php

//includes
include_once 'controlador/controladorInformacionVehiculo.php';
include_once "core/db.php";
include_once "modelo/modeloVehiculo.php";


$vehiculos = getVehiculosConcesionario($con);
$veh_conces = getVehConsFiltradoPorID($con,1);
//EN VISTA_EXPOSICION_VEHICULOS AÑADIR EN "VER VEHICULO" ----> href="vistaInformacionVehiculo.php?ID_VEHICULO=?"
$v1 = $_GET['ID_VEHICULO']






?>
 
 <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Informacion Del Vehiculo</title>
</head>
<body>
<?php include_once "header.php"?>
<main>
<article>
<div class='row'>
<section>
<h1 class='alinearCentro'><b>Informacion del Vehiculo</b> </h1>
</section>
<div>
<br/>
<?php

foreach ($veh_conces as $v1){
//foreach ($vehiculos as $vehiculo){ ?>
<p><b>Fecha de Subida:</b><?php echo $veh_conces['FECHA_SUBIDA'];   ?>   </p>
<p><b>Visible:</b><?php echo $veh_conces['VISIBLE'];   ?>   </p>
<p><b>Descripcion:</b><?php echo $veh_conces['DESCRIPCION'];   ?>   </p>
<p><b>Marca:</b><?php echo $veh_conces[3];   ?>   </p>
<p><b>Modelo:</b><?php echo $veh_conces['MODELO'];   ?>   </p>
<p><b>Kilometraje:</b><?php echo $veh_conces['KILOMETRAJE'];   ?>   </p>
<p><b>Precio:</b><?php echo $veh_conces['PRECIO'];   ?>   </p>
<p><b>Año del Vehiculo:</b><?php echo $veh_conces['ANYO_VEH'];   ?>   </p>
<?php

}
?>

</div>

</div>
</article>
<form>
<button type= "submit" value= "pedirCita" name = "pedirCita">
<em>Pedir Cita</em>
</button>
</form>
</main>
<?php include_once "footer.php"?>
</body>
</html>
