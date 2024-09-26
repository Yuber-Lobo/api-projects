<?php
namespace App\Models;

class CiudadModel extends BaseModel {
    public function __construct() {
        parent::__construct('Ciudades', 'idCiudad');
    }

    // Método para obtener ciudades por la id del departamento
    public function getCiudadesByDepartamento($idDepartamento) {
        $query = "SELECT c.* FROM {$this->table} c
                  INNER JOIN DivisionPolitica dp ON c.idCiudad = dp.idCiudad
                  WHERE dp.idDepartamento = :idDepartamento";
        return $this->customQuery($query, ['idDepartamento' => $idDepartamento]);
    }

    // Método para buscar ciudades por la id del departamento
    public function searchCiudadesByDepartamento($idDepartamento, $searchTerm) {
        $query = "SELECT c.* FROM {$this->table} c
                  INNER JOIN DivisionPolitica dp ON c.idCiudad = dp.idCiudad
                  WHERE dp.idDepartamento = :idDepartamento
                  AND c.Descripcion LIKE :searchTerm";
        return $this->customQuery($query, ['idDepartamento' => $idDepartamento, 'searchTerm' => $searchTerm . '%']);
    }
}