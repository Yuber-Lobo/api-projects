<?php

namespace src\models;
class RestriccionBolsasCalidadModel extends BaseModel
{
    protected $endpoint = '/sp/SAVE_RestriccionBolsasCalidad';

    public function createRestriccionBolsasCalidad($data)
    {
        $jsonBody = json_encode($data);
        $params = [
            'body' => $jsonBody,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        return $this->post($params);
    }
}
?>