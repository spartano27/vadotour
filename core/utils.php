<?php

function arrayToJS(array $valores, string $nombreVariableJS){

    $valoresJson = json_encode($valores);

    echo "<script>";
    echo "var " . $nombreVariableJS . " = JSON.parse('" . $valoresJson . "')";
    echo "</script>";
}

function fromTimeToDate(int $time){
    return date("Y-m-d", $time);
}

function fromTimeToDatetime(int $time){
    return date("Y-m-d H:i:s", $time);
}