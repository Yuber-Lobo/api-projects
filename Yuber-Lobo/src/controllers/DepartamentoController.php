<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/Departamento.php';

class DepartamentoController extends BaseController {
    public function __construct($db) {
        $model = new Departamento($db);
        parent::__construct($model);
    }
}