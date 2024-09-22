<?php
namespace App\Controllers;

use App\Models\DivisionPoliticaModel;

class DivisionPoliticaController extends BaseController {
    public function __construct() {
        parent::__construct(new DivisionPoliticaModel());
    }

     public function getDepartamentosByPais($idPais) {
        try {
            $result = $this->model->getDepartamentosByPais($idPais);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

   public function searchDepartamentosByPais($idPais, $searchTerm) {
        try {
            $result = $this->model->searchDepartamentosByPais($idPais, $searchTerm);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getCiudadesByDepartamento($idDepartamento) {
        try {
            $result = $this->model->getCiudadesByDepartamento($idDepartamento);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function searchCiudadesByDepartamento($idDepartamento, $searchTerm) {
        try {
            $result = $this->model->searchCiudadesByDepartamento($idDepartamento, $searchTerm);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

}