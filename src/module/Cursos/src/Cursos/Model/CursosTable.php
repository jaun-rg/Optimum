<?php
namespace Cursos\Model;

use Zend\Db\TableGateway\TableGateway;

class CursosTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    
}