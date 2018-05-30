<?php
include_once "header.php";
include_once "controlador/controladorReparacion.php";

$reparacion = reparacion();
$comentarios = comentarios();
$formAction = "vistaReparacion.php?idCita=" . $idCita;

?>
<div>
    <p>Vehículo: <?php echo $reparacion["MODELO"] . " (" . $reparacion["MATRICULA"] . ")"?></p>
    <p>Estado: <?php echo $reparacion["ESTADO"] ?></p>
    <p>Fecha de comienzo: <?php echo $reparacion["FECHA_COMIENZO"] ?></p>
    <p>Fecha estimada de finalización: <?php echo $reparacion["FECHA_ESTIMADA_FINALIZACION"] ?></p>

    <h3>Comentarios</h3>

    <ol class="lista-comentarios">

        <?php foreach($comentarios as $comentario){

            $tipoComentario = $comentario["ES_ADMIN"] == 1 ? 'comentario-admin' : 'comentario-cliente';

            echo '<li class="comentario ' . $tipoComentario .'">
                       <div class="comentario-cuerpo">
                            <div class="comentario-autor"> ' . $comentario["NOMBRE"] . ' ' . $comentario["APELLIDOS"] .':</div>
                            <div class="comentario-fecha"> ' . $comentario["FECHA"] . '</div>
                            <div class="comentario-cuerpo"> ' . $comentario["COMENTARIO"] . '</div>
                       </div>
                 </li>';
        } ?>
    </ol>

    <label for="comentario-cuerpo">Escribe un comentario:</label>
    <form id="nuevo-comentario" action="<?php echo $formAction ?>" method="post" class="reparacion-nuevo-comentario">
        <textarea id="comentario-cuerpo" name="comentario-cuerpo" class="comentario-cuerpo" style="width:90%;height:100px;"></textarea>
        <input type="submit" name="comentario-creado" value="Enviar">
    </form>
</div>
