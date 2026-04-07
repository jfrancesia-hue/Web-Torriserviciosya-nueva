<?php

function calcularTotal($monto) {
    $comision = $monto * 0.15;
    $total = $monto + $comision;

    return [
        "total" => $total,
        "comision" => $comision
    ];
}