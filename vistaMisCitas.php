<?php
include_once "header.php";
include_once "controlador/controladorMisCitas.php";

// Se obtienen todas las citas para obtener la fecha de la primera y ultima cita y ayudar en el filtrado del calendario
$todasCitas = todasCitas();
$citasFiltradas = citasFiltradas();

$fechas = fechas($todasCitas, $citasFiltradas);


?>

<div class="main-container column">
    <section class="row">
        <form id="filtro-citas" action="vistaMisCitas.php" method="post">
            <fieldset style="width: 90vw">
                <legend align="left">Filtro</legend>
            <div>
                <label for="fecha-inicio">Desde </label>
                <input name="fecha-inicio" title="Citas desde la fecha" type="date"
                       value="<?php echo !empty($_POST["fecha-inicio"])? $_POST["fecha-inicio"] : $fechas["primeraCitaFiltrada"] ?>"
                       min="<?php echo $fechas["primeraCita"] ?>" max="<?php echo $fechas["ultimaCita"] ?>">
                <label for="fecha-fin"> hasta </label>
                <input name="fecha-fin" title="Citas hasta la fecha" type="date"
                       value="<?php echo !empty($_POST["fecha-fin"])? $_POST["fecha-fin"] : $fechas["ultimaCitaFiltrada"] ?>"
                       min="<?php echo $fechas["primeraCita"] ?>" max="<?php echo $fechas["ultimaCita"] ?>">
            </div>
            <div>
                <label for="tipo-cita">Tipo:</label>
                <select title="Elige tipo de cita" name="tipo-cita">
                    <option value="-1"></option>
                    <option value="0" <?php if(isset($_POST["tipo-cita"]) && $_POST["tipo-cita"] == 0) echo " selected "?> >Reparación</option>
                    <option value="1" <?php if(isset($_POST["tipo-cita"]) && $_POST["tipo-cita"] == 1) echo " selected "?> >Compra</option>
                </select>
            </div>
            <div>
                <label for="aceptada">¿Aceptada?: </label>
                <select title="Elige si la cita ha sido aceptada" name="aceptada">
                    <option value="-1"></option>
                    <option value="1" <?php if(isset($_POST["aceptada"]) && $_POST["aceptada"] == 1) echo " selected "?> >Sí</option>
                    <option value="0" <?php if(isset($_POST["aceptada"]) && $_POST["aceptada"] == 0) echo " selected "?> >No</option>
                </select>
            </div>
            <div>
                <label for="anulada">¿Anulada?: </label>
                <select title="Elige si la cita ha sido anulada" name="anulada">
                    <option value="-1"></option>
                    <option value="1" <?php if(isset($_POST["anulada"]) && $_POST["anulada"] == 1) echo " selected "?> >Sí</option>
                    <option value="0" <?php if(isset($_POST["anulada"]) && $_POST["anulada"] == 0) echo " selected "?> >No</option>
                </select>
            </div>
            <input name="filtrar" type="submit" value="Filtrar">
            <input name="mostrar-todas" type="submit" value="Mostrar todas">
        </fieldset>
        </form>


    </section>

    <section>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Aceptada</th>
                <th>Anulada</th>
            </tr>
            <?php
            foreach($citasFiltradas as $cita){
                echo "<tr> 
                <td>" . $cita['FECHA'] . "</td>
                <td>" . $cita['TIPO_CITA'] . "</td>";
                if($cita['ID_TIPO_CITA'] == 0 && $cita['ACEPTADA'] == 1){
                    echo "<td><a href='vistaReparacion.php?idCita=" . $cita['ID_CITA'] ."'>" . $cita['NOTA'] . "</a></td>";
                }else {
                    echo "<td>" . $cita['NOTA'] . "</td>";
                }
                echo "<td>" . $cita['ACEPTADA'] . "</td>
                <td>" . $cita['ANULADO'] . "</td>
                </tr>";
            }
            ?>
        </table>
    </section>

</div>

<?php include_once "footer.php"?>