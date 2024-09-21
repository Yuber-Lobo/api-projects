<?php
require_once 'BaseModel.php';

class Departamento extends BaseModel {
    public function __construct($db) {
        parent::__construct($db, 'dbo.Departamentos', 'idDepartamento', ['idDepartamento', 'Descripcion', 'Codigo']);
    }

    protected function extendSearch($params, &$conditions, &$values) {
        if (isset($params['Codigo'])) {
            $conditions[] = "Codigo LIKE ?";
            $values[] = "%" . $params['Codigo'] . "%";
        }
    }
}
