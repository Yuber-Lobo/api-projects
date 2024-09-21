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
            $dsn = "sqlsrv:Server=$serverName;Database=$databaseName;TrustServerCertificate=true";
            error_log("Intentando conectar a: $dsn");
            
            $this->conn = new PDO($dsn, $username, $password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ));
            
            error_log("Conexión a la base de datos establecida con éxito.");
            
            // Verificar la conexión con una consulta simple
            $stmt = $this->conn->query("SELECT @@VERSION AS version");
            $result = $stmt->fetch();
            error_log("Versión de SQL Server: " . $result['version']);
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