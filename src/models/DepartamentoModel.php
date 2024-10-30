<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class DepartamentoModel extends BaseModel
{
    protected $endpoint = '/vDepartamentos';

    public function getDepartamentos($texto)
    {
        $params = [
            'select' => 'idDepartamento,Descripcion',
            'linkTo' => 'Descripcion',
            'like' => $texto,
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
