<?php

namespace src\utils;

class ApiClient
{
    public static function get($endpoint, $params = [])
    {
        $url = API_BASE_URL . $endpoint;
        if (!empty($params)) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($params);
        }

        error_log("Requesting URL: " . $url);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Aumentamos el timeout a 30 segundos
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log("cURL Error: " . curl_error($ch));
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        error_log("Response HTTP Code: " . $httpCode);
        error_log("Response Body: " . substr($response, 0, 1000)); // Log solo los primeros 1000 caracteres

        if ($httpCode >= 400) {
            throw new \Exception("HTTP Error: " . $httpCode);
        }

        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error decoding JSON response');
        }

        return $decodedResponse;
    }
}
