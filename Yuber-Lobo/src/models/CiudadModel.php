<?php

namespace src\models;

class CiudadModel extends BaseModel
{
    protected $endpoint = '/ciudades';

    public function getCiudadesConFiltro($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            'idCiudad,Descripcion',
            [
                'linkTo' => 'idDepartamento',
                'equalTo' => '',
                'like' => 'Descripcion',
                'likeValue' => ''
            ],
            null,
            20
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }

    public function getCiudadesPorDepartamento($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            'idCiudad,Descripcion',
            [
                'linkTo' => 'idDepartamento',
                'equalTo' => ''
            ],
            null,
            20
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }
}
