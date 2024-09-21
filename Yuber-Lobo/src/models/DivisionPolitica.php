<?php

class DivisionPolitica {
    private $conn;
    private $table = 'dbo.DivisionPolitica';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read($params = []) {
        $query = "SELECT idPais, idDepartamento, idCiudad FROM " . $this->table;
        $conditions = [];
        $values = [];

        if (!empty($params['idPais'])) {
            $conditions[] = "idPais = ?";
            $values[] = $params['idPais'];
        }

        if (!empty($params['idDepartamento'])) {
            $conditions[] = "idDepartamento = ?";
            $values[] = $params['idDepartamento'];
        }

        if (!empty($params['idCiudad'])) {
            $conditions[] = "idCiudad = ?";
            $values[] = $params['idCiudad'];
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($values);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

         public function getDetailedStructureByPais($idPais, $queryParams = []) {
        $conditions = ["dp.idPais = ?"];
        $params = [$idPais];

        if (!empty($queryParams['departamento'])) {
        $conditions[] = "d.Descripcion LIKE ?";
            $params[] = '%' . $queryParams['departamento'] . '%';
        }

        if (!empty($queryParams['ciudad'])) {
        $conditions[] = "c.Descripcion LIKE ?";
            $params[] = '%' . $queryParams['ciudad'] . '%';
        }

        $whereClause = implode(" AND ", $conditions);

        $query = "SELECT 
                    dp.idPais,
                    d.idDepartamento,
                    d.Descripcion AS DepartamentoDescripcion,
                    d.Codigo AS DepartamentoCodigo,
                    c.idCiudad,
                    c.Descripcion AS CiudadDescripcion,
                    c.Codigo AS CiudadCodigo
                  FROM " . $this->table . " dp
                  JOIN dbo.Departamentos d ON dp.idDepartamento = d.idDepartamento
                  JOIN dbo.Ciudades c ON dp.idCiudad = c.idCiudad
                  WHERE " . $whereClause . "
                  ORDER BY d.Descripcion, c.Descripcion";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            error_log("Query ejecutada: " . $query);
            error_log("Parámetros: " . json_encode($params));
            error_log("Número de resultados: " . count($results));

            $structure = [];
            foreach ($results as $row) {
                if (!isset($structure[$row['idDepartamento']])) {
                    $structure[$row['idDepartamento']] = [
                        'idDepartamento' => $row['idDepartamento'],
                        'Descripcion' => $row['DepartamentoDescripcion'],
                        'Codigo' => $row['DepartamentoCodigo'],
                        'Ciudades' => []
                    ];
                }
                $structure[$row['idDepartamento']]['Ciudades'][] = [
                    'idCiudad' => $row['idCiudad'],
                    'Descripcion' => $row['CiudadDescripcion'],
                    'Codigo' => $row['CiudadCodigo']
                ];
            }
            return array_values($structure);
        } catch(PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function getDepartamentos($idPais) {
        $query = "SELECT DISTINCT 
                    d.idDepartamento,
                    d.Descripcion,
                    d.Codigo
                  FROM " . $this->table . " dp
                  JOIN dbo.Departamentos d ON dp.idDepartamento = d.idDepartamento
                  WHERE dp.idPais = ?
                  ORDER BY d.Descripcion";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idPais]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error al obtener departamentos: " . $e->getMessage());
            return false;
        }
    }

    public function getCiudades($idPais, $idDepartamento = null) {
        $query = "SELECT DISTINCT 
                    c.idCiudad,
                    c.Descripcion,
                    c.Codigo
                  FROM " . $this->table . " dp
                  JOIN dbo.Ciudades c ON dp.idCiudad = c.idCiudad
                  WHERE dp.idPais = ?";
        $params = [$idPais];

        if ($idDepartamento) {
            $query .= " AND dp.idDepartamento = ?";
            $params[] = $idDepartamento;
        }

        $query .= " ORDER BY c.Descripcion";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            error_log("Query ejecutada: " . $query);
            error_log("Parámetros: " . json_encode($params));
            error_log("Número de resultados: " . count($results));

            return $results;
        } catch(PDOException $e) {
            error_log("Error al obtener ciudades: " . $e->getMessage());
            return false;
        }
    }
}