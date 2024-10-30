<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class PilaModel extends BaseModel
{
    protected $endpoint = '/pilas';

    public function getPilas($texto)
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
