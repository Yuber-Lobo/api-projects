<?php
namespace App\Models;

class MaterialModel extends BaseModel {
    public function __construct() {
        parent::__construct('Materiales', 'idMaterial');
    }
}