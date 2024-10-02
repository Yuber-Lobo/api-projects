<?php

namespace src\models;
require_once __DIR__ . '/BaseModel.php';

class CiudadModel extends BaseModel
{
    protected $endpoint = '/vCiudades';

    public function getCiudadesPorDepartamento($idDepartamento)
    {
        $params = [
            'select' => 'idCiudad,Descripcion',
            'linkTo' => 'idDepartamento',
            'equalTo' => $idDepartamento,
            'top' => 20
        ];
        return $this->get($params);
    }

    public function getCiudadesPorDescripcionYDepartamento($texto, $idDepartamento)
    {
        $params = [
            'select' => 'idCiudad,Descripcion',
            'linkTo' => 'Descripcion,idDepartamento',
            'like' => $texto . '_' . $idDepartamento,
            'top' => 20
        ];
        return $this->get($params);
    }
}
