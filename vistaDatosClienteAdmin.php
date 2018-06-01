<?php

include_once 'header.php';
include_once 'core/utils.php';
$modForm="";
include_once 'controlador/admin/controladorDatosClientesAdmin.php';

if($_SESSION['es_admin']==1){

	

		if (!isset($_REQUEST['add']) && !isset($_REQUEST['modVeh'])) {
			
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
		//si se ha pulsado algún botón de ver o añadir vehiculo cliente:
		else if(isset($_REQUEST['add'])) {


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

						echo "<td>";
							?>
									<form action="#" method="POST">
										<input type="hidden" name="idVeh" value='<?php echo $vehiculo[0][3]?>'>
										<input type="hidden" name="marca" value="<?php echo $vehiculo[0][1]?>">
										<input type="hidden" name="modelo" value="<?php echo $vehiculo[0][0]?>">
										<input type="hidden" name="fecha" value="<?php echo $vehiculo[0][2]?>">
										<input type="hidden" name="idUsu" value="<?php echo $_REQUEST['idUsuario']?>">
										
										<input type="submit" name="modVeh" value="Modificar vehículo">
									</form>
									<?php
						echo "</td>";

						echo "<td>";
							?>
							<form action="#" method="POST">
								<input type="hidden" name="idVeh" value='<?php echo $vehiculo[0][3]?>'>

								<input type="submit" name="elimVeh" value="Eliminar vehículo">
							</form>
							<?php
						echo "</td>";

					echo "</tr>";
				}
			echo "</table>";
}

		if(isset($_REQUEST['modVeh'])){

			echo "<h1>Modificar vehículo ".$_REQUEST['marca']." ".$_REQUEST['modelo']."</h1>";
		

		 } 
		else if(isset($_REQUEST['add'])){	?>
			<h1>Añadir vehículo a <?php echo $_REQUEST['nombre']?></h1>
			<?php
		}

			if (isset($_REQUEST['modVeh'])||isset($_REQUEST['add'])) {
				
				if($modForm==1){
				$fecha = fromTimeToDate(strtotime($_REQUEST['fecha']));

				$matricula= getMatricula($conex,$_REQUEST['idVeh']);
}

		?>
		
				<form action="" method="POST">
					 <?php if($modForm==1){
					?><input type="hidden" name="idVeh" value='<?php echo $_REQUEST['idVeh']?>'>
							<?php } ?>
					<input type="hidden" name="idUsuario" value="<?php echo $_REQUEST['idUsuario']?>">
					 Marca: <input type="text" name="marca" value="<?php if($modForm==1){
								echo $_REQUEST['marca'];
							} ?>"><br>
					 Modelo: <input type="text" name="modelo" value="<?php if($modForm==1){
								echo $_REQUEST['modelo'];
							} ?>"><br>
					 Fecha de matriculación: <input type="date" name="anyo" value="<?php if($modForm==1){
								echo $fecha;
							} ?>"><br>
					 Matricula:  <input type="text" name="matricula" value="<?php if($modForm==1){ echo $matricula[0][0] ;}?>"><br>
				
					 <input type="submit" name="addVeh<?php echo $modForm;?>" value="<?php if($modForm==1){ echo 'Modificar';}else{ echo 'Añadir';} ?> vehículo">
				</form>
				<a href="vistaDatosClienteAdmin.php"> Volver</a>

			<?php

			}

		

}
else{
	echo "No tienes permiso para acceder a esta página";
	
}
