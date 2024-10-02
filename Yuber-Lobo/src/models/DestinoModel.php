<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class DestinoModel extends BaseModel
{
    protected $endpoint = '/destino';

    public function getDestinos($texto)
    {
        $params = [
            'select' => '*',
            'linkTo' => 'Descripcion',
            'like' => $texto,
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
