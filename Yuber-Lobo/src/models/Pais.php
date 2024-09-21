<?php
require_once 'BaseModel.php';

class Pais extends BaseModel {
    public function __construct($db) {
        parent::__construct($db, 'dbo.Paises', 'idPais', ['idPais', 'Descripcion', 'Codigo']);
    }

    protected function extendSearch($params, &$conditions, &$values) {
        if (isset($params['Codigo'])) {
            $conditions[] = "Codigo LIKE ?";
            $values[] = "%" . $params['Codigo'] . "%";
        }
    }
}
?>