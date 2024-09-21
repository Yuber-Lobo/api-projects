<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/Pais.php';

class PaisController extends BaseController {
    public function __construct($db) {
        $model = new Pais($db);
        parent::__construct($model);
    }
}
?>