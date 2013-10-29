<?php
namespace Calificaciones\Model;

use Zend\Db\TableGateway\TableGateway;

class CalificacionesTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    
}