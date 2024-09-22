<?php
namespace App\Models;

class ClaseModel extends BaseModel {
    public function __construct() {
        parent::__construct('Clase', 'idClase');
    }

    // Puedes agregar métodos específicos aquí si es necesario
    public function getClasesByColor($color) {
        $query = "SELECT * FROM {$this->table} WHERE Color = :color";
        return $this->customQuery($query, ['color' => $color]);
    }
}