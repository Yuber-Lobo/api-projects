<?php

class BaseModel {
    protected $conn;
    protected $table;
    protected $idColumn;
    protected $columns;

    public function __construct($db, $table, $idColumn, $columns) {
        $this->conn = $db;
        $this->table = $table;
        $this->idColumn = $idColumn;
        $this->columns = $columns;
    }

    public function getAll() {
        $query = "SELECT " . implode(", ", $this->columns) . " FROM " . $this->table;
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        $query = "SELECT " . implode(", ", $this->columns) . " FROM " . $this->table . " WHERE " . $this->idColumn . " = ?";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function create($data) {
        $columns = array_intersect_key($data, array_flip($this->columns));
        $columnNames = implode(", ", array_keys($columns));
        $placeholders = ":" . implode(", :", array_keys($columns));

        $query = "INSERT INTO " . $this->table . " (" . $columnNames . ") VALUES (" . $placeholders . ")";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($columns);
            return $this->conn->lastInsertId();
        } catch(PDOException $e) {
            error_log("Error en la inserción: " . $e->getMessage());
            return false;
        }
    }

    public function search($params) {
        $query = "SELECT " . implode(", ", $this->columns) . " FROM " . $this->table;
        $conditions = [];
        $values = [];

        if (isset($params['search'])) {
            $conditions[] = "Descripcion LIKE ?";
            $values[] = "%" . $params['search'] . "%";
        }

        // Llamada al método con nombre simplificado
        $this->extendSearch($params, $conditions, $values);

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($values);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Si no hay condiciones de búsqueda y hay resultados, devolver todos los registros
            // Si hay condiciones de búsqueda pero no hay resultados, devolver un array vacío
            return (!empty($conditions) || empty($results)) ? $results : $this->getAll();
        } catch(PDOException $e) {
            error_log("Error en la búsqueda: " . $e->getMessage());
            return false;
        }
    }

     protected function extendSearch($params, &$conditions, &$values) {
        // Implementación por defecto vacía
    }
}