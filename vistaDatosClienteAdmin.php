<?php

include_once 'header.php';
include_once 'controlador/admin/controladorDatosClientesAdmin.php';

if($_SESSION['es_admin']==1){

		if (!isset($_REQUEST['add'])) {
			
			?>

			<h1>Clientes:</h1>

				
					
					<table border='1'>
					<tr>
						
						<th>Nombre</th>
						<th>Email</th>
						<th>Localidad</th>
						<th>Provincia</th>
						<th>Teléfono</th>
					</tr>


					<?php

							
						    foreach($clientes as $cliente){
							echo "<tr>";
								
						        echo "<td>";
						        	echo $cliente[1]." ".$cliente[2];
						        echo "</td>";

						        echo "<td>";
						        	echo $cliente[3];
						        echo "</td>";

								echo "<td>";
						        	echo $cliente[7];
						        echo "</td>";
							
								echo "<td>";
									echo $cliente[8];
									"</td>";
									
								echo "<td>";
									echo $cliente[10];
									"</td>";
								echo "<td>";
									
									?>
									<form action="#" method="POST">
										<input type="hidden" name="idUsuario" value='<?php echo $cliente[0]?>'>
										<input type="hidden" name="nombre" value='<?php echo $cliente[1]." ".$cliente[2]?>'>
										<input type="submit" name="add" value="Ver o añadir vehículos a cliente">
									</form>
									<?php


									"</td>";
						   echo "</tr>";
						    }
						
						echo "</table>";


		}
		//si se ha pulsado algún botón de modificar cliente:
		else{


			echo "<h1>Vehículos de ". $_REQUEST['nombre']."</h1>";
			echo "<table border=1>";
					echo "<tr>";
					echo "<th>";
						echo "Marca";
					echo "</th>";

					echo "<th>";
						echo "Modelo";
					echo "</th>";

					echo "<th>";
						echo "Fecha de matriculación";
					echo "</th>";

					echo "</tr>";

				foreach ($vehiculosCliente as $vehiculo) {
					echo "<tr>";
						echo "<td>";
							echo $vehiculo[0][1];	
						echo "</td>";

						echo "<td>";
							echo $vehiculo[0][0];	
						echo "</td>";

						echo "<td>";
							echo $vehiculo[0][2];	
						echo "</td>";


					echo "</tr>";
				}
			echo "</table>";

			?>
			<h1>Añadir vehículo a <?php echo $_REQUEST['nombre']?></h1>
				<form action="" method="POST">
					 
					<input type="hidden" name="idUsuario" value="<?php echo $_REQUEST['idUsuario']?>">
					 Marca: <input type="text" name="marca" value=""><br>
					 Modelo: <input type="text" name="modelo" value=""><br>
					 Fecha de matriculación: <input type="date" name="anyo" value=""><br>
					 Matricula:  <input type="text" name="matricula" value=""><br>

					 <input type="submit" name="addVeh" value="Añadir vehículo">
				</form>
				<a href="vistaDatosClienteAdmin.php"> Volver</a>

			<?php

		}

}
else{
	echo "No tienes permiso para acceder a esta página";
}
