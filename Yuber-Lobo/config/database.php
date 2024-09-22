<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $serverName = "DESKTOP-NVA5EOC\YUBERLOBO";
        $databaseName = "dbo";
        $username = "sserver";
        $password = "root";

        try {

              $this->conn = new PDO("sqlsrv:Server=$serverName;Database=$databaseName;TrustServerCertificate=true", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            die(json_encode(array(
                "message" => "Connection failed: " . $e->getMessage(),
                "serverName" => $serverName,
                "databaseName" => $databaseName
            )));
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}