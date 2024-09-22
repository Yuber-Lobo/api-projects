<?php
namespace App\Controllers;

use App\Models\CiudadModel;

class CiudadController extends BaseController {
    public function __construct() {
        parent::__construct(new CiudadModel());
    }

    public function getCiudadesByDepartamento($idDepartamento) {
        try {
            $result = $this->model->getCiudadesByDepartamento($idDepartamento);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}