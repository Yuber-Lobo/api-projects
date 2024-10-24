<?php

namespace src\controllers;

use src\utils\Response;
use src\models\QualityParameterReportModel;
use src\models\EmpresaModel;
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
use src\models\TipoReporteModel;
use src\models\ClasificacionModel;
use src\models\FuenteModel;
use src\models\ReglaModel;
use src\models\TransaccionModel;

$modelsPath = MODELS_PATH . '*.php';
foreach (glob($modelsPath) as $filename) {
    require_once $filename;
}

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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
        }
    }
    public function reglas()
    {
        try {
            $model = new ReglaModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getReglas($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
        }
    }

    public function fuente()
    {
        try {
            $model = new FuenteModel();
            $data = $model->getFuentes();
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' => 'Not found'], 404);
        }
    }

    public function qualityParameterReport()
    {
        try {
            $model = new QualityParameterReportModel();

            $filters = array_filter($_GET, function ($value) {
                return $value !== '' && $value !== null;
            });

            if (empty($filters)) {
                $data = $model->getReports();
            } else {
                // Removemos 'fuente' si está presente en los filtros, ya que lo manejamos por separado
                // unset($filters['fuente']);
                $data = $model->getAdvancedReports($filters);
            }

            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' => 'Not found'], 404);
        }
    }

    public function createQualityParameterReport()
    {
        try {
            $model = new QualityParameterReportModel();
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $model->createReport($data);
            Response::json($response);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' => 'Not found'], 404);
        }
    }

    public function transacciones()
    {
        try {
            $model = new TransaccionModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getTransacciones($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
        }
    }

    public function ordenCompra()
    {
        try {
            $model = new OrdenCompraModel();
            $texto = $_GET['texto'] ?? '';
            $data = $model->getOrdenesCompra($texto);
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
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
            } else {
                $data = $model->getClasificacionesPorProducto($idProducto);
            }

            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' =>  'Not found'], 404);
        }
    }

    public function tipoReporte()
    {
        try {
            $model = new TipoReporteModel();
            $data = $model->getTipoReporte();
            Response::json($data);
        } catch (\Exception $e) {
            Response::json(['status' => 404, 'results' => 'Not found'], 404);
        }
    }
}
