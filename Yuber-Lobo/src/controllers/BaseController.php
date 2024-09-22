<?php
namespace App\Controllers;

abstract class BaseController {
    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll() {
        try {
            $result = $this->model->getAll();
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getById($id) {
        try {
            $result = $this->model->getById($id);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["status" => "error", "message" => "Record not found"]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function search($column, $value) {
        try {
            $result = $this->model->search($column, $value);
            echo json_encode($result);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function create($data) {
        try {
            $result = $this->model->create($data);
            if ($result) {
                http_response_code(201);
                echo json_encode(["status" => "success", "message" => "Record created successfully"]);
            } else {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Failed to create record"]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}