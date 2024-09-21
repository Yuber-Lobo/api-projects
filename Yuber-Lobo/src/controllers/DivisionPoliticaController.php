<?php

require_once __DIR__ . '/../Models/DivisionPolitica.php';

class DivisionPoliticaController {
    private $db;
    private $divisionPolitica;

    public function __construct($db) {
        $this->db = $db;
        $this->divisionPolitica = new DivisionPolitica($db);
    }

    public function index($params = [], $queryParams = []) {
        $results = $this->divisionPolitica->read($queryParams);
        
        if($results === false) {
            http_response_code(500);
            echo json_encode(array("error" => "Error al obtener divisiones políticas."));
            return;
        }

        echo json_encode($results);
    }

       public function getDetailedStructureByPais($params, $queryParams) {
        $idPais = $params['id'] ?? null;
        if (!$idPais) {
            http_response_code(400);
            echo json_encode(array("error" => "ID de país no proporcionado."));
            return;
        }

        error_log("Obteniendo estructura detallada para el país: " . $idPais);
        error_log("Query params: " . json_encode($queryParams));

        $results = $this->divisionPolitica->getDetailedStructureByPais($idPais, $queryParams);
        
        if($results === false) {
            http_response_code(500);
            echo json_encode(array("error" => "Error al obtener la estructura detallada de división política."));
            return;
        }

        if(empty($results)) {
            http_response_code(404);
            echo json_encode(array("message" => "No se encontraron resultados para los criterios especificados."));
            return;
        }

        echo json_encode($results);
    }

    public function getDepartamentos($params) {
        $idPais = $params['id'] ?? null;
        if (!$idPais) {
            http_response_code(400);
            echo json_encode(array("error" => "ID de país no proporcionado."));
            return;
        }

        $results = $this->divisionPolitica->getDepartamentos($idPais);
        
        if($results === false) {
            http_response_code(500);
            echo json_encode(array("error" => "Error al obtener los departamentos."));
            return;
        }

        if(empty($results)) {
            http_response_code(404);
            echo json_encode(array("message" => "No se encontraron departamentos para el país especificado."));
            return;
        }

        echo json_encode($results);
    }

     public function getCiudades($params, $queryParams) {
        $idPais = $params['id'] ?? null;
        $idDepartamento = $queryParams['idDepartamento'] ?? null;
        
        if (!$idPais) {
            http_response_code(400);
            echo json_encode(array("error" => "ID de país no proporcionado."));
            return;
        }

        error_log("Obteniendo ciudades para el país: " . $idPais . ", departamento: " . $idDepartamento);

        $results = $this->divisionPolitica->getCiudades($idPais, $idDepartamento);
        
        if($results === false) {
            http_response_code(500);
            echo json_encode(array("error" => "Error al obtener las ciudades."));
            return;
        }

        if(empty($results)) {
            http_response_code(404);
            echo json_encode(array("message" => "No se encontraron ciudades para los criterios especificados."));
            return;
        }

        echo json_encode($results);
    }
}