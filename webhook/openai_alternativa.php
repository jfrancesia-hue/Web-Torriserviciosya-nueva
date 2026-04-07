<?php
/**
 * Alternativa económica a OpenAI para clasificar solicitudes
 * Sin costo - usa lógica simple en lugar de IA
 */

function clasificarSolicitudSinIA($descripcion) {
    $descripcion = strtolower(trim($descripcion));
    
    // Si es muy corta, es incompleta
    if (strlen($descripcion) < 10) {
        return "INCOMPLETO";
    }
    
    // Si contiene palabras que indican una descripción incompleta
    $palabras_incompletas = ['plomero', 'electricista', 'carpintero', 'pintor', 'albañil', 'mecanico', 'techador'];
    foreach ($palabras_incompletas as $palabra) {
        if (strpos($descripcion, $palabra) !== false && strlen($descripcion) < 50) {
            return "INCOMPLETO";
        }
    }
    
    // Si tiene palabras que indican problema específico
    $palabras_completas = ['tubo', 'grifo', 'baño', 'cocina', 'cable', 'lámpara', 'puerta', 'ventana', 'pared', 'techo', 'piso', 'suelo', 'goteras', 'humedad', 'rotura', 'fuga', 'instalación'];
    $coincidencias = 0;
    foreach ($palabras_completas as $palabra) {
        if (strpos($descripcion, $palabra) !== false) {
            $coincidencias++;
        }
    }
    
    if ($coincidencias >= 2 || strlen($descripcion) > 50) {
        return "COMPLETO";
    }
    
    return "INCOMPLETO";
}

function obtenerCategoriaConIA($descripcion) {
    // Categorías por palabra clave (sin IA)
    $descripcion = strtolower(trim($descripcion));
    
    $categorias = [
        'fontanería' => ['tubo', 'grifo', 'baño', 'fuga', 'agua', 'desagüe', 'cañería'],
        'electricidad' => ['cable', 'lámpara', 'luz', 'interruptor', 'enchufe', 'corriente', 'tomacorriente'],
        'carpintería' => ['puerta', 'ventana', 'marco', 'madera', 'armario', 'estante'],
        'albañilería' => ['pared', 'piso', 'hormigón', 'cerámico', 'azulejo', 'construcción'],
        'pintura' => ['pintar', 'pintura', 'color', 'pared', 'mueble'],
        'climatización' => ['aire', 'calefacción', 'temperatura', 'ventilación'],
    ];
    
    foreach ($categorias as $categoria => $palabras_clave) {
        foreach ($palabras_clave as $palabra) {
            if (strpos($descripcion, $palabra) !== false) {
                return ucfirst($categoria);
            }
        }
    }
    
    return "Servicios generales";
}
