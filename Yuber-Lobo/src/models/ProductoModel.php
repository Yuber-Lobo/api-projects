<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class ProductoModel extends BaseModel
{
    protected $endpoint = '/productos';

    public function getProductos($texto)
    {
        $params = [
            'select' => 'idProducto,Descripcion',
            'linkTo' => 'Descripcion',
            'like' => $texto,
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC'
        ];
        return $this->get($params);
    }
}
