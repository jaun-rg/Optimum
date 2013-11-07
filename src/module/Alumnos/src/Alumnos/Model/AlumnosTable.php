<?php

namespace Alumnos\Model;

use Zend\Db\TableGateway\TableGateway;

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
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
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

        $id = (int)$alumno->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('El alumno no existe');
            }
        }
    }

    public function deleteAlumno($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}