<?php

namespace App\Models;

class PaisModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('Paises', 'idPais');
    }

    //Método para obtener los países junto con sus departamentos y ciudades
    public function getPaisesDepartamentosCiudades()
    {
        return $this->callView('VPaisesDepartamentosCiudades');
    }

    //Método para obtener los países junto con sus departamentos
    public function getPaisesWithDepartamentos()
    {
        return $this->callView('VPaisesDepartamentos', [], [
            'group_by' => ['idPais', 'Descripcion'],
            'order_by' => ['Descripcion ASC']
        ]);
    }
}
