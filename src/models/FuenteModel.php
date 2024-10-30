<?php

namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class FuenteModel extends BaseModel
{
    protected $endpoint = '/cbTransaccion_ruta()';

    public function getFuentes()
    {
        $params = [
            'select' => '*',
            'between1' => '',
            'between2' => '',
            'linkTo' => '',
            'filterTo' => 'cbTransaccion',
            'inTo' => 'D,R',
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC'
        ];
        return $this->get($params);
    }

   
}