<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/Clase.php';

class ClaseController extends BaseController {
    public function __construct($db) {
        $model = new Clase($db);
        parent::__construct($model);
    }
}