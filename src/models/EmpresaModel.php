<?php

namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class EmpresaModel extends BaseModel
{
    protected $endpoint = '/Proveedores';

    public function getEmpresas($texto)
    {
        $params = [
            'select' => 'idProveedor,RazonSocial',
            'linkTo' => 'RazonSocial,Empresa',
            'like' => $texto . '_1' ,
            'orderBy' => 'RazonSocial',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
