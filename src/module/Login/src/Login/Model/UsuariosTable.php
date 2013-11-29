<?php

namespace Login\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

use Login\Model\Usuarios; 
use Zend\View\Model\ViewModel;
use Profesores\Model\ProfesoresTable as ProfesoresTable;



class UsuariosTable
{
    protected $tableGateway;
	protected $table='usuarios';
	protected $joinTable='profesores';
	//protected $profesoresTable;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
	

    public function authentificate($username, $pass)
    {
       
	    $username = (string)$username;
	    $pass = (string)$pass;		
		$rowset = $this -> tableGateway -> select(array('username' => $username, 'pass'=> $pass,));
		$row = $rowset -> current();
		
		if (!$row) {
			throw new \Exception("No se pudo encontrar en Alumno con id  $username");
		}
		
		return $row;
    }
	
}