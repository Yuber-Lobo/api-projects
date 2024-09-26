<?php
namespace App\Controllers;

use App\Models\DestinoCodigosModel;

class DestinoCodigosController extends BaseController {
    public function __construct() {
        parent::__construct(new DestinoCodigosModel());
    }

    public function getCodigosByDestino($idDestino) {
        try {
            $result = $this->model->getCodigosByDestino($idDestino);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}