<?php
require_once 'BaseModel.php';

class Clase extends BaseModel {
    public function __construct($db) {
        parent::__construct($db, 'dbo.Clase', 'idClase', ['idClase', 'Descripcion', 'Color']);
    }

    protected function extendSearch($params, &$conditions, &$values) {
        if (isset($params['Color'])) {
            $conditions[] = "Color = ?";
            $values[] = $params['Color'];
        }
    }
}