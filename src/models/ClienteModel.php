<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class ClienteModel extends BaseModel
{
    protected $endpoint = '/relations';

    public function getClientes($texto)
    {
        $params = [
            'rel' => 'Proveedores,ProveedoresGrupos',
            'type' => 'idProveedor,idProveedor',
            'select' => 'Proveedores.*',
            'linkTo' => 'RazonSocial,idAgrupacion',
            'like' => $texto . '_' . 'RzBidFZRb1V4WEdNMXNybTA0MmtNLzE1YXFwMnd4YmRIbHU5S2wwc0VKOGF3UzNDSGRzTnRoVEd1elhxN3FoRw==',
            'orderBy' => 'RazonSocial',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
