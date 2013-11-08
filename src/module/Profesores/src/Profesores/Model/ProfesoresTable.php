<?php
namespace Profesores\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Profesores\Model\Profesores;

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

     public function getProfesor($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idProfesor' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No encontramos el registro  del Profesor solicitado");
         }
         return $row;
     }

     public function saveProfesor(Profesores $profesor)
     {
         $data = array(
             'idProfesor' 	=> $profesor->idProfesor,
             'aPaterno' 	=> $profesor->aPaterno,
             'aMaterno' 	=> $profesor->aMaterno,
             'nombres' 		=> $profesor->nombres,
             'mail' 		=> $profesor->mail,
             
         );

         $id = (int) $profesor->idProfesor;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getProfesor($id)) {
                 $this->tableGateway->update($data, array('idProfesor' => $id));
             } else {
                 throw new \Exception('El registro del Profesor solicitado no existe');
             }
         }
     }

     public function deleteProfesor($id)
     {
         $this->tableGateway->delete(array('idProfesor' => (int) $id));
     }
 }
