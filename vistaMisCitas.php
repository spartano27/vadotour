<?php

include_once "controlador/controladorMisCitas.php";

$citas = citasFiltradas();

?>

<style>

</style>

<div class="main-container">
    <div>
        <div>
            <form id="filtro-citas" action="vistaMisCitas.php" method="post">
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
            </form>
        </div>

        <div>
        </div>
    </div>

    <div>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Aceptada</th>
                <th>Anulada</th>
            </tr>
            <?php
            foreach($citas as $cita){
                echo "<tr> 
                <td>" . $cita['FECHA'] . "</td>
                <td>" . $cita['ID_TIPO_CITA'] . "</td>
                <td>" . $cita['NOTA'] . "</td>
                <td>" . $cita['ACEPTADA'] . "</td>
                <td>" . $cita['ANULADO'] . "</td>
                </tr>";
            }
            ?>
        </table>
    </div>

</div>
