<?php

namespace src\controllers;

use src\models\ClasificacionModel;
use src\models\ProductoModel;
use src\models\CiudadModel;
use src\models\ProveedorModel;
use src\models\OrigenModel;
use src\utils\Response;

require_once MODELS_PATH . 'ClasificacionModel.php';
require_once MODELS_PATH . 'ProductoModel.php';
require_once MODELS_PATH . 'CiudadModel.php';
require_once MODELS_PATH . 'ProveedorModel.php';
require_once MODELS_PATH . 'OrigenModel.php';
require_once UTILS_PATH . 'Response.php';

class ApiController
{
    public function clasificacion()
    {
        $model = new ClasificacionModel();
        $data = $model->getClasificaciones($this->getQueryParams());
        Response::json($data);
    }

    public function productos()
    {
        $model = new ProductoModel();
        $data = $model->getProductos($this->getQueryParams());
        Response::json($data);
    }

    public function ciudades()
    {
        $model = new CiudadModel();
        $params = $this->getQueryParams();

        if (isset($params['like']) && isset($params['likeValue'])) {
            $data = $model->getCiudadesConFiltro($params);
        } else {
            $data = $model->getCiudadesPorDepartamento($params);
        }

        Response::json($data);
    }

    public function proveedores()
    {
        $model = new ProveedorModel();
        $data = $model->getProveedores($this->getQueryParams());
        Response::json($data);
    }

    public function origenes()
    {
        $model = new OrigenModel();
        $params = $this->getQueryParams();
        $data = $model->getOrigenes($params);
        Response::json($data);
    }

    private function getQueryParams()
    {
        return $_GET;
    }
}
