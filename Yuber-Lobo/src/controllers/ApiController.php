<?php

namespace src\controllers;

use src\utils\Response;
use src\models\EmpresaModel;
use src\models\QualityParameterReportModel;
use src\models\OrdenCompraModel;
use src\models\ProveedorModel;
use src\models\ClienteModel;
use src\models\OrigenModel;
use src\models\PilaModel;
use src\models\DestinoModel;
use src\models\ClaseModel;
use src\models\DepartamentoModel;
use src\models\CiudadModel;
use src\models\UnidadNegocioModel;
use src\models\ProductoModel;
use src\models\ClasificacionModel;

require_once MODELS_PATH . 'QualityParameterReportModel.php';
require_once MODELS_PATH . 'OrdenCompraModel.php';
require_once MODELS_PATH . 'EmpresaModel.php';
require_once MODELS_PATH . 'ProveedorModel.php';
require_once MODELS_PATH . 'OrigenModel.php';
require_once MODELS_PATH . 'ClienteModel.php';
require_once MODELS_PATH . 'PilaModel.php';
require_once MODELS_PATH . 'DestinoModel.php';
require_once MODELS_PATH . 'ClaseModel.php';
require_once MODELS_PATH . 'DepartamentoModel.php';
require_once MODELS_PATH . 'CiudadModel.php';
require_once MODELS_PATH . 'UnidadNegocioModel.php';
require_once MODELS_PATH . 'ProductoModel.php';
require_once MODELS_PATH . 'ClasificacionModel.php';
require_once UTILS_PATH . 'Response.php';


class ApiController
{

    public function empresas()
    {
        try {
            $empresaModel = new EmpresaModel();
            $texto = $_GET['texto'] ?? '';
            $data = $empresaModel->getEmpresas($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function qualityParameterReport()
    {
        try {
            $model = new QualityParameterReportModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getReports($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function ordenCompra()
    {
        try {
            $model = new OrdenCompraModel();
            $numero = $_GET['numero'] ?? '';
            $data = $model->getOrdenesCompra($numero);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function clientes()
    {
        try {
            $model = new ClienteModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getClientes($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function proveedores()
    {
        try {
            $model = new ProveedorModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getProveedores($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function origenes()
    {
        try {
            $model = new OrigenModel();
            $idProveedor = $_GET['id'] ?? '';
            $texto = $_GET['texto'] ?? '';

            if ($texto) {
                $data = $model->getOrigenesByMinaAndProveedor($texto, $idProveedor);
            } else {
                $data = $model->getOrigenesByProveedor($idProveedor);
            }

            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function pilas()
    {
        try {
            $model = new PilaModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getPilas($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function destinos()
    {
        try {
            $model = new DestinoModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getDestinos($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function clases()
    {
        try {
            $model = new ClaseModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getClases($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function departamentos()
    {
        try {
            $model = new DepartamentoModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getDepartamentos($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function ciudades()
    {
        try {
            $model = new CiudadModel();
            $idDepartamento = $_GET['id'] ?? '';
            $texto = $_GET['texto'] ?? '';

            if ($texto) {
                $data = $model->getCiudadesPorDescripcionYDepartamento($texto, $idDepartamento);
            } else {
                $data = $model->getCiudadesPorDepartamento($idDepartamento);
            }

            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }


    public function unidadesNegocio()
    {
        try {
            $model = new UnidadNegocioModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getUnidadesNegocio($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function productos()
    {
        try {
            $model = new ProductoModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getProductos($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }

    public function clasificaciones()
    {
        try {
            $model = new ClasificacionModel();
            $idProducto = $_GET['id'] ?? '';
            $texto = $_GET['texto'] ?? '';

            if ($texto && $idProducto) {
                $data = $model->getClasificacionesPorDescripcionYProducto($texto, $idProducto);
            }else {
                $data = $model->getClasificacionesPorProducto($idProducto);
            }

            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['error' => $e->getMessage()], 500);
        }
    }
}
