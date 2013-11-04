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

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getProfesores($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No encontramos el registro  del Profesor solicitada");
         }
         return $row;
     }

     public function saveProfesores(Profesores $profesores)
     {
         $data = array(
             'idProfesor' 	=> $profesores->idCalificaciones,
             'aPaterno' 	=> $profesores->aPaterno,
             'aMaterno' 	=> $profesores->aMaterno,
             'nombres' 		=> $profesores->nombres,
             'mail' 		=> $profesores->mail,
             
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

     public function deleteProfesores($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
