<?php

function arrayToJS(array $valores, string $nombreVariableJS){

    $valoresJson = json_encode($valores);

    echo "<script>";
    echo 'var ' . $nombreVariableJS . ' = JSON.parse("' . $valoresJson . '")';
    echo "</script>";
}