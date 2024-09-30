<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class ClasificacionModel extends BaseModel
{
    protected $endpoint = '/Clasificacion';

    public function getClasificaciones($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            'idClasificacion,Descripcion',
            [
                'linkTo' => 'idProducto',
                'equalTo' => '',
                'like' => 'Descripcion',
                'likeValue' => ''
            ]
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }
}
