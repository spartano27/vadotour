<?php
include_once "header.php";
include_once "controlador/admin/controladorCitasAdmin.php";

if(!isset($_SESSION["logueado"]) || $_SESSION['es_admin'] == 0){
    header("Location: vistaHome.php");
}

$citas = getCitas();

?>

<article>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Tipo de Cita</th>
            <th>Fecha</th>
            <th>Nota</th>
            <th>Aceptada</th>
            <th>Anulada</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($citas as $cita){
            echo "<form action='vistaCitasAdmin.php' name='accion-cita' method='post'>
                <tr> 
                <td>" . $cita['ID_CITA'] ."</td>
                <td>" . $cita['NOMBRE'] ."</td>
                <td>" . $cita['TIPO_CITA'] . "</td>
                <td>" . $cita['FECHA'] . "</td>";
            if($cita['ID_TIPO_CITA'] == 0 && $cita['ACEPTADA'] == 1 && isset($cita['ID_EST_REP']) && $cita['ID_EST_REP'] > 2){
                echo "<td class='td-ellipsis'><a href='vistaReparacion.php?idCita=" . $cita['ID_CITA'] ."'>" . $cita['NOTA'] . "</a></td>";
            }else {
                echo "<td class='td-ellipsis'>" . $cita['NOTA'] . "</td>";
            }
            echo "<td>" . $cita['ACEPTADA'] . "</td>
                <td>" . $cita['ANULADO'] . "</td>
                <td><input name='aceptar-cita' type='submit' value='Aceptar'>
                    <input name='anular-cita' type='submit' value='Anular'>
                    <input name='borrar-cita' type='submit' value='Borrar'>
                    <input name='id-cita' type='hidden' value='". $cita['ID_CITA'] ."'>
                    <input name='tipo-cita' type='hidden' value='". $cita['ID_TIPO_CITA'] ."'>
                 </td>
                </tr>
                </form>";
        } ?>
    </table>
</article>

<style>
    .td-ellipsis{
        max-width: 600px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
</style>