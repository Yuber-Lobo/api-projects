<?php

namespace src\models;

class ProductoModel extends BaseModel
{
    protected $endpoint = '/productos';

    public function getProductos($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            'idProducto,Descripcion',
            [
                'linkTo' => 'Descripcion',
                'like' => ''
            ],
            'Descripcion'
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }
}
