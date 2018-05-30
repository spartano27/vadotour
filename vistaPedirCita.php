<?php
include_once "header.php";
include_once "controlador/controladorPedirCita.php";

$fechaAhora = date("Y-m-d", time());
$fechaSemanaSiguiente = date("Y-m-d", time() +  (7 * 24 * 60 * 60));
$huecosOcupadosProximaSemana = huecosOcupadosProximaSemana();

?>
<div class="main-container column">

    <form id="pedir-cita" action="vistaPedirCita.php" method="post">
        <div>
            <p><label for="crear-cita-fecha">Fecha: </label></p>
            <div>
                <input id="crear-cita-fecha" name="fecha" title="Fecha de la cita" type="date"
                        value="<?php echo !empty($_POST["fecha"])? $_POST["fecha"] : $fechaAhora ?>"
                        min="<?php echo $fechaAhora ?>"
                        max="<?php echo $fechaSemanaSiguiente ?>">
                <label for="horas">, hora </label>
                <select name="horas" title="Horas de la cita disponibles">
                    <option value="-1">--</option>
                </select>
                <label for="minutos">, minuto </label>
                <select name="minutos" title="Minutos de la cita disponibles">
                    <option value="-1">--</option>
                </select>
            </div>
        </div>
        <div>
            <p>Tipo de cita:</p>
            <div>
                <input id="tipo1" type="radio" class="radio" name="tipoCita" value="0" checked>
                <label for="tipo1">Reparación</label>
                <input id="tipo2"  type="radio" class="radio" name="tipoCita" value="1">
                <label for="tipo2">Prueba de vehículo</label>
            </div>
        </div>
        <div>
            <p><label for="crear-cita-nota">Notas extras: </label></p>
            <textarea id="crear-cita-nota" type="text" name="nota" style="width: 80%; height: 50px"></textarea>
        </div>

        <p>
            <input id="crear-cita-submit" name="crearCita" type="submit" value="Reservar cita">
        </p>

    </form>

</div>

<?php arrayToJS($huecosOcupadosProximaSemana, "huecosOcupados") ?>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<!-- FIltro de horas y minutos -->
<script>

    $(document).ready(function(){

    function addOptionsToHoursSelect() {
        $horasSelect.children().remove();
        for (let i = 0; i<horasDia.length; i++){
            let hora = horasDia[i];

            $horasSelect.append('<option value="' + hora + '">' + hora + '</option>');

        }
        addOptionsToMinutesSelect();
    }

    function addOptionsToMinutesSelect(){
        let dia = $fechaInput.val().slice(-2);

        $minutosSelect.children().remove();
        for (let i = 0; i<minutosHora.length; i++){
            let hora = $horasSelect.val();
            let minuto = minutosHora[i];

            if (dia in huecosOcupados && hora in huecosOcupados[dia] && minuto in huecosOcupados[dia][hora]){
                $minutosSelect.append('<option value="' + minuto + '" disabled>' + minuto + '</option>');
            } else{
                $minutosSelect.append('<option value="' + minuto + '">' + minuto + '</option>');
            }
        }
    }

        $fechaInput = $("input[name='fecha']");
        $horasSelect = $("select[name='horas']");
        $minutosSelect = $("select[name='minutos']");

        let horasDia = ["09", "10", "11", "12", "13", "14",
            "17", "18", "19", "20", "21"];
        let minutosHora = ["00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55"];

        $fechaInput.change(function (e) {
            addOptionsToHoursSelect();
        });


        $horasSelect.change(function () {
            addOptionsToMinutesSelect();
        });

        addOptionsToHoursSelect();

    });



</script>


<?php include_once "footer.php"?>