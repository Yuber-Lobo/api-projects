<?php
namespace App\Utils;

class EncryptionUtil {
    private static $apiUrl = "https://trazapp.minex.com.co/bot/Minexdocus/enc.php";

    public static function encrypt($data) {
        TimerUtil::start('encrypt');
        $result = self::callApi($data);
        TimerUtil::stop('encrypt');
        return $result;
    }

    public static function decrypt($data) {
        TimerUtil::start('decrypt');
        $result = self::callApi($data);
        TimerUtil::stop('decrypt');
        return $result;
    }

    private static function callApi($data) {
        TimerUtil::start('api_call');
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
        TimerUtil::stop('api_call');
        
        if (isset($result[0]['encrip'])) {
            return $result[0]['encrip'];
        } elseif (isset($result[0]['descrip'])) {
            return $result[0]['descrip'];
        } else {
            throw new \Exception("Unexpected response from encryption API: " . $response);
        }
    }
}