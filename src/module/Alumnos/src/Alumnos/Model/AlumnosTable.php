<?php

namespace Alumnos\Model;

use Zend\Db\TableGateway\TableGateway;
use Alumnos\Model\Alumnos; 

class AlumnosTable
{
    protected $tableGateway;

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

    public function saveAlumno(Alumnos $alumno)
    {
        $data = array(
            'idAlumno' => $alumno->idAlumno,
            'aPaterno' => $alumno->aPaterno,
            'aMaterno' => $alumno->aMaterno,
            'nombres' => $alumno->nombres,
            'mail' => $alumno->mail,
            'tipoEstudiante' => $alumno->tipoEstudiante,
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