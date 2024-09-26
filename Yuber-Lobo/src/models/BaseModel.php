<?php
namespace App\Models;

use App\Utils\EncryptionUtil;
use App\Utils\TimerUtil;
use PDO;

abstract class BaseModel {
    protected $db;
    protected $table;
    protected $primaryKey;
    protected $encryptedFields = [];

    public function __construct($table, $primaryKey, $encryptedFields = []) {
        $this->db = \Database::getInstance()->getConnection();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->encryptedFields = array_merge([$primaryKey], $encryptedFields);
    }

    protected function encryptField($value) {
        return EncryptionUtil::encrypt($value);
    }

     protected function encryptData($data) {
        TimerUtil::start('encryptData');
        if (is_array($data)) {
          foreach ($data as &$item) {
    // Preseleccionamos solo los campos que están en el array y que necesitan encriptarse
    $fieldsToEncrypt = array_intersect_key($item, array_flip($this->encryptedFields));
    
    // Solo iteramos sobre los campos que están presentes en $item y necesitan encriptarse
    foreach ($fieldsToEncrypt as $field => $value) {
        if ($this->isValidUUID($value)) {
            $item[$field] = EncryptionUtil::encrypt($value);
        }
    }
}
        }
        TimerUtil::stop('encryptData');
        return $data;
    }

    protected function decryptField($value) {
        TimerUtil::start('decryptField');
        if ($this->isValidUUID($value)) {
            $result = EncryptionUtil::decrypt($value);
        } else {
            $result = $value;
        }
        TimerUtil::stop('decryptField');
        return $result;
    }

    protected function isValidUuid($uuid) {
        return preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', $uuid) === 1;
    }

    protected function decryptData($data) {
        if (is_array($data)) {
            foreach ($data as &$item) {
                foreach ($this->encryptedFields as $field) {
                    if (isset($item[$field])) {
                        $item[$field] = $this->decryptField($item[$field]);
                    }
                }
            }
        }
        return $data;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->encryptData($result);
    }

     public function getById($encryptedId) {
       try {
            $id = $this->decryptField($encryptedId);
            $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $this->encryptData([$result])[0] : null;
        } catch (\Exception $e) {
            error_log("Error in getById: " . $e->getMessage());
            throw new \Exception("Error retrieving data by ID: " . $e->getMessage(), 0, $e);
        }
    }

    public function search($column, $value) {
        $query = "SELECT * FROM {$this->table} WHERE {$column} LIKE :value";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':value', "%{$value}%");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->encryptData($result);
    }

    public function create($data) {
        $decryptedData = $this->decryptData([$data])[0];
        $columns = implode(', ', array_keys($decryptedData));
        $placeholders = ':' . implode(', :', array_keys($decryptedData));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($query);
        foreach ($decryptedData as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        return $stmt->execute();
    }

    protected function customQuery($query, $params = []) {
        $stmt = $this->db->prepare($query);
        foreach ($params as $key => $value) {
            if (in_array($key, $this->encryptedFields)) {
                $value = $this->decryptField($value);
            }
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->encryptData($result);
    }

    //Métodos para consultas de vista
    //   protected function callView($viewName) {
    //     if (!$this->viewExists($viewName)) {
    //         throw new \Exception("View {$viewName} does not exist.");
    //     }

    //     $query = "SELECT * FROM dbo.{$viewName}";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $this->encryptData($result);
    // }

    protected function encryptDataP($data, $fieldsToEncrypt)
    {
        if (is_array($data)) {
            foreach ($data as &$item) {
                foreach ($fieldsToEncrypt as $field) {
                    if (isset($item[$field]) && $this->isValidUUID($item[$field])) {
                        $item[$field] = EncryptionUtil::encrypt($item[$field]);
                    }
                }
            }
        }
        return $data;
    }
    protected function getUniqueIdentifierFields($viewName)
    {
        $query = "SELECT COLUMN_NAME 
                  FROM INFORMATION_SCHEMA.COLUMNS 
                  WHERE TABLE_NAME = :table_name 
                  AND DATA_TYPE = 'uniqueidentifier'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':table_name', $viewName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    protected function callView($viewName, $params = [], $options = []) {
        if (!$this->viewExists($viewName)) {
            throw new \Exception("View {$viewName} does not exist.");
        }

        $uniqueIdentifierFields = $this->getUniqueIdentifierFields($viewName);

        
        // SELECT básico
        $query = "SELECT * FROM dbo.{$viewName}";

        // cláusula WHERE solo si hay parámetros
        $whereClause = [];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                // Si se proporciona un valor de búsqueda, lo incluimos en la consulta
                if (!empty($value)) {
                    // Soporte para LIKE
                    if (is_array($value) && isset($value['operator']) && strtoupper($value['operator']) === 'LIKE') {
                        $whereClause[] = "{$key} LIKE :{$key}";
                    } else {
                        $whereClause[] = "{$key} = :{$key}";
                    }
                }
            }
        }

        // Condiciones adicionales (opcional, JOIN, GROUP BY, etc.)
        if (!empty($options['conditions'])) {
            foreach ($options['conditions'] as $condition) {
                $whereClause[] = $condition;  // Se asume que el usuario pasa la condición completa
            }
        }

        // Si hay cláusulas WHERE, se unen con AND
        if (!empty($whereClause)) {
            $query .= " WHERE " . implode(' AND ', $whereClause);
        }

        // Agregar GROUP BY si se define
        if (!empty($options['group_by'])) {
            $query .= " GROUP BY " . implode(', ', $options['group_by']);
        }

        // Agregar HAVING si se define
        if (!empty($options['having'])) {
            $query .= " HAVING " . implode(' AND ', $options['having']);
        }

        // Agregar ORDER BY si se define
        if (!empty($options['order_by'])) {
            $query .= " ORDER BY " . implode(', ', $options['order_by']);
        }

        // Preparar y ejecutar la consulta
        $stmt = $this->db->prepare($query);

        // parámetros
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                if (in_array($key, $uniqueIdentifierFields)) {
                    $value = $this->decryptField($value);  // Desencriptar si es necesario
                }
                if (is_array($value) && isset($value['operator']) && strtoupper($value['operator']) === 'LIKE') {
                    $stmt->bindValue(":{$key}", '%' . $value['value'] . '%');
                } else {
                    $stmt->bindValue(":{$key}", $value);
                }
            }
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->encryptDataP($result, $uniqueIdentifierFields);
    }

    private function viewExists($viewName) {
        $query = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = 'dbo' AND TABLE_NAME = :viewName";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':viewName', $viewName);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

}