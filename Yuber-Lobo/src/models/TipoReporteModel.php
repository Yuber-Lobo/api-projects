<?php
namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class TipoReporteModel extends BaseModel
{
    protected $endpoint = '/cbTipoReporte()';

    public function getTipoReporte()
    {
        $params = [
            'select' => '*',
            'linkTo' => 'Prefijo',
            'equalTo' => 'R',
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC'
        ];
        return $this->get($params);
    }
}