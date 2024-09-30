<?php

namespace src\utils;

class ApiClient
{
    public static function get($endpoint, $params = [])
    {
        $url = API_BASE_URL . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error decoding JSON response');
        }

        return $decodedResponse;
    }
}
