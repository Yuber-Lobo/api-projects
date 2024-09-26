<?php
namespace App\Models;

class ProductoModel extends BaseModel {
    public function __construct() {
        parent::__construct('Productos', 'idProducto', ['idMaterial']);
    }

    // Método para obtener productos por material
    public function getProductosByMaterial($idMaterial) {
        $query = "SELECT * FROM {$this->table} WHERE idMaterial = :idMaterial";
        return $this->customQuery($query, ['idMaterial' => $idMaterial]);
    }
}