<?php
require_once 'config.php';

function preguntarIA($mensaje, $model = "gpt-3.5-turbo") {

    $apiKey = env('OPENAI_KEY');

    if (!$apiKey) {
        file_put_contents("debug_openai.txt", "API KEY VACIA\n", FILE_APPEND);
        return "ERROR IA";
    }

    $envModel = env('OPENAI_MODEL');
    $firstModel = $envModel ?: $model;

    $fallbackModels = array_values(array_unique([$firstModel, 'gpt-4o', 'gpt-4o-mini', 'gpt-3.5-turbo']));

    $max_intentos_por_modelo = 2; // reintentos por modelo en caso de curl/429 temporales

    foreach ($fallbackModels as $mIndex => $tryModel) {
        for ($intentos = 1; $intentos <= $max_intentos_por_modelo; $intentos++) {

            $data = [
                "model" => $tryModel,
                "messages" => [
                    ["role" => "system", "content" => "Recopila datos para crear una oferta de servicio. Responde SOLO con una palabra o frase muy corta."],
                    ["role" => "user", "content" => $mensaje]
                ],
                "temperature" => 0,
                "max_tokens" => 50
            ];

            $ch = curl_init("https://api.openai.com/v1/chat/completions");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer " . $apiKey
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                file_put_contents("debug_openai.txt", "CURL ERROR modelo=$tryModel (intento $intentos): " . curl_error($ch) . "\n", FILE_APPEND);
                curl_close($ch);

                if ($intentos < $max_intentos_por_modelo) {
                    sleep(2);
                    continue;
                }
                // pasar al siguiente modelo
                break;
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            file_put_contents("debug_openai.txt", "INTENTO modelo=$tryModel intento=$intentos HTTP=$httpCode\n", FILE_APPEND);
            file_put_contents("debug_openai.txt", "RESPUESTA: " . substr($response ?? '', 0, 400) . "\n\n", FILE_APPEND);

            if ($httpCode === 200) {
                $result = json_decode($response, true);
                if (isset($result['choices'][0]['message']['content'])) {
                    file_put_contents("debug_openai.txt", "ÉXITO modelo=$tryModel\n", FILE_APPEND);
                    return $result['choices'][0]['message']['content'];
                }

                // respuesta incompleta -> reintentar con mismo modelo si quedan intentos
                file_put_contents("debug_openai.txt", "RESPUESTA INCOMPLETA modelo=$tryModel\n", FILE_APPEND);
                if ($intentos < $max_intentos_por_modelo) {
                    sleep(1);
                    continue;
                }
                break;
            }

            if ($httpCode === 401) {
                file_put_contents("debug_openai.txt", "ERROR 401: CREDENCIALES INVALIDAS\n", FILE_APPEND);
                return "ERROR IA - CREDENCIALES";
            }

            if ($httpCode === 429) {
                file_put_contents("debug_openai.txt", "ERROR 429: CUOTA/THROTTLE modelo=$tryModel intento=$intentos - reintentando\n", FILE_APPEND);
                if ($intentos < $max_intentos_por_modelo) {
                    sleep(2);
                    continue;
                }
                // si agotamos intentos con este modelo, pasar al siguiente
                break;
            }

            // otros errores HTTP: pasar al siguiente modelo
            file_put_contents("debug_openai.txt", "ERROR HTTP $httpCode con modelo=$tryModel - pasando a siguiente modelo\n", FILE_APPEND);
            break;
        }
    }

    file_put_contents("debug_openai.txt", "FALLARON TODOS LOS MODELOS: " . implode(',', $fallbackModels) . "\n", FILE_APPEND);
    return "ERROR IA";
}