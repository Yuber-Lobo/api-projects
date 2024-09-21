<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/Ciudad.php';

class CiudadController extends BaseController {
    public function __construct($db) {
        $model = new Ciudad($db);
        parent::__construct($model);
    }
}