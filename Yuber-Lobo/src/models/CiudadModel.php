<?php
namespace App\Models;

class CiudadModel extends BaseModel {
    public function __construct() {
        parent::__construct('Ciudades', 'idCiudad');
    }

    // Puedes agregar métodos específicos aquí si es necesario
    public function getCiudadesByDepartamento($idDepartamento) {
        $query = "SELECT c.* FROM {$this->table} c
                  INNER JOIN DivisionPolitica dp ON c.idCiudad = dp.idCiudad
                  WHERE dp.idDepartamento = :idDepartamento";
        return $this->customQuery($query, ['idDepartamento' => $idDepartamento]);
    }
}