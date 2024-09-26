<?php
namespace App\Models;

class ClasificacionModel extends BaseModel {
    public function __construct() {
        parent::__construct('Clasificacion', 'idClasificacion', ['idMaterial', 'idProducto', 'UnidadDeNegocio']);
    }

    // Método para obtener clasificaciones por material y producto
    public function getClasificacionesByMaterialAndProducto($idMaterial, $idProducto) {
        $query = "SELECT * FROM {$this->table} WHERE idMaterial = :idMaterial AND idProducto = :idProducto";
        return $this->customQuery($query, ['idMaterial' => $idMaterial, 'idProducto' => $idProducto]);
    }
}