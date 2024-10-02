<?php
define('API_BASE_URL', 'http://localhost:8082');
define('CONTROLLERS_PATH', __DIR__ . '/../src/controllers/');
define('MODELS_PATH', __DIR__ . '/../src/models/');
define('UTILS_PATH', __DIR__ . '/../src/utils/');

// Habilitar logs de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);