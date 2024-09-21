<?php

class BaseController {
    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index($params, $queryParams, $method) {
        if ($method === 'GET') {
            $results = $this->model->search($queryParams);
            if ($results === false) {
                http_response_code(500);
                echo json_encode(["error" => "Error en la búsqueda"]);
            } else if (empty($results)) {
                http_response_code(404);
                echo json_encode(["message" => "No se encontraron resultados"]);
            } else {
                echo json_encode($results);
            }
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $result = $this->model->create($data);
            if ($result) {
                http_response_code(201);
                echo json_encode(["message" => "Creado con éxito", "id" => $result]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al crear"]);
            }
        }
    }

    public function show($params) {
        $id = $params['id'];
        $result = $this->model->getById($id);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "No encontrado"]);
        }
    }
}