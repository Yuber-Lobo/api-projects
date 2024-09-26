<?php
namespace App\Controllers;

use App\Models\DestinoModel;

class DestinoController extends BaseController {
    public function __construct() {
        parent::__construct(new DestinoModel());
    }

    public function getDestinosByClase($idClase) {
        try {
            $result = $this->model->getDestinosByClase($idClase);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}