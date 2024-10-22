<?php

namespace src\models;

use src\utils\ApiClient;

require_once __DIR__ . '/../utils/ApiClient.php';

abstract class BaseModel
{
    protected $endpoint;

    public function get($params = [])
    {
        return ApiClient::get($this->endpoint, $params);
    }

    public function post($data = [])
    {
        return ApiClient::post($this->endpoint, $data);
    }
}
