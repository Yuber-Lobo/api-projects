<?php
namespace src\models;

require_once __DIR__ . '/BaseModel.php';

class TransaccionModel extends BaseModel
{
    protected $endpoint = '/TransaccionesMovimiento()';

    public function getTransacciones($texto)
    {
        $params = [
            'select' => '*',
            'linkTo' => 'iTransaccion,Descripcion',
            'equalTo' => '0_' . $texto,
            'operator' => '>=,LIKE',
            'orderBy' => 'Descripcion',
            'orderMode' => 'ASC',
            'top' => 20
        ];
        return $this->get($params);
    }
}
?>