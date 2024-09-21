<?php
require_once 'BaseModel.php';

class Ciudad extends BaseModel {
    public function __construct($db) {
        parent::__construct($db, 'dbo.Ciudades', 'idCiudad', ['idCiudad', 'Descripcion', 'Codigo']);
    }

    protected function extendSearch($params, &$conditions, &$values) {
        if (isset($params['Codigo'])) {
            $conditions[] = "Codigo LIKE ?";
            $values[] = "%" . $params['Codigo'] . "%";
        }
    }
}