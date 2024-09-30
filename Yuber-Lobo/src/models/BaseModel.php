<?php

namespace src\models;

use src\utils\ApiClient;

require_once UTILS_PATH . 'ApiClient.php';

abstract class BaseModel
{
    protected $endpoint;

    public function get($params = [])
    {
        return ApiClient::get($this->endpoint, $params);
    }

    protected function buildQueryParams($select = '*', $filters = [], $orderBy = null, $limit = null)
    {
        $params = ['select' => $select];

        foreach ($filters as $key => $value) {
            if (strpos($key, 'like') !== false) {
                $params[$key] = '%' . $value . '%';
            } else {
                $params[$key] = $value;
            }
        }

        if ($orderBy) {
            $params['orderBy'] = $orderBy;
        }

        if ($limit) {
            $params['top'] = $limit;
        }

        return $params;
    }
}
