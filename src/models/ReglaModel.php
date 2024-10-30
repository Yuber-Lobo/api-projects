<?php

namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class ReglaModel extends BaseModel
{
    protected $endpoint = '/QualityParameterReport';

    public function getReglas($texto)
    {
        $params = [
            'select' => '*',
            'linkTo' => 'fuente,Descripcion',
            'like' => 'R_' . $texto,
            'top' => 20
        ];
        return $this->get($params);
    }

    
}