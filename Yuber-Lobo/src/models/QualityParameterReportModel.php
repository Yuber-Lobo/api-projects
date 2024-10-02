<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class QualityParameterReportModel extends BaseModel
{
    protected $endpoint = '/QualityParameterReport';

    public function getReports($texto)
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
