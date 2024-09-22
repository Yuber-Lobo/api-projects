<?php
namespace App\Controllers;

use App\Models\ClaseModel;

class ClaseController extends BaseController {
    public function __construct() {
        parent::__construct(new ClaseModel());
    }

    public function getClasesByColor($color) {
        try {
            $result = $this->model->getClasesByColor($color);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}