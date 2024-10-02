<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class ClasificacionModel extends BaseModel
{
    protected $endpoint = '/Clasificacion';

    public function getClasificacionesPorProducto($idProducto)
    {
        $params = [
            'select' => 'idClasificacion,Descripcion',
            'linkTo' => 'idProducto',
            'equalTo' => $idProducto
        ];
        return $this->get($params);
    }

    public function getClasificacionesPorDescripcionYProducto($texto, $idProducto)
    {
        $params = [
            'select' => 'idClasificacion,Descripcion',
            'linkTo' => 'Descripcion,idProducto',
            'like' => $texto . '_' . $idProducto
        ];
        return $this->get($params);
    }
}
