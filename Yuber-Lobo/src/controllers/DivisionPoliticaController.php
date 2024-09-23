<?php
namespace App\Controllers;

use App\Models\DivisionPoliticaModel;

class DivisionPoliticaController extends BaseController {
    public function __construct() {
        parent::__construct(new DivisionPoliticaModel());
    }

    public function getDivisionPolitica() {
        try {
            $result = $this->model->getDivisionPolitica();
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getDepartamentosByPais($encryptedIdPais) {
        try {
            $result = $this->model->getDepartamentosByPais($encryptedIdPais);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function searchDepartamentosByPais($encryptedIdPais, $searchTerm) {
        try {
            $result = $this->model->searchDepartamentosByPais($encryptedIdPais, $searchTerm);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getCiudadesByDepartamento($encryptedIdDepartamento) {
        try {
            $result = $this->model->getCiudadesByDepartamento($encryptedIdDepartamento);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function searchCiudadesByDepartamento($encryptedIdDepartamento, $searchTerm) {
        try {
            $result = $this->model->searchCiudadesByDepartamento($encryptedIdDepartamento, $searchTerm);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}