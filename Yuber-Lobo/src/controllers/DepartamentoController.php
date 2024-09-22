<?php
namespace App\Controllers;

use App\Models\DepartamentoModel;

class DepartamentoController extends BaseController {
    public function __construct() {
        parent::__construct(new DepartamentoModel());
    }

    public function getDepartamentosByPais($idPais) {
        try {
            $result = $this->model->getDepartamentosByPais($idPais);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}