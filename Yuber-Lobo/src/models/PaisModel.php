<?php
namespace App\Models;

class PaisModel extends BaseModel {
    public function __construct() {
        parent::__construct('Paises', 'idPais');
    }

    // Método personalizado
    public function getPaisesByCodigoRange($min, $max) {
        $query = "SELECT * FROM {$this->table} WHERE Codigo BETWEEN :min AND :max";
        return $this->customQuery($query, ['min' => $min, 'max' => $max]);
    }
}