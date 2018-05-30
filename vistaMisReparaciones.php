<?php
include_once 'header.php';
include_once 'modelo/modeloReparacion.php';
include_once 'modelo/modeloVehiculo.php';

$id_veh_cliente = getIDVehiculosCliente($conex, 2);
$estados=0;



include_once 'controlador/controladorMisReparaciones.php';

?>



<form id = "misReparaciones" action = "#" method = "post">

	<script type = "text/javascript" src = "js/jquery.js"></script>
	<script type = "text/javascript">
	function mostrar(id){
	    if(id == "vehiculos"){
	        $("#vehiculo").show();
	        $("#estados").hide();
	    }
	    if(id == "estado"){
	        $("#estados").show();
	        $("#vehiculo").hide();
	    }
	}
	</script>


	<fieldset> 
	    <legend align = "left">
	        Filtro
	    </legend>

	    Filtrar por: Vehículos <input name = "filtro" id = "vehiculos" type = "radio" value = "vehiculos" onChange = "mostrar(this.value)"> 
	    Estado de reparación <input name = "filtro" id = "estado" type = "radio" value = "estado" onChange = "mostrar(this.value)"><br>
	    <div id = "vehiculo" style = "display:none;">
	    	Vehículo: <select name = "vehiculos">
	        			<?php 
	        				$id_veh_clie = getIDVehiculosCliente($conex, 2);

	        				foreach ($id_veh_clie as $idveh) {
	        					$marcModel=getVehiculo($conex,$idveh[0]);

	        					echo "<option value='$idveh[0]'>".$marcModel[0][1]." ".$marcModel[0][0]."</option>";
	        				}

	        			?>
	       			</select><br>
	        </div>
	    <div id = "estados" style = "display:none;">Estado: <select name = "estadoss">
	    <?php
	    foreach(getEstados($conex) as $estado){
	        echo "<option value = '$estado[0]'>$estado[1]</option>";
	    }
	    ?>
	    </select><br>
	    </div>

	<input type="submit" name="filtrar" value="Filtrar">
	</fieldset><br>


</form>

<table border='1'>
	<tr>

		<th>Vehículo</th>
		<th>Fecha de Inicio</th>
		<th>Finalización estimada</th>
		<th>Fecha de finalización</th>
		<th>Estado</th>
	</tr>
	<?php
//si $estado=0 no hay filtro por estados seleccionado por el usuario

		foreach(getReparacionesCliente($conex, $id_veh_cliente,$estados) as $reparacion){
			
		    foreach($reparacion as $rep){
				
				echo "<td>";
			    	$marcaYModelo=getMarcayModeloVehCliente($conex,$rep[3]);
					echo $marcaYModelo[0][0].$marcaYModelo[0][1];
				echo "</td>";

		        echo "<td>";
		        	echo $rep[4];
		        echo "</td>";

		        echo "<td>";
		        	echo $rep[5];
		        echo "</td>";

				echo "<td>";
		        	echo $rep[6];
		        echo "</td>";
			
				echo "<td>";

				$estado=getEstadoByID($conex,$rep[0]);
		        	echo $estado[0][0];
		        echo "</td>";
					
		    }
		   echo "</tr>";
		}
		echo "</table>";




