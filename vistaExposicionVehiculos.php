<?php

include_once "header.php";
include_once "modelo/modeloVehiculo.php";


$vehiculos= getVehiculosConcesionario($conex);

include_once "controlador/controladorExposicionVehiculos.php";



?>

<h3>Filtrar:</h3>
<form method="POST" action="#" id="filtroCons">

	<span>Precio máximo:</span>
	<input name="precioMax" type="range" min="500" max="99999999999" step="100" value="500" class="slider" id="myRange">
	<span id="temp">500</span>€

	<script>
	  addEventListener('load',inicio,false);

	  function inicio()
	  {
	    document.getElementById('myRange').addEventListener('change',cambioPrecio,false);
	  }

	  function cambioPrecio()
	  {    
	    document.getElementById('temp').innerHTML=document.getElementById('myRange').value;
	  }
	</script> <br>

	<span>Marca:</span>

	<select name="marca">
		
		<?php 
			$marcas = getMarcasVehiculosConcesionario($conex);

			foreach ($marcas as $vehiculo) {
				echo "<option value='$vehiculo[0]'>$vehiculo[0]</option>";
			}

		?>
	</select><br>

	<span>Modelo:</span>

	<select name="modelo">
		
		<?php 

			$modelos = getModelosVehiculosConcesionario($conex);

			foreach ($modelos as $vehiculo) {
				echo "<option value='$vehiculo[0]'>$vehiculo[0]</option>";
			}

		?>
	</select>

	<input type="submit" name="filtrar" value="Filtrar ">

</form>

<h1>Vehículos del concesionario</h1>

<?php



if (count($vehiculos)==0) {
	echo "<span>No hay ningún vehículo con ese filtro</span>";
}
foreach ($vehiculos as $vehiculo){?>
 <div class="cajon" >
         <div class="caption">                
            <img src="<?php echo $vehiculo[9]?>" alt="...">
            <div>

                    
                <h3><?php echo $vehiculo[3]." "; echo  $vehiculo[4]?></h3>
                <p><?php echo $vehiculo[7] ?></p>
                <p>Precio: <?php echo $vehiculo[6] ?>€</p>

                <p><a href="#" >Ver vehículo</a><br><a href="#" >Comprar vehículo</a></p>

            </div>
        </div>	
    </div> 

<?php
}

