<?php
namespace Profesores\Model;

use Zend\Db\TableGateway\TableGateway;

class ProfesoresTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    
}