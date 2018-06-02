<?php
include_once "header.php";
include_once "controlador/admin/controladorReparacionesAdmin.php";

if(!isset($_SESSION["logueado"]) || $_SESSION['es_admin'] == 0){
    header("Location: vistaHome.php");
}

$reparaciones = getReparaciones();

?>

<article>
    <table border="1">
        <tr>
            <th>Cliente</th>
            <th>Descripción</th>
            <th>Vehículo</th>
            <th>Fecha Comienzo</th>
            <th>Finalización estimada</th>
            <th>Fecha finalización</th>
            <th>Página</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        <?php foreach($reparaciones as $reparacion){

            if(empty($reparacion['MODELO'])){
                $vehiculo = "<select title='Elige vehiculo del cliente' name='id-vehiculo-cliente'>";

                $vehiculosCliente = getVehiculos($reparacion["ID_USUARIO"]);

                foreach($vehiculosCliente as $v){
                    $modeloMatricula = $v['MODELO'] . "(" . $v['MATRICULA'] . ")";
                    $vehiculo .= "<option value='". $v['ID_VEHICULO'] ."'>" . $modeloMatricula . "</option>";
                }
                $vehiculo .= "</select>";
            }else{
                $vehiculo = $reparacion['MODELO'] . "(" . $reparacion['MATRICULA'] . ")";
            }

            $fechaEstFin = empty($reparacion['FECHA_ESTIMADA_FINALIZACION']) && $reparacion['ID_EST_REP'] > 1
                ? "<input type='date' name='fecha-estimada'>"
                : $reparacion['FECHA_ESTIMADA_FINALIZACION'];


            $fechaComienzo = empty($reparacion['FECHA_COMIENZO']) ? "" : $reparacion['FECHA_COMIENZO'];
            $fechaFinalizacion = empty($reparacion['FECHA_FINALIZACION']) ? "" : $reparacion['FECHA_FINALIZACION'];
            $paginaReparacion = $reparacion['ID_EST_REP'] <= 2 ? "" : "<a href='vistaReparacion.php?idCita=". $reparacion['ID_CITA'] ."'>Ir</a>";


            echo "<form action='vistaReparacionesAdmin.php' name='accion-cita' method='post'>
                <tr> 
                <td>" . $reparacion['NOMBRE'] ."</td>
                <td class='td-ellipsis'>" . $reparacion['NOTA'] ."</td>
                <td>" . $vehiculo . "</td>
                <td>" . $fechaComienzo . "</td>
                <td>" . $fechaEstFin . "</td>
                <td>" . $fechaFinalizacion . "</td>
                <td>" . $paginaReparacion ."</td>
                <td>" . $reparacion['ESTADO']."</td>";

            $idSiguienteEstOk = "";
            $siguienteEstadoOk = "";
            $idSiguienteEstNoOk = "";
            $siguienteEstadoNoOk = "";

            switch ($reparacion["ID_EST_REP"]){
                case 0:
                case 1:
                    $idSiguienteEstOk = 2;
                    $siguienteEstadoOk = "Recoger vehículo";
                    break;
                case 2:
                    $idSiguienteEstOk = 5;
                    $siguienteEstadoOk = "Comenzar reparación";
                    break;
                case 5:
                    $idSiguienteEstOk = 6;
                    $siguienteEstadoOk = "Finalizar reparación";
                    $idSiguienteEstNoOk = 7;
                    $siguienteEstadoNoOk = "Interrumpir reparación";
                    break;
                case 6:
                    $idSiguienteEstOk = 8;
                    $siguienteEstadoOk = "Entregar vehículo";
                    break;
                case 7:
                    $idSiguienteEstOk = 5;
                    $siguienteEstadoOk = "Reanudar reparación";
                    $idSiguienteEstNoOk = 9;
                    $siguienteEstadoNoOk = "Devolver sin reparar";
                    break;
            }
            echo "<td>";
            if(!empty($idSiguienteEstNoOk)){
                echo "<input name='siguiente-estado-" . $idSiguienteEstNoOk . "' type='submit' value='" . $siguienteEstadoNoOk . "'>";
            }
            if(!empty($idSiguienteEstOk)) {
                echo "<input name='siguiente-estado-" . $idSiguienteEstOk . "' type='submit' value='" . $siguienteEstadoOk . "'>";
            }

            echo "<input name='borrar-reparacion' type='submit' value='Borrar reparación'>
                    <input name='id-reparacion' type='hidden' value='". $reparacion['ID_REP'] ."'>
                    <input name='estado-reparacion' type='hidden' value='". $reparacion['ID_EST_REP'] ."'>
                 </td>
                </tr>
                </form>";
        } ?>
    </table>
</article>
