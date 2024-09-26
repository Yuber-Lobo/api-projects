<?php
namespace App\Models;

class DepartamentoModel extends BaseModel {
    public function __construct() {
        parent::__construct('Departamentos', 'idDepartamento');
    }

    // Método para obtener los departamentos junto con sus ciudades

    // Método para obtener los departamentos por el id del país
    public function getDepartamentosByPais($idPais) {
        $query = "SELECT d.* FROM {$this->table} d
                  INNER JOIN DivisionPolitica dp ON d.idDepartamento = dp.idDepartamento
                  WHERE dp.idPais = :idPais";
        return $this->customQuery($query, ['idPais' => $idPais]);
    }

    // Método para buscar departamentos por la id del país
    public function searchDepartamentosByPais($idPais, $searchTerm) {
        $query = "SELECT d.* FROM {$this->table} d
                  INNER JOIN DivisionPolitica dp ON d.idDepartamento = dp.idDepartamento
                  WHERE dp.idPais = :idPais
                  AND d.Descripcion LIKE :searchTerm";
        return $this->customQuery($query, ['idPais' => $idPais, 'searchTerm' => $searchTerm . '%']);
    }
}