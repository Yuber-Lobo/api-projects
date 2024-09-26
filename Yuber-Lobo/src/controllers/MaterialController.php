<?php
namespace App\Controllers;

use App\Models\MaterialModel;

class MaterialesController extends BaseController {
    public function __construct() {
        parent::__construct(new MaterialModel());
    }
}