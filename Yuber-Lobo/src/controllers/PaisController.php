<?php
namespace App\Controllers;

use App\Models\PaisModel;

class PaisController extends BaseController {
    public function __construct() {
        parent::__construct(new PaisModel());
    }

    // Puedes agregar métodos específicos aquí si es necesario
    public function getPaisesByCodigoRange($min, $max) {
        try {
            $result = $this->model->getPaisesByCodigoRange($min, $max);
            echo json_encode(["status" => "success", "data" => $result]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}