<?php

namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class OrigenModel extends BaseModel
{
    protected $endpoint = '/origenes';

    public function getOrigenes($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            'idOrigen,Mina',
            [
                'linkTo' => 'idProveedor',
                'equalTo' => $params['idProveedor'] ?? '',
                'like' => 'Mina',
                'likeValue' => $params['likeValue'] ?? ''
            ]
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }
}
