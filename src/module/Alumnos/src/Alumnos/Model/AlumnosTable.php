<?php

namespace Alumnos\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

use Alumnos\Model\Alumnos; 



class AlumnosTable
{
    protected $tableGateway;
    protected $table ='alumnos';
 

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAlumno($id)
    {
       $id = (int)$id;
		$rowset = $this -> tableGateway -> select(array('idAlumno' => $id));
		$row = $rowset -> current();
		
		if (!$row) {
			throw new \Exception("No se pudo encontrar en Alumno con id  $id");
		}
		
		return $row;
    }
	
	public function findAlumno($nombre,$apaterno,$amaterno, $folio)
    {
       //$id = (int)$id;
	   $nombre = (string)$nombre;
	   $apaterno =(string)$apaterno;
	   $amaterno=(string)$amaterno;
	   $folio = (string)$folio;
	   $sql= "folioEstudiante LIKE '%".$folio."%' OR a_paterno LIKE '%".$apaterno."%' OR a_materno LIKE '%".$amaterno."%' nombres LIKE '%".$nombre."%'";
	   
	    $rowSet = $this -> tableGateway -> select(array('nombres' => $nombre));
	    return $rowSet;
	   
	    
		
 
        //$where = new  Where();
        /*
		 $where->orPredicate(array(
        		'nombres'=>$nombre,
				'a_paterno'=> $apaterno,
				'a_materno'=> $amaterno,
				'folioEstudiante'=> $folio,
			));
			//*/
			
			/*
		$where->orPredicate(array('nombres'=> $nombre));
		$where->orPredicate(array('a_paterno'=> $apaterno));
		$where->orPredicate(array('a_materno'=>  $amaterno));
		$where->orPredicate(array('folioEstudiante'=>  $folio));
		//*/
        //$select->where($where);
 
        //$rowSet = $this -> tableGateway -> select($where);
	    //return $rowSet;
	    /*
        $select = new Select;
		$select->from('alumnos');
		$select->where($where);

		$statement = $adapter->createStatement();
		$select->prepareStatement($adapter, $statement);

		$resultSet = new ResultSet();
		$resultSet->initialize($statement->execute());
		return $resultSet;
		 */
    }

    public function saveAlumno(Alumnos $alumno)
    {
        $data = array(
            'idAlumno' => $alumno->idAlumno,
            'aPaterno' => $alumno->aPaterno,
            'aMaterno' => $alumno->aMaterno,
            'nombres' => $alumno->nombres,
            'mail' => $alumno->mail,
            'tipoEstudiante' => $alumno->tipoEstudiante,
            'telefonos' => $alumno->telefonos,
            'curp' => $alumno->curp,
            'folioExamen' => $alumno->folioExamen,
            'nombreTutor' => $alumno->nombreTutor,
        );

        $id = (int)$alumno->idAlumno;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlumno($id)) {
                $this->tableGateway->update($data, array('idAlumno' => $id));
            } else {
                throw new \Exception('El alumno no existe');
            }
        }
    }

    public function deleteAlumno($id)
     {
         $this->tableGateway->delete(array('idAlumno' => (int) $id));
     }
}