<?php

namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class ParametrosAgrupacionModel extends BaseModel
{

    protected $endpoint = '/ParametrosAgrupacion';

    public function getParametrosAgrupacion()
    {
        $params = [
            'select' => 'idGrupo,Descripcion',
        ];
        return $this->get($params);
    }
}
