<?php
namespace App\Models;

class DestinoCodigosModel extends BaseModel {
    public function __construct() {
        parent::__construct('Destino_codigos', 'idDestino');
    }

    // Método para obtener códigos por destino
    public function getCodigosByDestino($idDestino) {
        $query = "SELECT * FROM {$this->table} WHERE idDestino = :idDestino";
        return $this->customQuery($query, ['idDestino' => $idDestino]);
    }
}