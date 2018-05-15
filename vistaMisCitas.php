<?php

include_once "controlador/controladorMisCitas.php";

$citas = getCitasFiltradas();

?>

<style>

</style>

<div class="main-container">
    <div>
        <div>
        </div>

        <div>
        </div>
    </div>

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
