<?php
require_once 'db.php';

function obtenerTop3($oferta_id) {

    $endpoint = "presupuestos?oferta_id=eq.$oferta_id&order=score.desc&limit=3";

    return supabaseRequest("GET", $endpoint);
}