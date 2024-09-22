<?php
namespace App\Models;

class DepartamentoModel extends BaseModel {
    public function __construct() {
        parent::__construct('Departamentos', 'idDepartamento');
    }

    // Puedes agregar métodos específicos aquí si es necesario
    public function getDepartamentosByPais($idPais) {
        $query = "SELECT d.* FROM {$this->table} d
                  INNER JOIN DivisionPolitica dp ON d.idDepartamento = dp.idDepartamento
                  WHERE dp.idPais = :idPais";
        return $this->customQuery($query, ['idPais' => $idPais]);
    }
}