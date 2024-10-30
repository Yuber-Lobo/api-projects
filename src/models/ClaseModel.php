<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class ClaseModel extends BaseModel
{
    protected $endpoint = '/clase';

    public function getClases($texto)
    {
        $params = [
            'select' => 'idClase,Descripcion',
            'linkTo' => 'Descripcion',
            'like' => $texto,
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
