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

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getCalificaciones($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No encontramos el registro  de la calificación solicitada");
         }
         return $row;
     }

     public function saveCalificaciones(Calificaciones $calificaciones)
     {
         $data = array(
             'idCalificaciones' => $calificaciones->idCalificaciones,
             'idCurso' 			=> $calificaciones->idCurso,
             'idAlumno' 		=> $calificaciones->idAlumno,
             'fecha' 			=> $calificaciones->fecha,
             'calificacion' 	=> $calificaciones->calificacion,
             'tipoCalificacion' => $calificaciones->tipoCalificacion,
         );

         $id = (int) $calificaciones->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getCalificaciones($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('El registro de calificaciones solicitado no existe');
             }
         }
     }

     public function deleteCalificaciones($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }