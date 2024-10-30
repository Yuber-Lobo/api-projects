<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class OrigenModel extends BaseModel
{
    protected $endpoint = '/Origenes';

    public function getOrigenesByProveedor($idProveedor)
    {
        $params = [
            'select' => 'idOrigen,Mina',
            'linkTo' => 'idProveedor',
            'equalTo' => $idProveedor
        ];
        return $this->get($params);
    }

    public function getOrigenesByMinaAndProveedor($texto, $idProveedor)
    {
        $params = [
            'select' => 'idOrigen,Mina',
            'linkTo' => 'Mina,idProveedor',
            'like' => $texto . '_' . $idProveedor
        ];
        return $this->get($params);
    }
}
