<?php
namespace App\Utils;

class EncryptionUtil {
    private static $apiUrl = "https://trazapp.minex.com.co/bot/Minexdocus/enc.php";

    public static function encrypt($data) {
        $result = self::callApi($data);
        return isset($result[0]['encrip']) ? $result[0]['encrip'] : null;
    }

    public static function decrypt($data) {
        $result = self::callApi($data);
        return isset($result[0]['descrip']) ? $result[0]['descrip'] : null;
    }

    private static function callApi($data) {
        $postData = json_encode(["dato" => $data]);

        $ch = curl_init(self::$apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData)
        ]);

        // Deshabilitar la verificación SSL (solo para desarrollo)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            $errorNo = curl_errno($ch);
            curl_close($ch);
            throw new \Exception("Error calling encryption API: " . $error . " (Error code: " . $errorNo . ")");
        }

        curl_close($ch);

        $result = json_decode($response, true);
        
        if (!is_array($result) || !isset($result[0])) {
            throw new \Exception("Unexpected response format from encryption API: " . $response);
        }

        return $result;
    }
}