<?php

namespace src\models;
use src\utils\ApiClient;

require_once __DIR__ . '/../utils/ApiClient.php';
require_once __DIR__ . '/BaseModel.php';

class QualityParameterReportModel extends BaseModel
{
    protected $endpoint = '/QualityParameterReport';

    public function getReports()
    {
        $params = [
            'select' => '*',
            'linkTo' => 'fuente',
            'equalTo' => 'R',
        ];
        return $this->get($params);
    }

    public function getAdvancedReports($filters = [])
    {
        $linkTo = ['fuente'];
        $like = ['R'];

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $linkTo[] = $key;
                $like[] = $value;
            }
        }

        $params = [
            'select' => '*',
            'linkTo' => implode(',', $linkTo),
            'like' => implode('_', $like),
            'top' => 20
        ];

        return $this->get($params);
    }

    public function createReport($data)
    {
        $postEndpoint = '/sp/SAVE_QualityParameterReport';
        $jsonBody = json_encode($data);
        $params = [
            'body' => $jsonBody,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        return ApiClient::post($postEndpoint, $params);
    }
}
