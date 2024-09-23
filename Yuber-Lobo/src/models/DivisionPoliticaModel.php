<?php
namespace App\Models;

class DivisionPoliticaModel extends BaseModel {
    public function __construct() {
        parent::__construct('DivisionPolitica', 'idPais', ['idDepartamento', 'idCiudad']);
    }

    public function getDivisionPolitica() {
        $query = "SELECT dp.*, p.Descripcion as Pais, d.Descripcion as Departamento, c.Descripcion as Ciudad
                  FROM {$this->table} dp
                  INNER JOIN Paises p ON dp.idPais = p.idPais
                  INNER JOIN Departamentos d ON dp.idDepartamento = d.idDepartamento
                  INNER JOIN Ciudades c ON dp.idCiudad = c.idCiudad";
        return $this->customQuery($query);
    }

    public function getDepartamentosByPais($idPais) {
        $query = "SELECT D.idDepartamento, D.Descripcion, D.Codigo
                  FROM Departamentos D
                  INNER JOIN DivisionPolitica DP ON D.idDepartamento = DP.idDepartamento
                  WHERE DP.idPais = :idPais
                  GROUP BY D.idDepartamento, D.Descripcion, D.Codigo";
        return $this->customQuery($query, ['idPais' => $idPais]);
    }

    public function searchDepartamentosByPais($idPais, $searchTerm) {
        $query = "SELECT D.idDepartamento, D.Descripcion, D.Codigo
                  FROM Departamentos D
                  INNER JOIN DivisionPolitica DP ON D.idDepartamento = DP.idDepartamento
                  WHERE DP.idPais = :idPais
                  AND D.Descripcion LIKE :searchTerm
                  GROUP BY D.idDepartamento, D.Descripcion, D.Codigo";
        return $this->customQuery($query, ['idPais' => $idPais, 'searchTerm' => $searchTerm . '%']);
    }

    public function getCiudadesByDepartamento($idDepartamento) {
        $query = "SELECT C.idCiudad, C.Descripcion, C.Codigo
                  FROM Ciudades C
                  INNER JOIN DivisionPolitica DP ON C.idCiudad = DP.idCiudad
                  WHERE DP.idDepartamento = :idDepartamento
                  GROUP BY C.idCiudad, C.Descripcion, C.Codigo";
        return $this->customQuery($query, ['idDepartamento' => $idDepartamento]);
    }

    public function searchCiudadesByDepartamento($idDepartamento, $searchTerm) {
        $query = "SELECT C.idCiudad, C.Descripcion, C.Codigo
                  FROM Ciudades C
                  INNER JOIN DivisionPolitica DP ON C.idCiudad = DP.idCiudad
                  WHERE DP.idDepartamento = :idDepartamento
                  AND C.Descripcion LIKE :searchTerm
                  GROUP BY C.idCiudad, C.Descripcion, C.Codigo";
        return $this->customQuery($query, ['idDepartamento' => $idDepartamento, 'searchTerm' => $searchTerm . '%']);
    }
}