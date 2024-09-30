<?php

namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class EmpresaModel extends BaseModel
{
    protected $endpoint = '/empresa';

    public function getEmpresa($params = [])
    {
        $defaultParams = $this->buildQueryParams(
            'idProveedor,RazonSocial',
            [
                'linkTo' => 'idProveedor',
                'equalTo' => $params['idProveedor'] ?? '',
                'like' => 'Mina',
                'likeValue' => $params['likeValue'] ?? ''
            ]
        );

        $mergedParams = array_merge($defaultParams, $params);
        return $this->get($mergedParams);
    }
}
