<?php
namespace App\Controllers;

use App\Models\PaisModel;

class PaisController extends BaseController {
    public function __construct() {
        parent::__construct(new PaisModel());
    }

    public function getPaisesDepartamentosCiudades()
    {
        try {
            $result = $this->model->getPaisesDepartamentosCiudades();
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getPaisesWithDepartamentos()
    {
        try {
            $result = $this->model->getPaisesWithDepartamentos();
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}