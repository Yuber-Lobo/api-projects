<?php
namespace App\Models;

use App\Utils\EncryptionUtil;
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

    protected function decryptField($value) {
         try {
            $decrypted = EncryptionUtil::decrypt($value);
            
            // Imprimir el valor desencriptado para depuración
            error_log("Decrypted value: " . $decrypted);

            // Verificar si el valor desencriptado es un GUID válido
            if (!preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', $decrypted)) {
                throw new \Exception("Decrypted value is not a valid GUID: " . $decrypted);
            }

            return $decrypted;
        } catch (\Exception $e) {
            error_log("Decryption error: " . $e->getMessage());
            throw new \Exception("Error during decryption process: " . $e->getMessage(), 0, $e);
        }
    }

    protected function encryptData($data) {
        if (is_array($data)) {
            foreach ($data as &$item) {
                foreach ($this->encryptedFields as $field) {
                    if (isset($item[$field])) {
                        $item[$field] = $this->encryptField($item[$field]);
                    }
                }
            }
        }
        return $data;
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
}