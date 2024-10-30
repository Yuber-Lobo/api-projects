<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class UnidadNegocioModel extends BaseModel
{
    protected $endpoint = '/unidaddenegocio';

    public function getUnidadesNegocio($texto)
    {
        $params = [
            'select' => 'idUnidadNegocio,Descripcion',
            'linkTo' => 'Descripcion',
            'like' => $texto,
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
