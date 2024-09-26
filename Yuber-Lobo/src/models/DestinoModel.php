<?php
namespace App\Models;

class DestinoModel extends BaseModel {
    public function __construct() {
        parent::__construct('Destino', 'idDestino', ['idClase', 'idProveedor', 'idPais', 'idDepartamento', 'idCiudad']);
    }

    // Método para obtener las ciudades por el id del departamento

    // Método para obtener destinos por clase
    public function getDestinosByClase($idClase) {
        $query = "SELECT * FROM {$this->table} WHERE idClase = :idClase";
        return $this->customQuery($query, ['idClase' => $idClase]);
    }



}