<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class OrdenCompraModel extends BaseModel
{
    protected $endpoint = '/OrdenCompra';

    public function getOrdenesCompra($texto)
    {
        $params = [
            'select' => 'numeroTransaccion,OrdenCompra',
            'linkTo' => 'OrdenCompra',
            'like' => $texto,
            'orderBy' => 'numeroTransaccion',
            'orderMode' => 'ASC'
        ];
        return $this->get($params);
    }
}
