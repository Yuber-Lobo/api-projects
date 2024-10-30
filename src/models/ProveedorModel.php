<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class ProveedorModel extends BaseModel
{
    protected $endpoint = '/relations';

    public function getProveedores($texto)
    {
        $params = [
            'rel' => 'Proveedores,ProveedoresGrupos',
            'type' => 'idProveedor,idProveedor',
            'select' => 'Proveedores.*',
            'linkTo' => 'RazonSocial,idAgrupacion',
            'like' => $texto . '_' . 'aDZrUlpXUjF4NytSampwRVJ4SU1BOGpwK1liTU12aUE5N2lLVDRLdUxlQmdFUTc3TU5kQ3kwdFk0WUUwaWF3QQ==',
            'orderBy' => 'RazonSocial',
            'orderMode' => 'ASC'
        ];
        return $this->get($params);
    }
}   
