<?php
namespace App\Controllers;

use App\Models\UnidadDeNegocioModel;

class UnidadDeNegocioController extends BaseController {
    public function __construct() {
        parent::__construct(new UnidadDeNegocioModel());
    }
}