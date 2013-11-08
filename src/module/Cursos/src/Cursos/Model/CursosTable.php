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

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getCursos($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No encontramos el registro  del Profesor solicitada");
         }
         return $row;
     }

     public function saveCursos(Cursos $cursos)
     {
         $data = array(
             'idCurso' 		=> $cursos->idCurso,
             'idProfesor' 	=> $cursos->idProfesor,
             'idAlumno' 	=> $cursos->idAlumno,
             'curso' 		=> $cursos->curso,
             'salon' 		=> $cursos->salon,
             'horario' 		=> $cursos->horario,
         );

         $id = (int) $calificaciones->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getCalificaciones($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('El registro del profesor solicitado no existe');
             }
         }
     }

     public function deleteCursos($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
