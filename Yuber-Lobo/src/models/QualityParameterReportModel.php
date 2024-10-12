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
            'linkTo' => 'Descripcion,fuente',
            'like' =>  $texto . '_R',
            'top' => 20
        ];
        return $this->get($params);
    }

    public function getAdvancedReports($filters = [])
    {
        $linkTo = ['fuente'];
        $like = ['R'];

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $linkTo[] = $key;
                $like[] = $value;
            }
        }

        $params = [
            'select' => '*',
            'linkTo' => implode(',', $linkTo),
            'like' => implode('_', $like),
            'top' => 20
        ];

        return $this->get($params);
    }
}
