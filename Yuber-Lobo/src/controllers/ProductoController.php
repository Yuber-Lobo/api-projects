<?php
namespace App\Controllers;

use App\Models\ProductoModel;

class ProductosController extends BaseController {
    public function __construct() {
        parent::__construct(new ProductoModel());
    }

    public function getProductosByMaterial($idMaterial) {
        try {
            $result = $this->model->getProductosByMaterial($idMaterial);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}