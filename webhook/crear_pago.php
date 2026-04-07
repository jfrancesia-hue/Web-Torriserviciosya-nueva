<?php

require_once 'config.php';

function crear_link_pago($monto_total, $presupuesto_id) {

    try {
        $access_token = env('MERCADO_PAGO_ACCESS_TOKEN');
        
        // Si el access token no está configurado, retornar null
        if (empty($access_token)) {
            file_put_contents("debug.txt", "[MERCADO_PAGO] ⚠️ ACCESS_TOKEN no está en .env\n", FILE_APPEND);
            return null;
        }

        // Usar cURL para hacer request a Mercado Pago
        $url = 'https://api.mercadopago.com/checkout/preferences';
        
        $preference = [
            'items' => [
                [
                    'title' => 'Servicio contratado',
                    'description' => 'Presupuesto ID: ' . $presupuesto_id,
                    'unit_price' => floatval($monto_total),
                    'quantity' => 1,
                    'currency_id' => 'ARS'
                ]
            ],
            'back_urls' => [
                'success' => 'https://tooriserviciosya.com/success.php',
                'failure' => 'https://tooriserviciosya.com/failure.php',
                'pending' => 'https://tooriserviciosya.com/pending.php'
            ],
            'auto_return' => 'approved',
            'external_reference' => 'presupuesto_' . $presupuesto_id,
            'notification_url' => 'https://tooriserviciosya.com/webhook/webhook_pago.php'
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $access_token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($preference));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        file_put_contents("debug.txt", "[MERCADO_PAGO] HTTP $http_code - Response: " . substr($response, 0, 200) . "\n", FILE_APPEND);
        
        if ($http_code !== 201) {
            file_put_contents("debug.txt", "[ERROR] Mercado Pago error HTTP $http_code: " . $response . "\n", FILE_APPEND);
            return null;
        }
        
        $result = json_decode($response, true);
        
        if (isset($result['init_point'])) {
            file_put_contents("debug.txt", "[MERCADO_PAGO] ✅ Link generado: " . $result['init_point'] . "\n", FILE_APPEND);
            return $result['init_point'];
        } else {
            file_put_contents("debug.txt", "[ERROR] Mercado Pago no retornó init_point: " . json_encode($result) . "\n", FILE_APPEND);
            return null;
        }
        
    } catch (Exception $e) {
        file_put_contents("debug.txt", "[ERROR] Exception en crear_link_pago: " . $e->getMessage() . "\n", FILE_APPEND);
        return null;
    }
}
?>