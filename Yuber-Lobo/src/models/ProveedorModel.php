<?php

namespace src\models;

class ProveedorModel extends BaseModel
{
    protected $endpoint = '/proveedores';

    public function getProveedores($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            '*',
            [
                'rel' => 'ProveedoresGrupos',
                'idProveedor' => 'idProveedor',
                'type' => 'idProveedor',
                'idAgrupacion' => '',
                'linkTo' => 'RazonSocial',
                'like' => ''
            ],
            'RazonSocial',
            20
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }
}
