<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class OrdenCompraModel extends BaseModel
{
    protected $endpoint = '/OrdenCompra';

    public function getOrdenesCompra($numero)
    {
        $params = [
            'select' => 'numeroTransaccion,OrdenCompra',
            'linkTo' => 'OrdenCompra',
            'like' => $numero,
            'orderBy' => 'numeroTransaccion',
            'orderMode' => 'ASC'
        ];
        return $this->get($params);
    }
}
